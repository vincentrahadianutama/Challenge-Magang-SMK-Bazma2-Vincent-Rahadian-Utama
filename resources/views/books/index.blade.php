<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manage Books</h1>
            <a href="{{ route('books.create') }}" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition-all">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/></svg>
                Add Book
            </a>
        </div>

        <!-- Notifications -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Import Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
        <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-4">
    @csrf
    <div class="flex-1">
        <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Import Books</label>
        <input type="file" name="file" id="file" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300" required>
    </div>
    <button type="submit" class="inline-flex items-center bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition-all">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 00-1.414 0L10 10.586 7.707 8.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l6-6a1 1 0 000-1.414z"/></svg>
        Import
    </button>
</form>

<br>

    <a href="{{ route('books.export') }}" class="inline-flex items-center bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 transition-all">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 9a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 14a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/></svg>
        Export to Excel
    </a>

        </div>

        <!-- Table Section -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table id="bookTable" class="table-auto w-full border-collapse border border-gray-200">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 border border-gray-200 text-left font-semibold text-sm text-gray-700">ID</th>
            <th class="px-4 py-2 border border-gray-200 text-left font-semibold text-sm text-gray-700">Name</th>
            <th class="px-4 py-2 border border-gray-200 text-left font-semibold text-sm text-gray-700">Category</th>
            <th class="px-4 py-2 border border-gray-200 text-left font-semibold text-sm text-gray-700">Author</th>
            <th class="px-4 py-2 border border-gray-200 text-center font-semibold text-sm text-gray-700">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border border-gray-200 text-sm text-gray-700">{{ $book->id }}</td>
                <td class="px-4 py-2 border border-gray-200 text-sm text-gray-700">{{ $book->name }}</td>
                <td class="px-4 py-2 border border-gray-200 text-sm text-gray-700">{{ $book->category_names }}</td>
                <td class="px-4 py-2 border border-gray-200 text-sm text-gray-700">{{ $book->author }}</td>
                <td class="px-4 py-2 border border-gray-200 text-sm text-gray-700 text-center">
                    <a href="{{ route('books.show', $book->id) }}" class="inline-flex items-center bg-green-500 text-white px-2 py-1 rounded shadow hover:bg-green-600 transition-all">
                        View
                    </a>
                    <a href="{{ route('books.edit', $book->id) }}" class="inline-flex items-center bg-yellow-500 text-white px-2 py-1 rounded shadow hover:bg-yellow-600 transition-all">
                        Edit
                    </a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center bg-red-500 text-white px-2 py-1 rounded shadow hover:bg-red-600 transition-all" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>

    <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script>
    document.getElementById('exportExcel').addEventListener('click', () => {
        const table = document.getElementById('bookTable');  // Mendapatkan tabel berdasarkan ID
        const rows = table.querySelectorAll('tr');  // Mendapatkan semua baris dalam tabel

        // Membuat array untuk menyimpan data yang akan diexport (tanpa kolom Actions)
        const dataToExport = [];
        
        // Menyimpan header tabel (tanpa kolom Actions)
        const header = [];
        const headerCells = rows[0].querySelectorAll('th');
        for (let i = 0; i < headerCells.length - 1; i++) {  // Mengabaikan kolom terakhir (Actions)
            header.push(headerCells[i].innerText);
        }
        dataToExport.push(header);

        // Menyimpan data baris tabel (tanpa kolom Actions)
        rows.forEach((row, index) => {
            if (index > 0) {  // Skip header row
                const rowData = [];
                const cells = row.querySelectorAll('td');
                for (let i = 0; i < cells.length - 1; i++) {  // Mengabaikan kolom terakhir (Actions)
                    rowData.push(cells[i].innerText);
                }
                dataToExport.push(rowData);
            }
        });

        // Membuat worksheet dan workbook untuk eksport
        const worksheet = XLSX.utils.aoa_to_sheet(dataToExport);  // Mengonversi array ke worksheet
        const workbook = XLSX.utils.book_new();  // Membuat workbook baru
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Books');  // Menambahkan worksheet ke workbook
        XLSX.writeFile(workbook, 'Books.xlsx');  // Menyimpan workbook ke file Excel
    });
</script>


</x-app-layout>
