<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Florist;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        // 'invoiceitem_id',
        'invoice_date',
        'total_amount',
        'florist_id',
        'due_date'
    ];
   
    
    public function florists() {
        return $this->belongsToMany(Florist::class);
    }
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
