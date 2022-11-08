<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterBySearchParams($query, $input)
    {
        if ($input['name']) {
            $query->where('name', 'like', '%' . addslashes($input['name']) . '%');
        }

        if ($input['bedrooms']) {
            $query->where('bedrooms', $input['bedrooms']);
        }

        if ($input['bathrooms']) {
            $query->where('bathrooms', $input['bathrooms']);
        }

        if ($input['storeys']) {
            $query->where('storeys', $input['storeys']);
        }

        if ($input['garages']) {
            $query->where('garages', $input['garages']);
        }

        if ($input['price'] && count($input['price']) === 2) {
            $query->whereBetween('price', $input['price']);
        }

        return $query;
    }
}
