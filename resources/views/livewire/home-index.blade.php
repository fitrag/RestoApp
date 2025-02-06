<div class="p-6 bg-gray-100 min-h-screen relative" x-data="{ isOpen: false }">
    <!-- Pesan Sukses -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <!-- Loading Spinner -->
    <div wire:loading>
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-[100]">
            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </div>
    </div>

<!-- Daftar Menu -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach ($menus as $menu)
        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-[1.02] group relative flex">
            <!-- Kolom Kiri: Gambar Menu -->
            <div class="w-1/3 relative">
                <img 
                    src="{{ $menu->gambar ? asset('storage/' . $menu->gambar) : asset('images/default-menu.jpg') }}" 
                    alt="{{ $menu->nama }}" 
                    class="w-full h-full object-cover rounded-l-lg"
                >
                <!-- Badge Diskon (Opsional) -->
                @if ($menu->diskon > 0)
                    <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded-md text-xs font-semibold">
                        Diskon {{ $menu->diskon }}%
                    </div>
                @endif
            </div>

            <!-- Kolom Kanan: Informasi Menu -->
            <div class="w-2/3 p-4 space-y-2">
                <h3 class="text-lg font-semibold text-orange-500 group-hover:text-orange-600 transition-colors">{{ $menu->nama }}</h3>
                <p class="text-sm text-gray-600 line-clamp-2">{{ $menu->deskripsi }}</p>
                <div class="flex items-center justify-between">
                    <p class="text-base font-bold text-gray-900">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500">{{ $menu->kategori->nama }}</p>
                </div>
                <!-- Tombol Tambah ke Keranjang -->
                <button 
                    wire:click="addToCart({{ $menu->id }}); isOpen = true" 
                    class="mt-2 w-full px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-full hover:from-orange-600 hover:to-orange-700 transition-all duration-200 flex items-center justify-center space-x-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah ke Keranjang</span>
                </button>
            </div>
        </div>
    @endforeach
</div>

    <!-- Tombol Toggle Keranjang -->
    <button 
        @click="isOpen = !isOpen" 
        class="fixed bottom-6 right-6 bg-orange-500 text-white p-3 rounded-full shadow-lg hover:bg-orange-600 transition-colors duration-200 z-50"
    >
        <!-- Ikon Keranjang -->
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0h2v2H7v-2z"></path>
        </svg>
        <!-- Badge Jumlah Item -->
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
            {{ array_sum($cart) }}
        </span>
    </button>



<!-- Sidebar Keranjang -->
<div 
    x-show="isOpen" 
    x-transition 
    class="fixed inset-y-0 right-0 w-96 bg-white shadow-lg z-50 transform transition-transform duration-300 ease-in-out"
>
    <div class="p-6">
        <!-- Header Keranjang -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Keranjang</h2>
            <button 
                @click="isOpen = false" 
                class="text-gray-500 hover:text-gray-700 focus:outline-none"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Daftar Menu di Keranjang -->
        @if (isset($cart) && count($cart) > 0)
            <div class="space-y-4 max-h-[calc(100vh-200px)] overflow-y-auto">
                @foreach ($cart as $menuId => $quantity)
                    @php
                        $menu = \App\Models\Menu::find($menuId);
                    @endphp
                    @if ($menu)
                        <div class="flex items-center justify-between border-b border-gray-200 pb-3">
                            <!-- Informasi Menu -->
                            <div class="flex items-start space-x-3">
                                <!-- Gambar Menu -->
                                <img 
                                    src="{{ $menu->gambar ? asset('storage/' . $menu->gambar) : asset('images/default-menu.jpg') }}" 
                                    alt="{{ $menu->nama }}" 
                                    class="w-12 h-12 object-cover rounded-md"
                                >
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $menu->nama }}</p>
                                    <p class="text-xs text-gray-500">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <!-- Jumlah dan Tombol Hapus -->
                            <div class="flex items-center space-x-3">
                                <!-- Tombol Kurang -->
                                <button 
                                    wire:click="decreaseQuantity({{ $menuId }})" 
                                    class="text-gray-500 hover:text-gray-700 focus:outline-none"
                                    @if ($quantity <= 1) disabled @endif
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <!-- Jumlah -->
                                <span class="text-sm font-medium text-gray-700">{{ $quantity }}</span>
                                <!-- Tombol Tambah -->
                                <button 
                                    wire:click="increaseQuantity({{ $menuId }})" 
                                    class="text-gray-500 hover:text-gray-700 focus:outline-none"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                                <!-- Tombol Hapus -->
                                <button 
                                    wire:click="removeFromCart({{ $menuId }})" 
                                    class="text-red-500 hover:text-red-600 focus:outline-none"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Input Kode Kupon -->
<div class="mt-6">
    <label for="coupon_code" class="block text-sm font-medium text-gray-700">Kode Kupon</label>
    <div class="flex items-center space-x-2">
        <input 
            type="text" 
            id="coupon_code" 
            wire:model="couponCode" 
            placeholder="Masukkan kode kupon" 
            class="mt-1 block text-uppercase w-full px-4 py-2 border-0 ring-1 ring-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200 placeholder-gray-400"
        >
        <button 
            wire:click="applyCoupon" 
            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors"
        >
            Terapkan
        </button>
    </div>
    @if ($discountApplied)
        <p class="mt-2 text-sm text-green-500">
            Diskon diterapkan: 
            @if ($discountType === 'percentage')
                {{ $discountValue }}%
            @elseif ($discountType === 'fixed')
                Rp {{ number_format($discountValue, 0, ',', '.') }}
            @endif
        </p>
    @elseif ($invalidCoupon)
        <p class="mt-2 text-sm text-red-500">Kode kupon tidak valid atau tidak memenuhi syarat.</p>
    @endif
</div>

<!-- Total Harga -->
<div class="mt-6 border-t border-gray-200 pt-4">
    <div class="flex justify-between items-center">
        <p class="text-sm font-medium text-gray-800">Subtotal:</p>
        <p class="text-lg font-bold text-gray-900">
            Rp {{ number_format($subtotal, 0, ',', '.') }}
        </p>
    </div>
    @if ($discountApplied)
        <div class="flex justify-between items-center mt-2">
            <p class="text-sm font-medium text-gray-800">Diskon:</p>
            <p class="text-lg font-bold text-gray-900">
                - Rp {{ number_format($discountAmount, 0, ',', '.') }}
            </p>
        </div>
    @endif
    <div class="flex justify-between items-center mt-2">
        <p class="text-sm font-medium text-gray-800">Total:</p>
        <p class="text-lg font-bold text-gray-900">
            Rp {{ number_format($total, 0, ',', '.') }}
        </p>
    </div>
</div>

            <!-- Tombol Checkout -->
            <div class="mt-6">
                <button 
                    class="w-full bg-orange-500 text-white px-4 py-3 rounded-lg hover:bg-orange-600 transition-colors focus:outline-none"
                >
                    Checkout
                </button>
            </div>
        @else
            <!-- Pesan Keranjang Kosong -->
            <div class="text-center py-12">
                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0h2v2H7v-2z"></path>
                </svg>
                <p class="mt-4 text-sm text-gray-500">Keranjang kosong.</p>
            </div>
        @endif
    </div>
</div>


    <!-- Overlay untuk Menutup Sidebar -->
    <div 
        x-show="isOpen" 
        class="fixed inset-0 bg-black/50 z-40" 
        @click="isOpen = false"
    ></div>
</div>