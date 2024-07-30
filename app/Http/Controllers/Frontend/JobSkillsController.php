<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJobSkillRequest;
use App\Http\Requests\StoreJobSkillRequest;
use App\Http\Requests\UpdateJobSkillRequest;
use App\Models\JobPosting;
use App\Models\JobSkill;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobSkillsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_skill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobSkills = JobSkill::with(['job_posting'])->get();

        return view('frontend.jobSkills.index', compact('jobSkills'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_skill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_postings = JobPosting::pluck('job_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.jobSkills.create', compact('job_postings'));
    }

    public function store(StoreJobSkillRequest $request)
    {
        $jobSkill = JobSkill::create($request->all());

        return redirect()->route('frontend.job-skills.index');
    }

    public function edit(JobSkill $jobSkill)
    {
        abort_if(Gate::denies('job_skill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_postings = JobPosting::pluck('job_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobSkill->load('job_posting');

        return view('frontend.jobSkills.edit', compact('jobSkill', 'job_postings'));
    }

    public function update(UpdateJobSkillRequest $request, JobSkill $jobSkill)
    {
        $jobSkill->update($request->all());

        return redirect()->route('frontend.job-skills.index');
    }

    public function show(JobSkill $jobSkill)
    {
        abort_if(Gate::denies('job_skill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobSkill->load('job_posting');

        return view('frontend.jobSkills.show', compact('jobSkill'));
    }

    public function destroy(JobSkill $jobSkill)
    {
        abort_if(Gate::denies('job_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobSkill->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobSkillRequest $request)
    {
        $jobSkills = JobSkill::find(request('ids'));

        foreach ($jobSkills as $jobSkill) {
            $jobSkill->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
