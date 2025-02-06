<div x-data="{ showModal: false, couponIdToDelete: null }" class="">
    <!-- Menampilkan pesan success -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <!-- Error Message -->
    @error('code')
        <div class="flex items-center mb-4 p-4 bg-red-500 text-white rounded-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <span class="text-sm">{{ $message }}</span>
        </div>
    @enderror

    <!-- Loading Spinner -->
    <div wire:loading>
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </div>
    </div>

    <!-- Container Utama -->
    <div class="bg-white rounded-md shadow-md">
        <h2 class="text-2xl font-semibold p-4 border-b border-gray-300">Kelola Kupon Diskon</h2>
        <div class="p-6">
            <!-- Form Input -->
            <div class="mb-8">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-6">
                <!-- Grid Layout untuk Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode Kupon -->
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">Kode Kupon</label>
                        <input 
                            type="text" 
                            id="code" 
                            wire:model="code" 
                            class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
                            placeholder="Contoh: DISCOUNT50"
                        >
                        @error('code') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <!-- Jenis Diskon -->
                    <div>
                        <label for="discount_type" class="block text-sm font-medium text-gray-700">Jenis Diskon</label>
                        <select 
                            id="discount_type" 
                            wire:model="discount_type" 
                            class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                        >
                            <option value="percentage">Persentase (%)</option>
                            <option value="fixed">Nilai Tetap (Rp)</option>
                        </select>
                        @error('discount_type') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <!-- Nilai Diskon -->
                    <div>
                        <label for="discount_value" class="block text-sm font-medium text-gray-700">Nilai Diskon</label>
                        <input 
                            type="number" 
                            id="discount_value" 
                            wire:model="discount_value" 
                            class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
                            placeholder="Contoh: 50"
                        >
                        @error('discount_value') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <!-- Minimum Order -->
                    <div>
                        <label for="minimum_order" class="block text-sm font-medium text-gray-700">Minimum Order</label>
                        <input 
                            type="number" 
                            id="minimum_order" 
                            wire:model="minimum_order" 
                            class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
                            placeholder="Contoh: 100000"
                        >
                        @error('minimum_order') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <!-- Berlaku Sampai -->
                    <div>
                        <label for="valid_until" class="block text-sm font-medium text-gray-700">Berlaku Sampai</label>
                        <input 
                            type="date" 
                            id="valid_until" 
                            wire:model="valid_until" 
                            class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
                        >
                        @error('valid_until') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <!-- Batas Penggunaan -->
                    <div>
                        <label for="usage_limit" class="block text-sm font-medium text-gray-700">Batas Penggunaan</label>
                        <input 
                            type="number" 
                            id="usage_limit" 
                            wire:model="usage_limit" 
                            class="mt-1 block w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
                            placeholder="Contoh: 100"
                        >
                        @error('usage_limit') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-[1.02] shadow-md flex items-center justify-center w-full md:w-auto">
                    {{ $isEdit ? 'Simpan Perubahan' : 'Buat Kupon Baru' }}
                </button>
            </form>
            </div>

            <!-- Daftar Kupon Diskon -->
            <div class="">
                <div class="rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-800 to-gray-700">
                            <tr>
                                <th scope="col" class="pl-6 pr-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">
                                        No
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">
                                        Kode Kupon
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">
                                        Jenis Diskon
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">
                                        Nilai Diskon
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">
                                        Minimum Order
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider cursor-pointer transition duration-150 ease-in-out hover:bg-gray-600">
                                    <div class="flex items-center">
                                        Berlaku Sampai
                                    </div>
                                </th>
                                <th scope="col" class="pr-6 py-4 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($coupons as $key => $coupon)
                                <tr class="transition duration-100 ease-in-out hover:bg-gray-50">
                                    <td class="pl-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $key + 1 }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-semibold">{{ $coupon->code }}</div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-semibold">{{ ucfirst($coupon->discount_type) }}</div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-semibold">
                                            @if ($coupon->discount_type === 'percentage')
                                                {{ $coupon->discount_value }}%
                                            @else
                                                Rp {{ number_format($coupon->discount_value, 0, ',', '.') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-semibold">
                                            @if ($coupon->minimum_order)
                                                Rp {{ number_format($coupon->minimum_order, 0, ',', '.') }}
                                            @else
                                                Tidak ada minimum
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-semibold">{{ $coupon->valid_until }}</div>
                                    </td>
                                    <td class="pr-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <button wire:click="edit({{ $coupon->id }})" class="flex items-center px-3 py-1.5 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                                <span class="ml-1.5 text-sm font-medium text-blue-600">Edit</span>
                                            </button>
                                            <button type="button" @click="showModal = true; couponIdToDelete = {{ $coupon->id }}" class="flex items-center px-3 py-1.5 border border-red-500 rounded-lg hover:bg-red-50 transition-colors duration-200">
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
            <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus kupon diskon ini?</p>
            <div class="flex justify-end space-x-3">
                <button @click="showModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button @click="showModal = false; $wire.delete(couponIdToDelete)" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>