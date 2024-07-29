<?php

namespace App\Http\Requests;

use App\Models\MyResume;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMyResumeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('my_resume_edit');
    }

    public function rules()
    {
        return [
            'resume' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
