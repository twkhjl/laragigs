<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingValidation extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// 編輯
		if ($this->listing && $this->listing->user_id) {
			return auth()->id() && $this->listing->user_id == auth()->id();
		}

		// 新增
		return auth()->id();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = null;
		if ($this->listing && $this->listing->id) {
			$id = $this->listing->id;
		}
		$companyUniqueRule = 'unique:listings,company';
		if ($id) {
			$companyUniqueRule .= ",{$id}";
		}

		return [
			'title' => 'required',
			'company' => ['required', $companyUniqueRule],
			'email' => ['required', 'email'],
			'description' => 'required',
			'logo' => 'mimes:jpg,jpeg,png',
		];
	}

	public function attributes()
	{
		return [
			'company' => '公司名稱',
			'email' => '',
			'title' => '職稱',
			'tags' => '關鍵字',
			'website' => '公司網站',
			'location' => '工作地點',
			'description' => '工作描述',
		];
	}
}
