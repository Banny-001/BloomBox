<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $Items = Item::all();
        return response()->json($Items);
    }
    public function indexView()
    {

        $items = Item::all();
        return view('items.index', compact('items'));
    }
    public function create()
    {
        return view('items.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'string|required|max:255',
            'productAmount' => 'int|required|max:255',
            'productDescription' => 'string|required|max:255',
            'productImagepath' => 'string|required|max:255',
            'productPoplar' => 'string|required|max:255',
            'productRating' => 'string|required|max:255',

        ]);
        Item::create([
            'productName' => $request->productName,
            'productAmount' => $request->productAmount,
            'productDescription' => $request->productDescription,
            'productPopular' => $request->productPopular,
            'productPRating' => $request->productRating,

        ]);

        return redirect('items/create')->with('status', 'Items Created');
    }

    public function edit(int $id)
    {
        $item = Item::findorFail($id);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'productName' => 'string|required|max:255',
            'productAmount' => 'int|required|max:255',
            'productDescription' => 'string|required|max:255',
            'productImagepath' => 'string|required|max:255',
            'productPoplar' => 'string|required|max:255',
            'productRating' => 'string|required|max:255',

        ]);
        Item::findorFail($id)->update([
            'productName' => $request->productName,
            'productAmount' => $request->productAmount,
            'productDescription' => $request->productDescription,
            'productPopular' => $request->productPopular,
            'productPRating' => $request->productRating,

        ]);


        return redirect()->back()->with('status', 'Items Updated');
    }
    public function destroy(int $id)
    {
        $item = Item::findorFail($id);
        $item->delete();

        return redirect()->back()->with('status', 'Item Deleted');
    }
}
