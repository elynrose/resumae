<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyJobCategoryRequest;
use App\Http\Requests\StoreJobCategoryRequest;
use App\Http\Requests\UpdateJobCategoryRequest;
use App\Models\JobCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobCategoriesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('job_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobCategories = JobCategory::all();

        return view('admin.jobCategories.index', compact('jobCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jobCategories.create');
    }

    public function store(StoreJobCategoryRequest $request)
    {
        $jobCategory = JobCategory::create($request->all());

        return redirect()->route('admin.job-categories.index');
    }

    public function edit(JobCategory $jobCategory)
    {
        abort_if(Gate::denies('job_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jobCategories.edit', compact('jobCategory'));
    }

    public function update(UpdateJobCategoryRequest $request, JobCategory $jobCategory)
    {
        $jobCategory->update($request->all());

        return redirect()->route('admin.job-categories.index');
    }

    public function show(JobCategory $jobCategory)
    {
        abort_if(Gate::denies('job_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jobCategories.show', compact('jobCategory'));
    }

    public function destroy(JobCategory $jobCategory)
    {
        abort_if(Gate::denies('job_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobCategoryRequest $request)
    {
        $jobCategories = JobCategory::find(request('ids'));

        foreach ($jobCategories as $jobCategory) {
            $jobCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
