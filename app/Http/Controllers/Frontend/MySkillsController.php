<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMySkillRequest;
use App\Http\Requests\StoreMySkillRequest;
use App\Http\Requests\UpdateMySkillRequest;
use App\Models\JobCategory;
use App\Models\MySkill;
use App\Models\Skill;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MySkillsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_skill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mySkills = MySkill::with(['job_category', 'skills', 'user'])->get();

        return view('frontend.mySkills.index', compact('mySkills'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_skill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skills = Skill::pluck('name', 'id');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.mySkills.create', compact('job_categories', 'skills', 'users'));
    }

    public function store(StoreMySkillRequest $request)
    {
        $mySkill = MySkill::create($request->all());
        $mySkill->skills()->sync($request->input('skills', []));

        return redirect()->route('frontend.my-skills.index');
    }

    public function edit(MySkill $mySkill)
    {
        abort_if(Gate::denies('my_skill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skills = Skill::pluck('name', 'id');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mySkill->load('job_category', 'skills', 'user');

        return view('frontend.mySkills.edit', compact('job_categories', 'mySkill', 'skills', 'users'));
    }

    public function update(UpdateMySkillRequest $request, MySkill $mySkill)
    {
        $mySkill->update($request->all());
        $mySkill->skills()->sync($request->input('skills', []));

        return redirect()->route('frontend.my-skills.index');
    }

    public function show(MySkill $mySkill)
    {
        abort_if(Gate::denies('my_skill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mySkill->load('job_category', 'skills', 'user');

        return view('frontend.mySkills.show', compact('mySkill'));
    }

    public function destroy(MySkill $mySkill)
    {
        abort_if(Gate::denies('my_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mySkill->delete();

        return back();
    }

    public function massDestroy(MassDestroyMySkillRequest $request)
    {
        $mySkills = MySkill::find(request('ids'));

        foreach ($mySkills as $mySkill) {
            $mySkill->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
