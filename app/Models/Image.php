<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [ 'path', 'status'];

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
