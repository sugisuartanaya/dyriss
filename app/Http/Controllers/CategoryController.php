<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $businesses = Business::all();
        return view('category.index',[
            'title' => 'Kategori',
            'active' => 'active',
            'categories' => $categories,
            'businesses' => $businesses
        ]);
    }

    public function store(Request $request)
    {
        Category::create([
            'business_id' => $request->business_id,
            'category_name' => $request->category_name,
        ]);

        Session::flash('success', 'Kategori berhasil ditambahkan.');

        return redirect('/kategori');
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->business_id = $request->business_id;
        $category->category_name = $request->category_name;
        
        $category->save();
        Session::flash('update', 'Berhasil update data kategori');

        return redirect('/kategori');
    }

   
    public function destroy($id)
    {
        Category::find($id)->delete();
        Session::flash('success', 'Berhasil hapus data kategori');
        return redirect('/kategori');
    }
}
