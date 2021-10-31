<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'id_card',
        // 'birth_date',
        'tel',
        'address',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
