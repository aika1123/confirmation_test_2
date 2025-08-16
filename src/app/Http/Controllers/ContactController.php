<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Season;

class ContactController extends Controller
{
    public function create()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function store(StoreProductRequest $request)
    {
        $imagePath = $request->file('image')->store('images', 'public');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        $product->seasons()->attach($request->season);

        return redirect()->route('products.list');
    }

    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->filled('search')) {
            $keyword = trim($request->search);
            $query->where('name', 'link', '%' . $keyword . '%');
        }

        if($request->has('sort')) {
            if($request->sort == 'high'){
                $query->orderBy('price', 'desc');
            }
            elseif ($request->sort == 'low'){
                $query->orderBy('price', 'asc');
            }
        }
        $products = $query->paginate(6)->appends($request->all());

        return view('list', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();
        return view('detail', compact('product', 'seasons'));
    }
}
