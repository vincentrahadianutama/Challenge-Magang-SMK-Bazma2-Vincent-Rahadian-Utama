<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
            {{ __('Books Contact') }}
        </h2>
    </x-slot>

    <body class="bg-gray-50">
        <div class="flex justify-center items-center min-h-screen">
            <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
                <h3 class="text-2xl font-semibold text-gray-800 text-center mb-6">Hubungi Kami</h3>

                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('post-email') }}" method="post" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Title</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                            placeholder="Title"
                            required
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Tujuan (Pisahkan dengan koma)</label>
                        <textarea 
                            name="email" 
                            id="email" 
                            rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="contoh1@email.com, contoh2@email.com"
                            required
                        ></textarea>
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700">Body Deskripsi</label>
                        <textarea 
                            name="body" 
                            id="body" 
                            rows="5"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Tulis pesan Anda di sini..."
                            required
                        ></textarea>
                    </div>

                    <div class="text-center">
                        <button 
                            type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kirim Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</x-app-layout>
