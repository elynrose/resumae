@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.requestResume.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.request-resumes.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="resume_id">{{ trans('cruds.requestResume.fields.resume') }}</label>
                            <select class="form-control select2" name="resume_id" id="resume_id" required>
                                @foreach($resumes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('resume_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <div>
                                <input type="hidden" name="accepted" value="0">
                                <input type="checkbox" name="accepted" id="accepted" value="1" {{ old('accepted', 0) == 1 ? 'checked' : '' }}>
                                <label for="accepted">{{ trans('cruds.requestResume.fields.accepted') }}</label>
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
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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

        </div>
    </div>
</div>
@endsection