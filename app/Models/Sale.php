<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount',
        'vat',
        'paid_amount',
        'total',
        'due',
    ];
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
