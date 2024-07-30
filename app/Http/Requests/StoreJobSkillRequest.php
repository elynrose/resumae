<?php

namespace App\Http\Requests;

use App\Models\JobSkill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJobSkillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_skill_create');
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
