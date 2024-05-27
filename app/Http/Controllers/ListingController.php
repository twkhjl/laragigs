<?php

namespace App\Http\Controllers;

use App\Helpers\ImgurHelper;
use App\Models\Img;
use \App\Models\Listing;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ListingValidation;

class ListingController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$listings = Listing::getListing([
			'perPage' => 6,
		]);

		return view('listings.index', [
			"listings" => $listings,
		]);
	}

	public function lazyload()
	{
		$listings = Listing::getListing([
			'perPage' => 6
		]);

		return view('listings.card-list', ['listings' => $listings])->render();
	}

	public function searchResult()
	{

		$listings = Listing::getListing([
			'perPage' => 6,
			'search' => request('search') ?? ''
		]);

		return view('listings.search-result', [
			"listings" => $listings,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('listings.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ListingValidation $request)
	{

		$formFields = $request->validated();

		$formFields['user_id'] = auth()->id();

		$newListing = Listing::create($formFields);

		if ($request->hasFile('logo')) {

			// 上傳新圖片
			$uploadResult = ImgurHelper::uploadToImgur($request->file('logo'), env('IMGUR_CLIENT_ID'));

			// 新增資料庫資料
			Img::createFromUploadResult([
				'uploadResult' => $uploadResult,
				'table_name' => 'listings',
				'table_id' => $newListing->id,
				'column_name' => 'logo',
			]);
		}

		return redirect('dashboard')->with('success', '新增成功');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Listing $listing)
	{
		$img = Img::where('table_name', 'listings')
			->where('table_id', $listing->id)
			->where('table_name', 'listings')
			->latest('created_at')
			->first();

		$imgUrl = $img->img_url ?? '';
		$listing->logo = $imgUrl ?? '';


		return view('listings.edit', ['listing' => $listing]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ListingValidation $request, Listing $listing)
	{

		// Make sure logged in user is owner
		if ($listing->user_id != auth()->id()) {
			abort(403, 'Unauthorized Action');
		}

		$formFields = $request->validated();


		if ($request->hasFile('logo')) {

			// 刪除舊圖片
			$imgs = Img::where('table_name', 'listings')->where('table_id', $listing->id)->get();
			$deleteHashes = $imgs->pluck('delete_hash')->toArray();
			foreach ($deleteHashes as $key => $deleteHash) {
				ImgurHelper::curl_remove_img($deleteHash, env('IMGUR_CLIENT_ID'));
			}

			// 刪除資料庫舊資料
			$imgs->each->delete();


			// 上傳新圖片
			$uploadResult = ImgurHelper::uploadToImgur($request->file('logo'), env('IMGUR_CLIENT_ID'));

			// 新增資料庫資料
			Img::createFromUploadResult([
				'uploadResult' => $uploadResult,
				'table_name' => 'listings',
				'table_id' => $listing->id,
				'column_name' => 'logo',
			]);
		}

		$listing->update($formFields);

		return back()->with('success', '更新成功');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Listing $listing)
	{
		if ($listing->user_id != auth()->id()) {
			abort(403, 'Unauthorized Action');
		}

		// 刪除舊圖片
		$imgs = Img::where('table_name', 'listings')->where('table_id', $listing->id)->get();
		$deleteHashes = $imgs->pluck('delete_hash')->toArray();
		$imgurClientId = env('IMGUR_CLIENT_ID');
		foreach ($deleteHashes as $key => $deleteHash) {
			ImgurHelper::curl_remove_img($deleteHash, $imgurClientId);
		}
		$imgs->each->delete();

		$listing->delete();

		return back()->with('success', '刪除成功');
	}

	// 批次刪除
	public function destroyAll()
	{

		if (!request()->input('inputItemIDs')) return null;

		$idArr = explode(',', request()->input('inputItemIDs'));

		if (
			!is_array($idArr)
			|| (is_array($idArr) && count($idArr) <= 0)
		) return null;

		// 刪除舊圖片
		$imgs = Img::where('table_name', 'listings')->whereIn('table_id', $idArr)->get();
		$deleteHashes = $imgs->pluck('delete_hash')->toArray();
		$imgurClientId = env('IMGUR_CLIENT_ID');
		foreach ($deleteHashes as $key => $deleteHash) {
			ImgurHelper::curl_remove_img($deleteHash, $imgurClientId);
		}
		$imgs->each->delete();

		// 刪除資料庫
		Listing::whereIn('id', $idArr)->delete();

		return back()->with('success', '刪除成功');
	}

	// Manage Listings
	public function manage()
	{
		$listings = Listing::getListing([
			'user_id' => auth()->user()->id,
			'perPage' => 5,
			'search' => request('search') ?? '',
			'sort' =>request()->input('sort') ?? '',
			'direction' =>request()->input('direction') ?? '',
		]);

		return view('dashboard', [
			'listings' => $listings,
			'page' => request()->input('page') ?? '1',
		]);
	}
}
