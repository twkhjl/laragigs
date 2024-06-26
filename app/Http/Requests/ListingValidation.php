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
		

		return [
			'title' => 'required',
			'tags' => 'required|string',
			'email' => ['required', 'email'],
			'location' => ['nullable', 'string'],
			'company' => ['required', function ($attribute, $value, $fail) use ($id) {
				$query = \App\Models\Listing::where('company', $value)
					->where('title', $this->title);

				if ($id) {
					$query->where('id', '!=', $id);
				}

				if ($query->exists()) {
					$fail(trans('listings.The combination of company and title already exists.'));
				}
			}],
			'description' => 'required',
			'logo' => 'mimes:jpg,jpeg,png',
		];
	}

	public function attributes()
	{
		return [
			'title' => trans("listings.title"),
			'tags' => trans("listings.tags"),
			'location' => trans("listings.location"),
			'email' => trans("listings.email"),
			'company' => trans("listings.company"),
			'description' => trans("listings.description"),
			'website' => trans("listings.website"),
		];
	}
}
