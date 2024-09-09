<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'accompaniment_id',
         'price',
         'quantity'


    ];
    public function products() {
        return $this->belongsToMany(Product::class);
    }
    public function accompaniment()
    {
        return $this->belongsTo(Accompaniment::class);
    }
    //not in the table
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
