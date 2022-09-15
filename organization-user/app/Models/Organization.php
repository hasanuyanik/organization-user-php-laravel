<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone',
        'address'
    ];

    /**
     * Get the user in the organization
     */
    public function user()
    {
        return $this->hasOne(User::class, 'uuid', 'uuid');
    }
}
