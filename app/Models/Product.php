<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
