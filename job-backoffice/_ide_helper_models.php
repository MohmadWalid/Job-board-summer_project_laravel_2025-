<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property string $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobVacancy> $job_vacancies
 * @property-read int|null $job_vacancies_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $name
 * @property string $address
 * @property string $industry
 * @property string|null $website
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $owner_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobApplication> $job_applications
 * @property-read int|null $job_applications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobVacancy> $job_vacancies
 * @property-read int|null $job_vacancies_count
 * @property-read \App\Models\User $owner
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withoutTrashed()
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property numeric $ai_generated_score
 * @property string|null $ai_generated_feedback
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $user_id
 * @property string $job_vacancy_id
 * @property string $resume_id
 * @property-read \App\Models\JobVacancy $job_vacancy
 * @property-read \App\Models\Resume $resume
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereAiGeneratedFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereAiGeneratedScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereJobVacancyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereResumeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication withoutTrashed()
 */
	class JobApplication extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $required_skills
 * @property string $location
 * @property numeric $salary
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $company_id
 * @property int $viewCount
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobApplication> $job_applications
 * @property-read int|null $job_applications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereRequiredSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy whereViewCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVacancy withoutTrashed()
 */
	class JobVacancy extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $file_name
 * @property string $file_url
 * @property string $contact_details
 * @property string $summary
 * @property string $skills
 * @property string|null $experience
 * @property string $education
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobApplication> $job_applications
 * @property-read int|null $job_applications_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereContactDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume withoutTrashed()
 */
	class Resume extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobApplication> $job_applications
 * @property-read int|null $job_applications_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Resume> $resumes
 * @property-read int|null $resumes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

