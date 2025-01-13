<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::table('books')
            ->leftJoin('book_category_pivot', 'books.id', '=', 'book_category_pivot.book_id')
            ->leftJoin('book_categories', 'book_category_pivot.category_id', '=', 'book_categories.id')
            ->select('books.*', DB::raw('GROUP_CONCAT(book_categories.name SEPARATOR ", ") as category_names'))
            ->groupBy('books.id')
            ->get();
        return view('books.index', compact('books'));
    }


    public function create()
    {
        $categories = DB::table('book_categories')->get();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'book_category_ids' => 'required|array',
            'book_category_ids.*' => 'exists:book_categories,id',
            'thumbnail' => 'nullable|image|max:2048',
            'description' => 'required',
            'author' => 'required',
        ]);

        // Proses upload thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Simpan data buku ke tabel books
        $bookId = DB::table('books')->insertGetId([
            'name' => $request->name,
            'thumbnail' => $thumbnailPath,
            'description' => $request->description,
            'author' => $request->author,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Simpan data kategori buku ke tabel pivot book_category
        $categoriesToInsert = [];
        foreach ($request->book_category_ids as $categoryId) {
            $categoriesToInsert[] = [
                'book_id' => $bookId,
                'category_id' => $categoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('book_category_pivot')->insert($categoriesToInsert);

        return redirect()->route('books.index')->with('success', 'Book created successfully with multiple categories.');
    }

    public function edit($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        $categories = DB::table('book_categories')->get();
        $selectedCategories = DB::table('book_category_pivot')
            ->where('book_id', $id)
            ->pluck('category_id')
            ->toArray();

        return view('books.edit', compact('book', 'categories', 'selectedCategories'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'book_category_ids' => 'required|array',
            'book_category_ids.*' => 'exists:book_categories,id',
            'description' => 'nullable|string',
            'author' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Update data buku
        $updateData = [
            'name' => $request->name,
            'description' => $request->description,
            'author' => $request->author,
            'updated_at' => now(),
        ];

        // Jika ada file thumbnail baru yang diunggah
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $updateData['thumbnail'] = $path;
        }

        // Update data buku
        DB::table('books')->where('id', $id)->update($updateData);

        // Update kategori buku (hapus dulu, lalu tambahkan yang baru)
        DB::table('book_category_pivot')->where('book_id', $id)->delete();

        $categoriesToInsert = [];
        foreach ($request->book_category_ids as $categoryId) {
            $categoriesToInsert[] = [
                'book_id' => $id,
                'category_id' => $categoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('book_category_pivot')->insert($categoriesToInsert);

        return redirect()->route('books.index')->with('success', 'Book updated successfully with selected categories.');
    }


    public function show($id)
    {
        $book = DB::table('books')
            ->leftJoin('book_category_pivot', 'books.id', '=', 'book_category_pivot.book_id')
            ->leftJoin('book_categories', 'book_category_pivot.category_id', '=', 'book_categories.id')
            ->where('books.id', $id)
            ->select('books.*', DB::raw('GROUP_CONCAT(book_categories.name SEPARATOR ", ") as category_names'))
            ->groupBy('books.id')
            ->first();

        if (!$book) {
            return redirect()->route('books.index')->with('error', 'Book not found.');
        }

        return view('books.show', compact('book'));
    }

    // Export method
    public function export()
    {
        $books = DB::table('books')
            ->leftJoin('book_category_pivot', 'books.id', '=', 'book_category_pivot.book_id')
            ->leftJoin('book_categories', 'book_category_pivot.category_id', '=', 'book_categories.id')
            ->select('books.id', 'books.name', 'books.description', 'books.author', DB::raw('GROUP_CONCAT(book_categories.name SEPARATOR ", ") as category_names'))
            ->groupBy('books.id')
            ->get();

        return (new FastExcel($books))->download('Books.xlsx', function ($book) {
            return [
                'ID' => $book->id,
                'Name' => $book->name,
                'Description' => $book->description,
                'Author' => $book->author,
                'Categories' => $book->category_names,
            ];
        });
    }

    // Import method
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');

        (new FastExcel)->import($file, function ($line) {
            // Insert book and get the book ID
            $bookId = DB::table('books')->insertGetId([
                'name' => $line['Name'],
                'description' => $line['Description'],
                'author' => $line['Author'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Process categories (assume 'Categories' column is comma-separated)
            $categories = explode(',', $line['Categories']);
            $categoriesToInsert = [];
            
            foreach ($categories as $categoryName) {
                $categoryName = trim($categoryName);

                // Check if category exists, if not, skip
                $category = DB::table('book_categories')->where('name', $categoryName)->first();
                if ($category) {
                    $categoriesToInsert[] = [
                        'book_id' => $bookId,
                        'category_id' => $category->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Insert pivot table data
            if (!empty($categoriesToInsert)) {
                DB::table('book_category_pivot')->insert($categoriesToInsert);
            }
        });

        return redirect()->route('books.index')->with('success', 'Books imported successfully with multiple categories!');
    }



    public function destroy($id)
    {
        DB::table('books')->where('id', $id)->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
