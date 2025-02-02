<div class="">
    <!-- Menampilkan pesan success -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-md shadow-md">
        <h2 class="text-2xl font-semibold p-4 border-b border-gray-300">Kelola Kategori Menu</h2>
        <div class="p-6">
            <!-- Form untuk tambah / edit kategori -->
            <div class="mb-6">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="flex items-end space-x-4">
                    <div class="flex-1">
                        <label for="nama" class="block text-sm font-medium text-gray-700 flex items-center">
                            Nama Kategori
                        </label>
                        <input type="text" id="nama" wire:model="nama" class="mt-1 block w-full p-4 border border-gray-300 rounded-md outline-none" placeholder="Masukkan nama kategori">
                        @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="px-4 py-4 bg-orange-500 text-white rounded-md flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ $isEdit ? 'Update Kategori' : 'Tambah Kategori' }}
                    </button>
                </form>
            </div>

            
    <!-- Daftar kategori -->
    <div class="">
    <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
    <tr>
        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortingBy('id')">
            No
            @if ($sortBy === 'id')
                @if ($sortDirection === 'asc')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                @endif
            @endif
        </th>
        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortingBy('nama')"> 
            Nama Kategori
            @if ($sortBy === 'nama')
                @if ($sortDirection === 'asc')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                @endif
            @endif
        </th>
        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Aksi
        </th>
    </tr>
</thead>


            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($kategoris as $key => $kategori)
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">
                            {{ $key + 1 }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            {{ $kategori->nama }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap flex space-x-2">
                            <button wire:click="edit({{ $kategori->id }})" class="flex items-center px-2 py-1 bg-yellow-500 text-white rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <button wire:click="delete({{ $kategori->id }})" class="flex items-center px-2 py-1 bg-red-500 text-white rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


        </div>
    </div>
</div>
