<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserInfoValidation extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return  auth()->id();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = auth()->id();

		return [
			'name' => 'required|string',
			'icon' => 'nullable|mimes:jpg,jpeg,png',
			'new_password' => [
				'nullable',
				'confirmed',
				Rule::requiredIf(function () {
					return request()->filled('old_password');
				})
			],
			'old_password' => [
				'nullable',
				function ($attribute, $value, $fail) use ($id) {
					if (!Hash::check($value, User::find($id)->password)) {
						$fail('舊密碼不正確');
					}
				},
				Rule::requiredIf(function () {
					return request()->filled('new_password');
				})
			]
		];
	}

	public function attributes()
	{
		return [
			'name' => '名稱',
			'icon' => '頭像',
			'old_password' => '舊密碼',
			'new_password' => '密碼',
		];
	}
}
