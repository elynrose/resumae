@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.jobSkill.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.job-skills.update", [$jobSkill->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="job_posting_id">{{ trans('cruds.jobSkill.fields.job_posting') }}</label>
                <select class="form-control select2 {{ $errors->has('job_posting') ? 'is-invalid' : '' }}" name="job_posting_id" id="job_posting_id" required>
                    @foreach($job_postings as $id => $entry)
                        <option value="{{ $id }}" {{ (old('job_posting_id') ? old('job_posting_id') : $jobSkill->job_posting->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_posting'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_posting') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobSkill.fields.job_posting_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="skills">{{ trans('cruds.jobSkill.fields.skills') }}</label>
                <input class="form-control {{ $errors->has('skills') ? 'is-invalid' : '' }}" type="text" name="skills" id="skills" value="{{ old('skills', $jobSkill->skills) }}" required>
                @if($errors->has('skills'))
                    <div class="invalid-feedback">
                        {{ $errors->first('skills') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobSkill.fields.skills_helper') }}</span>
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