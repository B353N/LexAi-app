<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default provider
    |--------------------------------------------------------------------------
    |
    | This value determines the default provider to use when sending requests
    | without having explicitly specified a provider.
    |
    */

    'default' => env('PRISM_DEFAULT_PROVIDER', 'openai'),

    /*
    |--------------------------------------------------------------------------
    | API providers
    |--------------------------------------------------------------------------
    |
    | Here you may configure the providers that you would like to use with
    | Prism. You can configure as many as you like, and even add your
    | own custom providers.
    |
    */

    'providers' => [
        'openai' => [
            'driver' => 'openai',
            'api_key' => env('OPENAI_API_KEY'),
            'organisation' => env('OPENAI_ORGANISATION'),
        ],
        'anthropic' => [
            'api_key' => env('ANTHROPIC_API_KEY', ''),
            'version' => env('ANTHROPIC_API_VERSION', '2023-06-01'),
            'default_thinking_budget' => env('ANTHROPIC_DEFAULT_THINKING_BUDGET', 1024),
            // Include beta strings as a comma separated list.
            'anthropic_beta' => env('ANTHROPIC_BETA', null),
        ],
        'ollama' => [
            'url' => env('OLLAMA_URL', 'http://localhost:11434'),
        ],
        'mistral' => [
            'api_key' => env('MISTRAL_API_KEY', ''),
            'url' => env('MISTRAL_URL', 'https://api.mistral.ai/v1'),
        ],
        'groq' => [
            'api_key' => env('GROQ_API_KEY', ''),
            'url' => env('GROQ_URL', 'https://api.groq.com/openai/v1'),
        ],
        'xai' => [
            'api_key' => env('XAI_API_KEY', ''),
            'url' => env('XAI_URL', 'https://api.x.ai/v1'),
        ],
        'gemini' => [
            'driver' => 'gemini',
            'api_key' => env('PRISM_GEMINI_API_KEY'),
            'url' => env('GEMINI_URL', 'https://generativelanguage.googleapis.com/v1beta/models'),
        ],
        'deepseek' => [
            'api_key' => env('DEEPSEEK_API_KEY', ''),
            'url' => env('DEEPSEEK_URL', 'https://api.deepseek.com/v1'),
        ],
        'voyageai' => [
            'api_key' => env('VOYAGEAI_API_KEY', ''),
            'url' => env('VOYAGEAI_URL', 'https://api.voyageai.com/v1'),
        ],
    ],
];
