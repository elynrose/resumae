@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.requestResume.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.request-resumes.update", [$requestResume->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="resume_id">{{ trans('cruds.requestResume.fields.resume') }}</label>
                <select class="form-control select2 {{ $errors->has('resume') ? 'is-invalid' : '' }}" name="resume_id" id="resume_id" required>
                    @foreach($resumes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('resume_id') ? old('resume_id') : $requestResume->resume->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('resume'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resume') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestResume.fields.resume_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('accepted') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="accepted" value="0">
                    <input class="form-check-input" type="checkbox" name="accepted" id="accepted" value="1" {{ $requestResume->accepted || old('accepted', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="accepted">{{ trans('cruds.requestResume.fields.accepted') }}</label>
                </div>
                @if($errors->has('accepted'))
                    <div class="invalid-feedback">
                        {{ $errors->first('accepted') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestResume.fields.accepted_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.requestResume.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $requestResume->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestResume.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection