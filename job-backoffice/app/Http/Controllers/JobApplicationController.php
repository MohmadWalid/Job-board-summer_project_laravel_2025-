<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationUpdateRequest;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobApplication::latest();

        // 2. Filter by Company Owner role
        if (Auth::user()->role === 'company-owner') {
            // Fetch the first company from the 'companies' HasMany relationship
            $company = Auth::user()->companies()->first();

            $query->whereHas('job_vacancy', function ($q) use ($company) {
                $q->where('company_id', $company->id);
            });
        }


        // 3. Handle Archived (Soft Deletes)
        if ($request->input('archived') == 'true') {
            $query->onlyTrashed();
        }

        // Paginate the results with 10 items per page and 1 link on each side
        $jobApplications = $query->paginate(10)->onEachSide(1);

        // Pass to view
        return view('job-application.index', compact('jobApplications'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);

        return view('job-application.show', compact('jobApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);

        return view('job-application.edit', compact('jobApplication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->update([
            'status' => $validated['status'],
        ]);

        // Redirect based on where the user came from
        $redirectTo = $request->input('redirect', 'index');

        if ($redirectTo === 'show')
            return redirect()->route('job-applications.show', $id)->with('success', 'Application Status updated successfully!');
        else
            return redirect()->route('job-applications.index')->with('success', 'Application Status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->delete();
        return redirect()->route('job-applications.index')->with('success', 'Job Application archived successfully!');
    }

    public function restore(string $id)
    {
        $jobApplication = JobApplication::withTrashed()->findOrFail($id);
        $jobApplication->restore();
        return redirect()->route('job-applications.index', ['archived' => 'true'])->with('success', 'Job Application restored successfully!');
    }
}
