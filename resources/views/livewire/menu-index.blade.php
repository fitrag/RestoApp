<div x-data="{ showModal: false, menuIdToDelete: null }" class="">
    <!-- Menampilkan pesan success -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
            {{ session('message') }}
        </div>
    @endif
    @if ($isEdit && $menuId)
        @php
        $menu = \App\Models\Menu::find($menuId);
        @endphp
    @endif

    <!-- Error Message -->
    @error('nama')
        <div class="flex items-center mb-4 p-4 bg-red-500 text-white rounded-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <span class="text-sm">{{ $message }}</span>
        </div>
    @enderror

    <div wire:loading>
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <!-- Spinner Loading -->
            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </div>
    </div>

    <div class="bg-white rounded-md shadow-md">
        <h2 class="text-2xl font-semibold p-4 border-b border-gray-300">Kelola Menu Restoran</h2>
        <div class="p-6">
        <div class="mb-8">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-6" enctype="multipart/form-data">
            <div>
                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                <div x-data="{ isDragging: false, showPreview: {{ $isEdit && $menuId ? 'true' : 'false' }} }">
                    <!-- Input File -->
                    @if ($isEdit && $menuId)
                    <div class="flex gap-x-4">
                        <div class="mt-2 relative">
                            <img src="{{ $gambar ? $gambar->temporaryUrl() : ($isEdit && $menuId ? asset('storage/' . $menu->gambar) : '') }}" alt="Preview Gambar" class="w-48 object-cover rounded-md">
                        </div>
                        <div class="flex-1">
                            <div 
                                @dragover="isDragging = true" 
                                @dragleave="isDragging = false" 
                                @drop="isDragging = false"
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg transition-colors duration-300 ease-in-out hover:border-blue-500 {{ $errors->has('gambar') ? 'border-red-500' : 'border-gray-300' }}"
                                :class="isDragging ? 'border-blue-500 bg-blue-50' : ''">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="gambar" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload a file</span>
                                            <input id="gambar" name="gambar" type="file" wire:model="gambar" class="sr-only" @change="showPreview = true; isDragging = false">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="flex gap-x-4">
                        
                    <!-- Preview Gambar -->
                    <div class="mt-2 relative">
                        <img src="{{ $gambar && !$isEdit ? $gambar->temporaryUrl() : 'https://coffective.com/wp-content/uploads/2018/06/default-featured-image.png.jpg' }}" alt="Preview Gambar" class="w-48 object-cover rounded-md">
                    </div>
                    <div class="flex-1">
                        <div 
                            @dragover="isDragging = true" 
                            @dragleave="isDragging = false" 
                            @drop="isDragging = false"
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg transition-colors duration-300 ease-in-out hover:border-blue-500 {{ $errors->has('gambar') ? 'border-red-500' : 'border-gray-300' }}"
                            :class="isDragging ? 'border-blue-500 bg-blue-50' : ''">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="gambar" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="gambar" name="gambar" type="file" wire:model="gambar" class="sr-only" @change="showPreview = true; isDragging = false">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>
                    </div>
                    @endif

                </div>

                <!-- Error Message -->
                @error('gambar') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

                <!-- Nama Menu dan Harga -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                        <input 
                            type="text" 
                            id="nama" 
                            wire:model="nama" 
                            class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
                            placeholder="Contoh: Nasi Goreng"
                        >
                        @error('nama') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input 
                            type="number" 
                            id="harga" 
                            wire:model="harga" 
                            class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
                            placeholder="Contoh: 25000"
                        >
                        @error('harga') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea 
                        id="deskripsi" 
                        wire:model="deskripsi" 
                        rows="3"
                        class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
                        placeholder="Contoh: Nasi goreng dengan bumbu rempah khas Indonesia."
                    ></textarea>
                    @error('deskripsi') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select 
                        id="kategori_id" 
                        wire:model="kategori_id" 
                        class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="px-4 py-2 bg-gradient-to-r text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-[1.02] shadow-md flex items-center justify-center w-full md:w-auto {{ $isEdit ? 'from-green-400 to-green-500 hover:from-green-600 hover:to-green-700' : 'from-blue-400 to-blue-500 hover:from-blue-600 hover:to-blue-700' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    {{ $isEdit ? 'Simpan Perubahan' : 'Buat Menu Baru' }}
                </button>
            </form>
        </div>

            <!-- Daftar Menu -->
            <div class="">
                <div class="rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-800 to-gray-700">
                            <tr>
                                <th scope="col" class="pl-6 pr-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">No</div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">Nama Menu</div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">Deskripsi</div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">Harga</div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">Kategori</div>
                                </th>
                                <th scope="col" class="pr-6 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($menus as $key => $menu)
                                <tr class="transition duration-100 ease-in-out hover:bg-gray-50">
                                    <td class="pl-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $key + 1 }}</td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-semibold">{{ $menu->nama }}</div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $menu->deskripsi }}</div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-green-600 font-bold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $menu->kategori->nama }}</div>
                                    </td>
                                    <td class="pr-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <button wire:click="edit({{ $menu->id }})" class="flex items-center px-3 py-1.5 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                                <span class="ml-1.5 text-sm font-medium text-blue-600">Edit</span>
                                            </button>
                                            <button type="button" @click="showModal = true; menuIdToDelete = {{ $menu->id }}" class="flex items-center px-3 py-1.5 border border-red-500 rounded-lg hover:bg-red-50 transition-colors duration-200">
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                <span class="ml-1.5 text-sm font-medium text-red-600">Hapus</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus menu ini?</p>
            <div class="flex justify-end space-x-3">
                <button @click="showModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button @click="showModal = false; $wire.delete(menuIdToDelete)" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>