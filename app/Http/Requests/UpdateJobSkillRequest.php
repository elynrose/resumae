<?php

namespace App\Http\Requests;

use App\Models\JobSkill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobSkillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_skill_edit');
    }

    public function rules()
    {
        return [
            'job_posting_id' => [
                'required',
                'integer',
            ],
            'skills' => [
                'string',
                'required',
            ],
        ];
    }
}
