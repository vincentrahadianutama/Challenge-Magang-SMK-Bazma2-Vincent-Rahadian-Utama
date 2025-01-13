<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Membuat tabel books
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Nama buku
            $table->string('thumbnail')->nullable(); // Thumbnail buku (opsional)
            $table->text('description'); // Deskripsi buku
            $table->string('author'); // Penulis buku
            $table->timestamps(); // Timestamp created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel books jika rollback
        Schema::dropIfExists('books');
    }
};