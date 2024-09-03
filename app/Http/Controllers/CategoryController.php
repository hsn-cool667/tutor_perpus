<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.kategori',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ],[
            'name.unique' => 'Nama Kategori Sudah digunakan'
        ]);

        try{
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            return redirect()->route('kategori.store')->with('success', 'Kategori berhasil dibuat');
        }catch(\Exception $e){
            Log::error("Error Creating: ". $e->getMessage());
            return redirect()->back()->with('error', 'gagal membuat kategori, coba lagi');
        }
    }

    public function destroy(Request $request, $id)
    {
        try{
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('kategori')->with('success', 'kategori berhasil hapus');
        }catch(\Exception $e){
            Log::error("Error Delete: ". $e->getMessage());
            return redirect()->back()->with('error', 'gagal hapus kategori, coba lagi');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try{
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->save();

            return redirect()->route('kategori')->with('success', 'kategori berhasil diupdate');
        } catch(\Exception $e){
            Log::error("Error Update: " .$e->getMessage());
            return redirect()->back()->with('error','Gagal memperbarui kategori, silahkan coba lagi');
        }
    }
}
