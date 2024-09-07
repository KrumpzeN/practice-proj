<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\Cache;

class BikeController extends Controller
{
    public function index()
    {
        $currentPage = request()->get('page', 1);
        $cacheKey = 'bikes_list_page_' . $currentPage;

        $bikes = Cache::remember($cacheKey, 60, function() {
            return Bike::with(['bikeBrand', 'bikeType'])->paginate(8);
        });

        return view('bikes.index', ['bikes' => $bikes]);
    }

    public function create()
    {
        return view('bikes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bike_brand_id' => 'required|exists:bike_brands,id',
            'bike_type_id' => 'required|exists:bike_types,id',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'article' => 'required|string|unique:bikes,article',
        ]);

        $bike = Bike::create($validatedData);
        
        Cache::flush();

        return redirect()->route('bikes.show', $bike);
    }

    public function show(Bike $bike)
    {
        return view('bikes.show', compact('bike'));
    }

    public function edit(Bike $bike)
    {
        return view('bikes.edit', compact('bike'));
    }

    public function update(Request $request, Bike $bike)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bike_brand_id' => 'required|exists:bike_brands,id',
            'bike_type_id' => 'required|exists:bike_types,id',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'article' => 'required|string|unique:bikes,article,' . $bike->id,
        ]);

        $bike->update($validatedData);

        Cache::flush();

        return redirect()->route('bikes.show', $bike);
    }

    public function destroy(Bike $bike)
    {
        $bike->delete();

        Cache::flush();

        return redirect()->route('bikes.index');
    }

    public function apiIndex()
    {
        $bikes = Bike::with(['bikeBrand', 'bikeType'])->get();
        return response()->json($bikes);
    }
}
