<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'status',
        'phone',
        'notify_by',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    protected  function password(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => bcrypt($value),
        );
    }

    public function scopeApplyFilters($query, array $filters)
    {

        $filters = collect($filters);

        if ($filters->get('search')) {
            $query->where('name', 'like', '%' . $filters->get('search') . '%')
                ->orWhere('email', 'like', '%' . $filters->get('search') . '%')
                ->orWhere('phone', 'like', '%' . $filters->get('search') . '%')
                ->orWhere('id', $filters->get('search'));
        }

        if ($filters->get('role')) {
            $query->where('role_id', $filters->get('role'));
        }

        if ($filters->get('status')) {
            $query->where('status', $filters->get('status'));
        }

        if ($filters->get('createdAt')) {
            $query->whereDate('created_at', $filters->get('createdAt'));
        }

        return $query;
    }

    public static function insertTypeNotification($userId, $notificationId)
    {
        return self::where('id', $userId)->update(["notify_by" => $notificationId]);
    }
}
