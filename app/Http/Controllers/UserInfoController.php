<?php

namespace App\Http\Controllers;

use \App\Models\User;
use App\Helpers\ImgurHelper;
use App\Models\Img;
use App\Http\Requests\UserInfoValidation;
use Illuminate\Support\Facades\Hash;



class UserInfoController extends Controller
{
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{

		$imgUrl = Img::getOneImgUrl([
			'table_name' => 'users',
			'table_id' => $user->id,
		]);
		$user->icon = $imgUrl;

		return view('userInfo.edit', ['user' => $user]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UserInfoValidation $request, User $user)
	{


		$formFields = $request->validated();


		// 更新密碼
		if ($request->has('new_password')) {
			$user =  User::find(auth()->id());
			$user->update([
				'password' => Hash::make($formFields['new_password']),
			]);
		}

		if ($request->hasFile('icon')) {

			// 刪除舊圖片
			$imgs = Img::where('table_name', 'users')
				->where('table_id', auth()->id())->get();
			$deleteHashes = $imgs->pluck('delete_hash')->toArray();
			foreach ($deleteHashes as $key => $deleteHash) {
				ImgurHelper::curl_remove_img($deleteHash, env('IMGUR_CLIENT_ID'));
			}
			// 刪除資料庫資料
			$imgs->each->delete();

			// 上傳新圖片
			$uploadResult = ImgurHelper::uploadToImgur($request->file('icon'), env('IMGUR_CLIENT_ID'));
			Img::createFromUploadResult($uploadResult);
		}

		$user->update($formFields);
		return back()->with('success', '更新成功');
	}
}
