@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jobPosting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-postings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.id') }}
                        </th>
                        <td>
                            {{ $jobPosting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.job_title') }}
                        </th>
                        <td>
                            {{ $jobPosting->job_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.job_category') }}
                        </th>
                        <td>
                            {{ $jobPosting->job_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.job_type') }}
                        </th>
                        <td>
                            {{ App\Models\JobPosting::JOB_TYPE_SELECT[$jobPosting->job_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.description') }}
                        </th>
                        <td>
                            {!! $jobPosting->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.requirements') }}
                        </th>
                        <td>
                            {!! $jobPosting->requirements !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.expiry_date') }}
                        </th>
                        <td>
                            {{ $jobPosting->expiry_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-postings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection