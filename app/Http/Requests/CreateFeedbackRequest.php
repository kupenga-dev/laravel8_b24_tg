<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Http\FormRequest;

class CreateFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'fullname' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL]+(\s[\pL]+)+$/u'
            ],
            'birthday' => 'required|date|before:today',
            'phone' => [
                'required',
                'regex:/^(\+7|8)[0-9]{10}$/'
            ],
            'email' => 'required|email|max:255',
            'comment' => 'nullable|string'
        ];
    }
}
