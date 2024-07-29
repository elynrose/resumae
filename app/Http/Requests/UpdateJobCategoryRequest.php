<?php

namespace App\Http\Requests;

use App\Models\JobCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_category_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
