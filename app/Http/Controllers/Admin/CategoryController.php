<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Kategori modelini içeri aktardık

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $category = new Category();
        $category->title = $request->title;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Kategori başarıyla eklendi.');
    }

    public function show($id)
    {
        // Kategori detayına gerek yok, listeleme ve düzenleme yeterli.
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $category = Category::findOrFail($id);
        $category->title = $request->title;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Kategori başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Kategori başarıyla silindi.');
    }
}