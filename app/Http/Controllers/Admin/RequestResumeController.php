<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRequestResumeRequest;
use App\Http\Requests\StoreRequestResumeRequest;
use App\Http\Requests\UpdateRequestResumeRequest;
use App\Models\MyResume;
use App\Models\RequestResume;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestResumeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('request_resume_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestResumes = RequestResume::with(['resume', 'user'])->get();

        return view('admin.requestResumes.index', compact('requestResumes'));
    }

    public function create()
    {
        abort_if(Gate::denies('request_resume_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resumes = MyResume::pluck('resume', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.requestResumes.create', compact('resumes', 'users'));
    }

    public function store(StoreRequestResumeRequest $request)
    {
        $requestResume = RequestResume::create($request->all());

        return redirect()->route('admin.request-resumes.index');
    }

    public function edit(RequestResume $requestResume)
    {
        abort_if(Gate::denies('request_resume_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resumes = MyResume::pluck('resume', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $requestResume->load('resume', 'user');

        return view('admin.requestResumes.edit', compact('requestResume', 'resumes', 'users'));
    }

    public function update(UpdateRequestResumeRequest $request, RequestResume $requestResume)
    {
        $requestResume->update($request->all());

        return redirect()->route('admin.request-resumes.index');
    }

    public function show(RequestResume $requestResume)
    {
        abort_if(Gate::denies('request_resume_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestResume->load('resume', 'user');

        return view('admin.requestResumes.show', compact('requestResume'));
    }

    public function destroy(RequestResume $requestResume)
    {
        abort_if(Gate::denies('request_resume_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestResume->delete();

        return back();
    }

    public function massDestroy(MassDestroyRequestResumeRequest $request)
    {
        $requestResumes = RequestResume::find(request('ids'));

        foreach ($requestResumes as $requestResume) {
            $requestResume->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
