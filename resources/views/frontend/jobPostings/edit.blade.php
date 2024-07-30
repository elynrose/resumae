@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.jobPosting.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.job-postings.update", [$jobPosting->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="job_title">{{ trans('cruds.jobPosting.fields.job_title') }}</label>
                            <input class="form-control" type="text" name="job_title" id="job_title" value="{{ old('job_title', $jobPosting->job_title) }}" required>
                            @if($errors->has('job_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobPosting.fields.job_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="job_category_id">{{ trans('cruds.jobPosting.fields.job_category') }}</label>
                            <select class="form-control select2" name="job_category_id" id="job_category_id" required>
                                @foreach($job_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('job_category_id') ? old('job_category_id') : $jobPosting->job_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobPosting.fields.job_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.jobPosting.fields.job_type') }}</label>
                            <select class="form-control" name="job_type" id="job_type" required>
                                <option value disabled {{ old('job_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\JobPosting::JOB_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('job_type', $jobPosting->job_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobPosting.fields.job_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.jobPosting.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $jobPosting->description) !!}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobPosting.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="requirements">{{ trans('cruds.jobPosting.fields.requirements') }}</label>
                            <textarea class="form-control ckeditor" name="requirements" id="requirements">{!! old('requirements', $jobPosting->requirements) !!}</textarea>
                            @if($errors->has('requirements'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('requirements') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobPosting.fields.requirements_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="expiry_date">{{ trans('cruds.jobPosting.fields.expiry_date') }}</label>
                            <input class="form-control date" type="text" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $jobPosting->expiry_date) }}" required>
                            @if($errors->has('expiry_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('expiry_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobPosting.fields.expiry_date_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('frontend.job-postings.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $jobPosting->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection