<?php

namespace App\Services;

use App\Models\JobVacancy;
use App\Models\Resume;
use Illuminate\Support\Facades\Log;

class ApplicationEvaluatorService
{
    private GroqApiService $groqApi;

    public function __construct(GroqApiService $groqApi)
    {
        $this->groqApi = $groqApi;
    }

    /**
     * Evaluate resume compatibility against a job vacancy.
     *
     * Returns a score (0–100) and actionable feedback string.
     * On any failure, returns safe defaults so the application is never lost.
     *
     * @param  Resume     $resume
     * @param  JobVacancy $jobVacancy
     * @return array{score: int, feedback: string}
     */
    public function evaluate(Resume $resume, JobVacancy $jobVacancy): array
    {
        try {
            $result = $this->groqApi->complete(
                $this->buildSystemPrompt(),
                $this->buildUserMessage($resume, $jobVacancy)
            );

            return $this->normalizeResult($result);
        } catch (\Throwable $e) {
            Log::error('Application evaluation failed', [
                'resume_id' => $resume->id,
                'job_vacancy_id' => $jobVacancy->id,
                'error' => $e->getMessage(),
            ]);

            return [
                'score' => 0,
                'feedback' => 'Evaluation could not be completed at this time. Please try again later.',
            ];
        }
    }

    private function buildSystemPrompt(): string
    {
        return <<<'PROMPT'
You are an expert technical recruiter. Your job is to evaluate a candidate's resume against a job vacancy and provide an honest, helpful assessment.

Respond with ONLY a valid JSON object with exactly these keys:
- score: integer from 0 to 100 representing overall compatibility percentage
- feedback: a single string with 3-5 bullet points (using "•") of actionable recommendations for the candidate to improve their application

Scoring guidelines:
- 80–100: Strong match — most required skills present, relevant experience
- 50–79: Moderate match — some relevant skills, notable gaps
- 20–49: Weak match — significant skill gaps, limited relevant experience
- 0–19: Not a match — fundamentally different career path

Be honest but constructive. Focus on specific, actionable improvements.
Do NOT include any text outside the JSON object.
PROMPT;
    }

    private function buildUserMessage(Resume $resume, JobVacancy $jobVacancy): string
    {
        return <<<EOT
JOB VACANCY:
Title: {$jobVacancy->title}
Description: {$jobVacancy->description}
Required Skills: {$jobVacancy->required_skills}
Location: {$jobVacancy->location}
Type: {$jobVacancy->type}

CANDIDATE RESUME:
Summary: {$resume->summary}
Skills: {$resume->skills}
Experience: {$resume->experience}
Education: {$resume->education}
EOT;
    }

    /**
     * Normalize the raw API result into the expected shape.
     */
    private function normalizeResult(array $result): array
    {
        $score = isset($result['score']) ? (int) $result['score'] : 0;
        $score = max(0, min(100, $score)); // Clamp to 0–100

        $feedback = isset($result['feedback']) && is_string($result['feedback'])
            ? $result['feedback']
            : 'No feedback available.';

        return [
            'score' => $score,
            'feedback' => $feedback,
        ];
    }
}
