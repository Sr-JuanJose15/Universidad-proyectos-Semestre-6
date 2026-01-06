<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku', 'description', 'category', 'supplier', 'purchase_price', 'sale_price', 'acquisition_date', 'quantity_in_stock', 'min_quantity', 'max_quantity',
    ];

    
    // Definir la relación con StockMovement
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }


    public function getFormattedAcquisitionDateAttribute()
    {
        return Carbon::parse($this->acquisition_date)->format('d-m-Y');
    }
    }
