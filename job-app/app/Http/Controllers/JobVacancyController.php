<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class JobVacancyController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(JobVacancy $jobVacancy)
    {
        return view('job-vacancies.show', compact('jobVacancy'));
    }

    /**
     * Show the application form page.
     **/
    public function apply(JobVacancy $jobVacancy)
    {

        $resumes = Auth::user()->resumes()->orderBy('updated_at', 'desc')->get();

        return view('job-vacancies.apply', compact('jobVacancy', 'resumes'));
    }

    /**
     * Store a new job application
     */
    public function storeApplication(StoreJobApplicationRequest $request, JobVacancy $jobVacancy)
    {
        // Get resume ID based on option
        if ($request->resume_option === 'existing') {
            $resumeId = $request->existing_resume_id;
        } else {
            $resumeId = $this->uploadNewResume($request->file('resume'));
        }

        // Check if user already applied with this resume
        $existingApplication = JobApplication::where('job_vacancy_id', $jobVacancy->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return redirect()
                ->route('job-vacancies.show', $jobVacancy)
                ->with('error', 'You have already applied to this job.');
        }

        // Create application
        JobApplication::create([
            'job_vacancy_id' => $jobVacancy->id,
            'resume_id' => $resumeId,
            'user_id' => Auth::id(),
            'status' => 'pending',
            'ai_generated_score' => 0,
            'ai_generated_feedback' => '',
        ]);


        #TODO: Evaluate Job application using AI API
        #TODO: Extract info from Resume

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Application submitted successfully!');
    }

    private function uploadNewResume($file)
    {
        $fileName = 'resume_' . time() . '.' . $file->extension();

        #TODO:Store file (you can enable cloud storage later)
        // $path = $file->storeAs('resumes', $fileName, 'cloud');

        $resume = Resume::create([
            'file_name' => $file->getClientOriginalName(),
            'file_url' => 'Just A test',
            'user_id' => Auth::id(),
            'contact_details' => json_encode([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]),
            'summary' => '',
            'skills' => '',
            'experience' => '',
            'education' => '',
        ]);

        return $resume->id;
    }
}
