<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Prism\Prism;
use App\Http\Requests\StoreDocumentRequest;

class DocumentController extends Controller
{
    public function create()
    {
        return Inertia::render('Documents/Create');
    }

    public function store(StoreDocumentRequest $request)
    {
        $validated = $request->validated();

        $prompt = $this->generatePrompt($validated);

        $result = Prism::gemini()->text($prompt);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($result->content());

        return $pdf->stream('document.pdf');
    }

    private function generatePrompt(array $data): string
    {
        $party1 = $data['parties']['party1'];
        $party2 = $data['parties']['party2'];
        $startDate = $data['terms']['start_date'];
        $duration = $data['terms']['duration_months'];

        // This can be expanded with more document types
        return "Генерирай договор за наем между {$party1} и {$party2} с начало {$startDate} и срок {$duration} месеца, съобразен с българското законодателство.";
    }
}
