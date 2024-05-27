<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Kyslik\ColumnSortable\Sortable;

class Listing extends Model
{
    use HasFactory, Sortable;

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

    public $sortable = [
        'id',
        'title',
        'name',
        'location',
        'updated_at'
    ];

    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getListing($params = [
        'user_id' => '',
        'perPage' => '',
        'search' => '',
        'sort' => '',
        'direction' => '',
    ])
    {
        $user_id = $params['user_id'] ?? '';
        $perPage = $params['perPage'] ?? '';
        $search = $params['search'] ?? '';

        $sort = $params['sort'] ?? '';
        $direction = $params['direction'] ?? '';

        $query = DB::table('listings as L')
            ->select('L.id', 'L.user_id', 'L.title', 'L.tags', 'L.company', 'L.email', 'L.description', 'imgs.img_url AS logo', 'L.location', 'L.updated_at')
            ->leftJoin('imgs', function ($join) {
                $join->on('L.id', '=', 'imgs.table_id')
                    ->where('imgs.table_name', '=', 'listings');
            });

        if ($user_id) {
            $query->where('L.user_id', $user_id);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('L.title', 'like', '%' . $search . '%')
                    ->orWhere('L.description', 'like', '%' . $search . '%')
                    ->orWhere('L.tags', 'like', '%' . $search . '%')
                    ->orWhere('L.email', 'like', '%' . $search . '%')
                    ->orWhere('L.company', 'like', '%' . $search . '%');
            });
        }

        if ($sort && $direction) {
            $query->orderBy($sort, $direction);
        }

        if ($perPage) {
            return $query->orderBy('L.id', 'desc')->paginate($perPage);
        } else {
            return $query->orderBy('L.id', 'desc')->get();
        }
    }
}
