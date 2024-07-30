<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMySkillRequest;
use App\Http\Requests\StoreMySkillRequest;
use App\Http\Requests\UpdateMySkillRequest;
use App\Models\JobCategory;
use App\Models\MyResume;
use App\Models\MySkill;
use App\Models\Skill;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MySkillsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('my_skill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mySkills = MySkill::with(['job_category', 'skills', 'my_resume', 'user'])->get();

        return view('frontend.mySkills.index', compact('mySkills'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_skill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skills = Skill::pluck('name', 'id');

        $my_resumes = MyResume::pluck('resume', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.mySkills.create', compact('job_categories', 'my_resumes', 'skills', 'users'));
    }

    public function store(StoreMySkillRequest $request)
    {
        $mySkill = MySkill::create($request->all());
        $mySkill->skills()->sync($request->input('skills', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mySkill->id]);
        }

        return redirect()->route('frontend.my-skills.index');
    }

    public function edit(MySkill $mySkill)
    {
        abort_if(Gate::denies('my_skill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skills = Skill::pluck('name', 'id');

        $my_resumes = MyResume::pluck('resume', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mySkill->load('job_category', 'skills', 'my_resume', 'user');

        return view('frontend.mySkills.edit', compact('job_categories', 'mySkill', 'my_resumes', 'skills', 'users'));
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

        $mySkill->load('job_category', 'skills', 'my_resume', 'user');

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('my_skill_create') && Gate::denies('my_skill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MySkill();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
