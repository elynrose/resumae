<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJobPostingRequest;
use App\Http\Requests\StoreJobPostingRequest;
use App\Http\Requests\UpdateJobPostingRequest;
use App\Models\JobCategory;
use App\Models\JobPosting;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class JobPostingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('job_posting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobPostings = JobPosting::with(['job_category'])->get();

        return view('admin.jobPostings.index', compact('jobPostings'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_posting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.jobPostings.create', compact('job_categories'));
    }

    public function store(StoreJobPostingRequest $request)
    {
        $jobPosting = JobPosting::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $jobPosting->id]);
        }

        return redirect()->route('admin.job-postings.index');
    }

    public function edit(JobPosting $jobPosting)
    {
        abort_if(Gate::denies('job_posting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobPosting->load('job_category');

        return view('admin.jobPostings.edit', compact('jobPosting', 'job_categories'));
    }

    public function update(UpdateJobPostingRequest $request, JobPosting $jobPosting)
    {
        $jobPosting->update($request->all());

        return redirect()->route('admin.job-postings.index');
    }

    public function show(JobPosting $jobPosting)
    {
        abort_if(Gate::denies('job_posting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobPosting->load('job_category');

        return view('admin.jobPostings.show', compact('jobPosting'));
    }

    public function destroy(JobPosting $jobPosting)
    {
        abort_if(Gate::denies('job_posting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobPosting->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobPostingRequest $request)
    {
        $jobPostings = JobPosting::find(request('ids'));

        foreach ($jobPostings as $jobPosting) {
            $jobPosting->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('job_posting_create') && Gate::denies('job_posting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new JobPosting();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
