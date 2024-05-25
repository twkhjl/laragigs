<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Helpers\ImgurHelper;

class Img extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_url',
        'delete_hash',
        'table_name',
        'column_name',
        'table_id',
    ];


    // 根據上傳圖片回傳結果新增資料庫紀錄
    public static function createFromUploadResult($params = [
        'uploadResult' => '',
        'table_name' => '',
        'table_id' => '',
        'column_name' => '',
    ])
    {
        if (!$params) return null;
        $uploadResult = $params['uploadResult'] ?? '';
        $table_name = $params['table_name'] ?? '';
        $table_id = $params['table_id'] ?? '';
        $column_name = $params['column_name'] ?? '';

        if (!$uploadResult) return null;
        if (!$table_name) return null;
        if (!$table_id) return null;

        if (
            !$uploadResult
            || !$uploadResult['data']
            || !$uploadResult['data']['link']
            || !$uploadResult['data']['deletehash']
        ) {
            return;
        }

        Img::create([
            'img_url' => $uploadResult['data']['link'],
            'delete_hash' => $uploadResult['data']['deletehash'],
            'table_name' => $table_name,
            'column_name' => $column_name,
            'table_id' => $table_id,
        ]);
    }

    // 取得單一圖片
    public static function getOneImgUrl($params = [
        'table_name' => '',
        'table_id' => '',
    ])
    {
        if (!$params) return null;
        $table_name = $params['table_name'] ?? '';
        $table_id = $params['table_id'] ?? '';

        if (!$table_name) return null;
        if (!$table_id) return null;

        $img = Img::where('table_name', $table_name)
            ->where('table_id', $table_id)
            ->where('table_name', $table_name)
            ->latest('created_at')
            ->first();

        $imgUrl = $img && $img->img_url ? $img->img_url : '';

        return $imgUrl;
    }
}
