<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;
use App\Models\Accompaniment;
use App\Models\Customer;

class Order extends Model
{
    use HasFactory;
    //  public function product():HasMany
    // {
    //     return $this->hasMany(Product::class,'product_id');
    // }

    // public function user() :BelongsTo
    // {
    //     return $this->belongsTo(user::class,'user_id');
    // }
    //  <th>product_id</th>
    // <th>accompaniment_id</th>
    // <th>customer_id</th>
    // <th>Payment Mode</th>
    // <th>Status Message</th>
    // <th>Action</th>

    protected $fillable = [
        'product_id',
        'tracking_no',
        'customer_id',
        'accompaniment_id',
        'payment_mode',
        'status_message',
        'ordered_date',
        'total_price',
        'action'
    ];
    public function products() {
        return $this->hasMany(Product::class);
    }
    public function accompaniments(){
        return $this->hasMany(Accompaniment::class);
    }
    public function customer() {
        return $this->hasMany(Customer::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
