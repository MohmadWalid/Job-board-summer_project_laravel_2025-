<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class GroqApiService
{
    private string $apiKey;
    private string $model;
    private int $timeout;

    public function __construct()
    {
        $this->apiKey = config('services.groq.api_key', env('GROQ_API_KEY', ''));
        $this->model = config('services.groq.model', env('GROQ_MODEL', 'llama-3.3-70b-versatile'));
        $this->timeout = (int) config('services.groq.timeout', env('GROQ_TIMEOUT', 30));
    }

    /**
     * Send a prompt to the Groq API and return the decoded JSON response content.
     *
     * @param  string  $systemPrompt  Instructions for the model's role and output format.
     * @param  string  $userMessage   The actual content to process.
     * @return array                  Decoded JSON array from the model's response.
     * @throws \RuntimeException      On HTTP failure or non-JSON response.
     */
    public function complete(string $systemPrompt, string $userMessage): array
    {
        if (empty($this->apiKey)) {
            throw new RuntimeException('GROQ_API_KEY is not configured.');
        }

        $response = Http::withToken($this->apiKey)
            ->timeout($this->timeout)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $this->model,
                'response_format' => ['type' => 'json_object'],
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userMessage],
                ],
            ]);

        if ($response->failed()) {
            Log::error('Groq API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new RuntimeException(
                "Groq API returned HTTP {$response->status()}: {$response->body()}"
            );
        }

        $content = $response->json('choices.0.message.content');

        if (empty($content)) {
            throw new RuntimeException('Groq API returned an empty response.');
        }

        $decoded = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Groq API returned non-JSON content', [
                'content' => substr($content, 0, 500),
            ]);

            throw new RuntimeException('Groq API returned non-JSON content.');
        }

        return $decoded;
    }
}
