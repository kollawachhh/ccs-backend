<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'user_id',
        'type',
        'project_name',
        'appointment',
        'status',
        'cover_sheet',
        'fee_receipt',
        'contract',
        'construction_permit',
        'title_deed',
        'map',
        'plan',
        'value',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
