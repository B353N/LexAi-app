<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Http\Requests\StoreDocumentRequest;
use Prism\Prism\PrismManager;
use Prism\Prism\Text\Request as TextRequest;
use Prism\Prism\ValueObjects\Messages\UserMessage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = $request->user()->documents()->latest()->get();

        return Inertia::render('Documents/Index', [
            'documents' => $documents,
        ]);
    }

    public function create()
    {
        return Inertia::render('Documents/Create');
    }

    public function store(StoreDocumentRequest $request)
    {
        $validated = $request->validated();
        $prompt = $this->generatePrompt($validated);

        // This part can be slow, consider moving to a queued job for better UX
        $textRequest = new TextRequest(
            model: 'gemini-2.0-flash', // Using a faster model
            messages: [new UserMessage($prompt)],
            maxTokens: 4096,
            temperature: 0.7
        );

        $result = app(PrismManager::class)->resolve('gemini')->text($textRequest);

        // Generate PDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($result->text);

        // Store the file
        $filename = Str::slug($validated['title']) . '_' . time() . '.pdf';
        $path = "documents/{$request->user()->id}/{$filename}";
        Storage::disk('local')->put($path, $pdf->output());

        // Create database record
        $request->user()->documents()->create([
            'title' => $validated['title'],
            'file_path' => $path,
        ]);

        return to_route('documents.index')->with('success', 'Document generated successfully.');
    }

    public function download(Request $request, Document $document)
    {
        if ($request->user()->id !== $document->user_id) {
            abort(403);
        }

        if (!Storage::disk('local')->exists($document->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('local')->download($document->file_path, $document->title . '.pdf');
    }

    public function destroy(Request $request, Document $document)
    {
        // Authorize that the user owns the document
        if ($request->user()->id !== $document->user_id) {
            abort(403);
        }

        // Delete the file from storage
        Storage::disk('local')->delete($document->file_path);

        // Delete the record from the database
        $document->delete();

        return to_route('documents.index')->with('success', 'Document deleted successfully.');
    }

    private function generatePrompt(array $data): string
    {
        $party1 = $data['parties']['party1'];
        $party2 = $data['parties']['party2'];
        $startDate = $data['terms']['start_date'];
        $duration = $data['terms']['duration_months'];
        $title = $data['title'];

        // This can be expanded with more document types
        return "Генерирай правен документ със заглавие '{$title}' между страните {$party1} и {$party2} с начало на валидност {$startDate} и срок {$duration} месеца. Документът трябва да е на български език и съобразен с българското законодателство. Форматирай го като HTML.";
    }
}
