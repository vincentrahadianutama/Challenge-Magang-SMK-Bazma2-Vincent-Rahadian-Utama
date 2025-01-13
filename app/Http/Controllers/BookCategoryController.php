<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookCategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('book_categories')->get();
        return view('book_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('book_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:book_categories,name',
        ]);

        DB::table('book_categories')->insert([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('book_categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = DB::table('book_categories')->where('id', $id)->first();
        return view('book_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:book_categories,name,' . $id,
        ]);

        DB::table('book_categories')->where('id', $id)->update([
            'name' => $request->name,
            'updated_at' => now(),
        ]);

        return redirect()->route('book_categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('book_categories')->where('id', $id)->delete();
        return redirect()->route('book_categories.index')->with('success', 'Category deleted successfully.');
    }
}
