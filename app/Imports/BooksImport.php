<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\BookCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    /**
     * Model data dari file Excel ke tabel database.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Cari kategori berdasarkan nama (pastikan nama kategori di Excel sudah sesuai)

        return new Book([
            'name' => $row[1],
            'book_category_id' => $row[2],
            'author' => $row[3],
        ]);
    }
}