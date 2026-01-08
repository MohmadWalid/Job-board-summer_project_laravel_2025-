<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCategoryCreateRequest;
use App\Http\Requests\JobCategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start the query with the latest active categories.
        $query = Category::latest();

        // Conditionally apply the onlyTrashed() scope if 'archived' is 'true'
        if ($request->input('archived') == 'true') {
            $query->onlyTrashed();
        }

        // Paginate the results with 10 items per page and 1 link on each side
        $categories = $query->paginate(10)->onEachSide(1);

        // Pass to view
        return view('job-category.index')->with('JobCategories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCategoryCreateRequest $request)
    {
        $validated = $request->validated();
        Category::create($validated);

        return redirect()->route('job-categories.index')->with('success', 'Job category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('job-category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobCategoryUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('job-categories.index')->with('success', 'Job category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('job-categories.index')->with('success', 'Job category archived successfully!');
    }

    public function restore(string $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('job-categories.index', ['archived' => 'true'])->with('success', 'Job category restored successfully!');
    }
}
