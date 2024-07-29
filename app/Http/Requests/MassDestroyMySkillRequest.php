<?php

namespace App\Http\Requests;

use App\Models\MySkill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMySkillRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('my_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:my_skills,id',
        ];
    }
}
