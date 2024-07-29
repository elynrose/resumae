<?php

namespace App\Http\Requests;

use App\Models\RequestResume;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRequestResumeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('request_resume_edit');
    }

    public function rules()
    {
        return [
            'resume_id' => [
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
