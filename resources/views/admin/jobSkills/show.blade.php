@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jobSkill.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jobSkill.fields.id') }}
                        </th>
                        <td>
                            {{ $jobSkill->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobSkill.fields.job_posting') }}
                        </th>
                        <td>
                            {{ $jobSkill->job_posting->job_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobSkill.fields.skills') }}
                        </th>
                        <td>
                            {{ $jobSkill->skills }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection