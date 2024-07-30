<?php

namespace App\Http\Requests;

use App\Models\MySkill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMySkillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('my_skill_create');
    }

    public function rules()
    {
        return [
            'company' => [
                'string',
                'required',
            ],
            'job_title' => [
                'string',
                'required',
            ],
            'job_category_id' => [
                'required',
                'integer',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date' => [
                'string',
                'nullable',
            ],
            'skills.*' => [
                'integer',
            ],
            'skills' => [
                'required',
                'array',
            ],
            'my_resume_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
