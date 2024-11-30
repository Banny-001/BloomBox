<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;
use App\Models\Invoice;
class Florist extends Model
{
    use HasFactory;
//relationships inverse one to one
  
   
    protected $fillable =[
        'image',
        'business_name',
        'location',
        'user_id',
        'phone_number',
        'name',
        'email'

        
    ];
    //florists has many products
    public function products() {
        return $this->hasMany(Product::class,);
    }
    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
