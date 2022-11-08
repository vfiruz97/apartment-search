<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertySearchRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::paginate(
            request()->input('per_page', 50),
            ['name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages'],
            'page',
            request()->input('page', 1)
        );

        $most_expensive = (int) Property::max('price');
        $cheapest       = (int) Property::min('price');

        return Inertia::render('Index', [
            'properties' => $properties,
            'price'     => [$cheapest,  $most_expensive]
        ]);
    }

    /**
     * Search Property
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(PropertySearchRequest $request)
    {
        $input = $request->validated();
        $properties = Property::filterBySearchParams($input)
            ->paginate(
                request()->input('per_page', 50),
                ['name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages'],
                'page',
                request()->input('page', 1)
            );

        return response()->json([
            'properties' => $properties
        ]);
    }
}
