<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderStock =  $request->short_stock ? 'stock' : 'name';
        $upStock = $request->up_stock ? 'stock' : 'name';
        $products = Product::where('name', 'LIKE' , '%' . $request->search_obat . '%')->orderby($orderStock , 'ASC')->simplepaginate(6)->appends($request->all());
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required|min:3',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ],[
         'name.required' => 'nama produk harus diisi',
         'name.max' => 'nama produk maximal 100 karakter',
         'type.required' => 'jenis produk harus diisi',
         'type.min' => 'jenis produk minimal 3',
         'price.required' => 'harga produk harus diisi',
         'price.numeric' => 'isi hanya angka',
         'stock.required' => 'stok produk harus diisi',
        ]);
 
        /**
        *create : elquem
        *'name' diambil dari migration $request->name : di inputan
        **/
        Product::create([
         'name' => $request->name,
         'type' => $request->type,
         'price' => $request->price,
         'stock' => $request->stock
        ]);
 
        /**
         * kembali ke halaman awal form dengan pesan
        */
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
     }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::where('id' , $id)->first();
        return view('product.edit' , compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
        ]);

        Product::where('id' , $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
        ]);
        return redirect()->route('product.index')->with('success', 'Data berhasil diubah');
    }

    public function updateStock(Request $request, string $id)
    {
        $request->validate([
            'stock' => 'required',
        ]);

        Product::where('id' , $id)->update([
            'stock' => $request->stock,
        ]);
        return redirect()->back()->with('success', 'Stock berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Produk berhasil di hapus');
    }
}
