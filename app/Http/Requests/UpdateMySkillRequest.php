<?php

namespace App\Http\Requests;

use App\Models\MySkill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMySkillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('my_skill_edit');
    }

    public function rules()
    {
        return [
            'job_title' => [
                'string',
                'required',
            ],
            'job_category_id' => [
                'required',
                'integer',
            ],
            'skills.*' => [
                'integer',
            ],
            'skills' => [
                'required',
                'array',
            ],
            'comments' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
