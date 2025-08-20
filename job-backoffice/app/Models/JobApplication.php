<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'job_applications';

    protected $fillable = [
        'ai_generated_score',
        'ai_generated_feedback',
        'status',
        'user_id',
        'job_vacancy_id',
        'resume_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function job_vacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancy_id', 'id');
    }

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class, 'resume_id', 'id');
    }
}
