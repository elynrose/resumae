@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.mySkill.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.my-skills.update", [$mySkill->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="job_title">{{ trans('cruds.mySkill.fields.job_title') }}</label>
                            <input class="form-control" type="text" name="job_title" id="job_title" value="{{ old('job_title', $mySkill->job_title) }}" required>
                            @if($errors->has('job_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mySkill.fields.job_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="job_category_id">{{ trans('cruds.mySkill.fields.job_category') }}</label>
                            <select class="form-control select2" name="job_category_id" id="job_category_id" required>
                                @foreach($job_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('job_category_id') ? old('job_category_id') : $mySkill->job_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mySkill.fields.job_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="skills">{{ trans('cruds.mySkill.fields.skills') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="skills[]" id="skills" multiple required>
                                @foreach($skills as $id => $skill)
                                    <option value="{{ $id }}" {{ (in_array($id, old('skills', [])) || $mySkill->skills->contains($id)) ? 'selected' : '' }}>{{ $skill }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('skills'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('skills') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mySkill.fields.skills_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comments">{{ trans('cruds.mySkill.fields.comments') }}</label>
                            <input class="form-control" type="text" name="comments" id="comments" value="{{ old('comments', $mySkill->comments) }}">
                            @if($errors->has('comments'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comments') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mySkill.fields.comments_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.mySkill.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $mySkill->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mySkill.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection