<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMyResumeRequest;
use App\Http\Requests\StoreMyResumeRequest;
use App\Http\Requests\UpdateMyResumeRequest;
use App\Models\MyResume;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MyResumeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('my_resume_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myResumes = MyResume::with(['user', 'media'])->get();

        return view('admin.myResumes.index', compact('myResumes'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_resume_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.myResumes.create', compact('users'));
    }

    public function store(StoreMyResumeRequest $request)
    {
        $myResume = MyResume::create($request->all());

        if ($request->input('resume_pdf', false)) {
            $myResume->addMedia(storage_path('tmp/uploads/' . basename($request->input('resume_pdf'))))->toMediaCollection('resume_pdf');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $myResume->id]);
        }

        return redirect()->route('admin.my-resumes.index');
    }

    public function edit(MyResume $myResume)
    {
        abort_if(Gate::denies('my_resume_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $myResume->load('user');

        return view('admin.myResumes.edit', compact('myResume', 'users'));
    }

    public function update(UpdateMyResumeRequest $request, MyResume $myResume)
    {
        $myResume->update($request->all());

        if ($request->input('resume_pdf', false)) {
            if (! $myResume->resume_pdf || $request->input('resume_pdf') !== $myResume->resume_pdf->file_name) {
                if ($myResume->resume_pdf) {
                    $myResume->resume_pdf->delete();
                }
                $myResume->addMedia(storage_path('tmp/uploads/' . basename($request->input('resume_pdf'))))->toMediaCollection('resume_pdf');
            }
        } elseif ($myResume->resume_pdf) {
            $myResume->resume_pdf->delete();
        }

        return redirect()->route('admin.my-resumes.index');
    }

    public function show(MyResume $myResume)
    {
        abort_if(Gate::denies('my_resume_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myResume->load('user');

        return view('admin.myResumes.show', compact('myResume'));
    }

    public function destroy(MyResume $myResume)
    {
        abort_if(Gate::denies('my_resume_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myResume->delete();

        return back();
    }

    public function massDestroy(MassDestroyMyResumeRequest $request)
    {
        $myResumes = MyResume::find(request('ids'));

        foreach ($myResumes as $myResume) {
            $myResume->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('my_resume_create') && Gate::denies('my_resume_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MyResume();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
