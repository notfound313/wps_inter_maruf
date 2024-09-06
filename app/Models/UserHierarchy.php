<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserHierarchy extends Model
{
     
    public $timestamps = false;
    protected $fillable = [
        'subordinate_id',
        'supervisor_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'subordinate_id');
    }
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }


}
