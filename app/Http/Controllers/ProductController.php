<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        $categories = Category::get();
        return view('product.index', [
            'title' => 'Produk',
            'active' => 'active',
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $harga = str_replace('.', '', $request->input('price'));

        Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'price' => $harga,
            'qty' => $request->qty,
        ]);

        Session::flash('success', 'Produk berhasil ditambahkan.');

        return redirect('/produk');
    }

    public function update(Request $request, $id)
    {
        $harga = str_replace('.', '', $request->input('price'));
        
        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->price = $harga;
        $product->qty = $request->qty;
        
        $product->save();
        Session::flash('update', 'Berhasil update data produk');

        return redirect('/produk');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        Session::flash('success', 'Berhasil hapus data produk');
        return redirect('/produk');
    }
}
