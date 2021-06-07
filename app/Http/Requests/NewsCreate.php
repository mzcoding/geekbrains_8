<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
			'category_id' => ['required', 'integer'],
			'title' => ['required', 'string', 'min:5', 'max:190'],
			'description' => ['required']
        ];
    }

  /*  public function messages(): array
	{
		return [
			'required' => ":attribute необходимо заполнить"
		];
	}
	public function attributes(): array
	{
		return [
			'title' => 'заголовок новости'
		];
	}*/
}
