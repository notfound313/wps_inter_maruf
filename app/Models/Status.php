<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name'];

   
    public function dailyLogs()
    {
        return $this->hasMany(DailyLog::class);
    }
}
