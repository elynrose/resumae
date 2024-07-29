<?php

namespace App\Http\Requests;

use App\Models\RequestResume;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRequestResumeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('request_resume_create');
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
