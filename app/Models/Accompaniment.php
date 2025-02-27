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
          'name',
          'image',
          'price',
          'description'
    ];
    public function orders() {
        return $this->hasMany(Order::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
