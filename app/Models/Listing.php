<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Listing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'email',
        'logo',
        'tags',
        'company',
        'location',
        'description',
    ];

    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getListing($params = [
        'user_id' => '',
        'perPage' => ''
    ])
    {
        $user_id = $params['user_id'] ?? '';
        $perPage = $params['perPage'] ?? 6;

        $query = DB::table('listings as L')
            ->select('L.id', 'L.user_id', 'L.title', 'L.tags', 'L.company', 'L.email', 'L.description', 'imgs.img_url AS logo')
            ->leftJoin('imgs', 'L.id', '=', 'imgs.table_id')
            ->where(function ($q) {
                $q->where('imgs.table_name', 'listings')
                    ->orWhereNull('imgs.table_name');
            });

        if ($user_id) {
            $query->where('L.user_id', $user_id);
        }
        return $query->orderBy('L.id')
            ->paginate($perPage);
    }
}
