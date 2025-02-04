<div x-data="{ showModal: false, categoryIdToDelete: null }" class="">
    <!-- Menampilkan pesan success -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
            {{ session('message') }}
        </div>
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
    <div class="bg-white rounded-md shadow-md">
        <h2 class="text-2xl font-semibold p-4 border-b border-gray-300">Kelola Kategori Menu</h2>
        <div class="p-6">
            <div class="mb-8">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="flex items-center space-x-4">
    <!-- Label -->
    <div class="">
        <label class="text-sm font-semibold text-gray-700">Nama Kategori</label>
    </div>

    <!-- Input Field -->
    <div class="relative flex-grow">
        <input 
            type="text" 
            id="nama" 
            wire:model="nama" 
            class="w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
            placeholder="Contoh: Makanan"
        >
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-[1.02] shadow-md flex items-center justify-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
        </svg>
        {{ $isEdit ? 'Simpan Perubahan' : 'Buat Kategori Baru' }}
    </button>
</form>
            </div>
            <!-- Daftar kategori -->
            <div class="">
                <div class="rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-800 to-gray-700">
                            <tr>
                                <th scope="col" class="pl-6 pr-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600" wire:click="sortingBy('id')">
                                    <div class="flex items-center">
                                        No
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600" wire:click="sortingBy('nama')">
                                    <div class="flex items-center">
                                        Nama Kategori
                                    </div>
                                </th>
                                <th scope="col" class="pr-6 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($kategoris as $key => $kategori)
                                <tr class="transition duration-100 ease-in-out hover:bg-gray-50">
                                    <td class="pl-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $key + 1 }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-semibold">{{ $kategori->nama }}</div>
                                    </td>
                                    <td class="pr-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <button wire:click="edit({{ $kategori->id }})" class="flex items-center px-3 py-1.5 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                                <span class="ml-1.5 text-sm font-medium text-blue-600">Edit</span>
                                            </button>
                                            <button type="button" @click="showModal = true; categoryIdToDelete = {{ $kategori->id }}" class="flex items-center px-3 py-1.5 border border-red-500 rounded-lg hover:bg-red-50 transition-colors duration-200">
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
            <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus kategori ini?</p>
            <div class="flex justify-end space-x-3">
                <button @click="showModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button @click="showModal = false; $wire.delete(categoryIdToDelete)" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>