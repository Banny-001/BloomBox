<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class Accompaniment extends Model
{
    use HasFactory;
    // protected $table='accompaniment';
    
    protected $fillable=[
          'product_id',
          'accompaniment_name',
          'accompaniment_image',
          'accompaniment_price'
    ];
    public function orders() {
        return $this->hasMany(Order::class);
    }
    public function products() {
        return $this->belongsTo(Product::class);
    }
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
