<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Florist;
use App\Models\Order;
use App\Models\Invoice;
class Product extends Model
{
    use HasFactory;
   //inverse one to one relationship
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class ,'user_id');
    // }
    // public function order():BelongsTo{
    //     return $this->belongsTo(Order::class,'order_id');
    // }
    // public function florist():BelongsTo
    // {
    //     return $this->belongsTo(florist::class,'florist_id');
    // }
    protected $table ='products';

    protected $fillable=[
            'florist_id',
            'image',
            'name',
            'price',
            'description',
            'popular_id',
            'category_id',
            'special_occassion_id'
            // 'product_stock',
           
    ];

    public function florist(){
      return $this->belongsTo(Florist::class,'florist_id');
    }
    public function orders() {
        return $this->belongsToMany(Order::class);
    }
    public function invoiceItems() {
        
        return $this->belongsToMany(InvoiceItem::class);
    }
    public function popular() {
        
        return $this->belongsToMany(Popular::class);
    }
    public function category() {
        
        return $this->belongsToMany(Category::class);
    }
    public function specialoccassions() {
        
        return $this->belongsToMany(SpecialOccassion::class);
    }
}
