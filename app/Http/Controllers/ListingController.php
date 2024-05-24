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
        $listings = DB::table('listings as L')
            ->select('L.id', 'L.user_id', 'L.title', 'L.tags', 'L.company', 'L.email', 'L.description', 'imgs.img_url AS logo')
            ->leftJoin('imgs', 'L.id', '=', 'imgs.table_id')
            ->where(function ($query) {
                $query->where('imgs.table_name', 'listings')
                    ->orWhereNull('imgs.table_name');
            })
            ->orderBy('L.id')
            ->get();


        // $listings = Listing::all()->sortByDesc("id");
        return view('listings.index', [
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
            $imgurClientId = env('IMGUR_CLIENT_ID');
            $uploadResult = ImgurHelper::uploadToImgur($request->file('logo'), $imgurClientId);
            if (
                $uploadResult
                && $uploadResult['data']
                && $uploadResult['data']['link']
                && $uploadResult['data']['deletehash']
            ) {
                Img::create([
                    'img_url' => $uploadResult['data']['link'],
                    'delete_hash' => $uploadResult['data']['deletehash'],
                    'table_name' => 'listings',
                    'column_name' => 'logo',
                    'table_id' => $newListing->id,
                ]);
            }
        }

        return redirect('dashboard')->with('success', '新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        $img = Img::where('table_name', 'listings')
            ->where('table_id', $listing->id)
            ->where('table_name', 'listings')
            ->latest('created_at')
            ->first();


        $imgUrl = $img->img_url ?? '';
        $listing->logo = $imgUrl ?? '';

        return view('listings.show', [
            "listing" => $listing,
        ]);
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
            $imgurClientId = env('IMGUR_CLIENT_ID');
            foreach ($deleteHashes as $key => $deleteHash) {
                ImgurHelper::curl_remove_img($deleteHash, $imgurClientId);
            }
            $imgs->each->delete();


            // 上傳新圖片
            $imgurClientId = env('IMGUR_CLIENT_ID');
            $uploadResult = ImgurHelper::uploadToImgur($request->file('logo'), $imgurClientId);
            if (
                $uploadResult
                && $uploadResult['data']
                && $uploadResult['data']['link']
                && $uploadResult['data']['deletehash']
            ) {
                Img::create([
                    'img_url' => $uploadResult['data']['link'],
                    'delete_hash' => $uploadResult['data']['deletehash'],
                    'table_name' => 'listings',
                    'column_name' => 'logo',
                    'table_id' => $listing->id,
                ]);
            }
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

        return back()->with('success', '刪除成功');
    }

    // Manage Listings
    public function manage()
    {
        $listings = auth()->user()->listings()->orderBy('id','desc')->paginate(5);
        return view('dashboard', [
            'listings' => $listings,
            'page'=>request()->input('page') ?? '1',
        ]);
    }
}
