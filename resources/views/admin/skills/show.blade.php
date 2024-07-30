@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.skill.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.skill.fields.id') }}
                        </th>
                        <td>
                            {{ $skill->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skill.fields.name') }}
                        </th>
                        <td>
                            {{ $skill->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skill.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $skill->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#skills_my_skills" role="tab" data-toggle="tab">
                {{ trans('cruds.mySkill.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="skills_my_skills">
            @includeIf('admin.skills.relationships.skillsMySkills', ['mySkills' => $skill->skillsMySkills])
        </div>
    </div>
</div>

@endsection