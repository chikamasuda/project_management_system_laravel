<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;


class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|max:191',
            'email'    => 'email|unique:clients|unique:clients,email,' . $this->id . ',id',
            'status'   => 'required',
            'image'    => 'max:1024|mimes:jpg,jpeg,png,gif',
            'tags'     => 'array',
            'tags.*'   => 'max:10',
            'site_url' => 'url',
        ];
    }

    /**
     * バリデーション失敗時の挙動
     *
     * @param Validator $validator
     * @return JsonResponse
     */
    protected function failedValidation(Validator $validator): JsonResponse
    {
        $response['data']    = [];
        $response['status']  = '422';
        $response['summary'] = 'Failed validation.';
        $response['errors']  = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json(['data' => $response], 422)
        );
    }
}
