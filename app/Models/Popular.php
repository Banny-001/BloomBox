<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popular extends Model
{
    use HasFactory;
    protected $fillable=[
        'reason',
        'product_id',
        'populariy_score'
    ];
    public function product(){
        return  $this->hasMany(Product::class);
     }

 }
