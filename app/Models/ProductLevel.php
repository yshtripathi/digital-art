<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLevel extends Model
{
    protected $table = 'product_levels';

    protected $fillable = [
        'course_id',
        'skill_level',
        'skill_level_jp',
        'purpose',
        'purpose_jp',
        'learn_info',
        'learn_info_jp',
        'outcome',
        'outcome_jp',
        'price',
        'price_jp',
        'price_hk',
        'price_in_points'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'course_id', 'id');
    }
}
