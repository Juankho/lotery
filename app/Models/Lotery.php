<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'rules',
    ];

    public function scopeApplyFilters($query, array $filters)
    {

        $filters = collect($filters);

        if ($filters->get('search')) {
            $query->where('name', 'like', '%' . $filters->get('search') . '%')
                ->orWhere('rules', 'like', '%' . $filters->get('search') . '%')
                ->orWhere('description', 'like', '%' . $filters->get('search') . '%');
        }


        if ($filters->get('status')) {
            $query->where('status', $filters->get('status'));
        }
        

        return $query;
    }


}
