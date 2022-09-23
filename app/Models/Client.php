<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['email', 'join_date'];
    public $timestamps = false;

    /**
     * > This function returns all the payments that belong to this user
     *
     * @return A collection of all the payments associated with the user.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }
}
