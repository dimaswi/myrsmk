<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'bagian',
        'unit',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notifications()
    {
        return $this->hasMany(Notifica::class, 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public static function adminOrStaff()
    {
        if (Auth::user()->admin || Auth::user()->staff) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeSearch( $query, $value)
    {
        $query->where('name','LIKE', "%{$value}%")->orWhere('username','LIKE', "%{$value}%")->orWhere('phone','LIKE', "%{$value}%");
    }
}
