@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.myResume.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.my-resumes.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="resume">{{ trans('cruds.myResume.fields.resume') }}</label>
                            <textarea class="form-control" name="resume" id="resume" required>{{ old('resume') }}</textarea>
                            @if($errors->has('resume'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('resume') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myResume.fields.resume_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="resume_pdf">{{ trans('cruds.myResume.fields.resume_pdf') }}</label>
                            <div class="needsclick dropzone" id="resume_pdf-dropzone">
                            </div>
                            @if($errors->has('resume_pdf'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('resume_pdf') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myResume.fields.resume_pdf_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.myResume.fields.user') }}</label>
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
                            <span class="help-block">{{ trans('cruds.myResume.fields.user_helper') }}</span>
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
    Dropzone.options.resumePdfDropzone = {
    url: '{{ route('frontend.my-resumes.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="resume_pdf"]').remove()
      $('form').append('<input type="hidden" name="resume_pdf" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="resume_pdf"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($myResume) && $myResume->resume_pdf)
      var file = {!! json_encode($myResume->resume_pdf) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="resume_pdf" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection