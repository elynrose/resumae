@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mySkill.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.my-skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.id') }}
                        </th>
                        <td>
                            {{ $mySkill->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.company') }}
                        </th>
                        <td>
                            {{ $mySkill->company }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.job_title') }}
                        </th>
                        <td>
                            {{ $mySkill->job_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.job_category') }}
                        </th>
                        <td>
                            {{ $mySkill->job_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.start_date') }}
                        </th>
                        <td>
                            {{ $mySkill->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.end_date') }}
                        </th>
                        <td>
                            {{ $mySkill->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.to_present') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $mySkill->to_present ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.skills') }}
                        </th>
                        <td>
                            @foreach($mySkill->skills as $key => $skills)
                                <span class="label label-info">{{ $skills->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.comments') }}
                        </th>
                        <td>
                            {!! $mySkill->comments !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.my_resume') }}
                        </th>
                        <td>
                            {{ $mySkill->my_resume->resume ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mySkill.fields.user') }}
                        </th>
                        <td>
                            {{ $mySkill->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.my-skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection