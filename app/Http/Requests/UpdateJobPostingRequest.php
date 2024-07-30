<?php

namespace App\Http\Requests;

use App\Models\JobPosting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobPostingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_posting_edit');
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
            'job_type' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'expiry_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
