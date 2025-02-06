<div class="p-6 bg-gray-100 min-h-screen">
    <div class="">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Daftar Kupon Diskon</h1>

        <!-- Daftar Kupon Diskon -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($coupons as $coupon)
                <div class="bg-white rounded-lg shadow-md transition-transform duration-300 hover:scale-[1.02]">
                    <!-- Header Card (2 Kolom) -->
                    <div class="flex justify-between items-center p-4 border-b border-gray-200">
                        <!-- Kolom Kiri: Kode Kupon Diskon -->
                        <div>
                            <p class="text-lg font-bold text-orange-500 cursor-pointer" onclick="copyToClipboard('{{ $coupon->code }}')">{{ $coupon->code }}</p>
                            <p class="text-sm text-gray-500">Kode Kupon</p>
                        </div>
                        <!-- Kolom Kanan: Masa Berlaku Kupon -->
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-600">
                                @if ($coupon->valid_until)
                                    {{ \Carbon\Carbon::parse($coupon->valid_until)->format('d M Y') }}
                                @else
                                    Tanpa batas waktu
                                @endif
                            </p>
                            <p class="text-xs text-gray-500">Berlaku Hingga</p>
                        </div>
                    </div>

                    

                    <!-- Footer Card -->
                    <div class="p-4 border-t border-gray-200 text-center">
                        <!-- Dropdown Syarat & Ketentuan -->
                        <div x-data="{ open: false }" class="relative text-center">
                            <button 
                                @click="open = !open" 
                                class="text-sm text-blue-500 hover:text-blue-600 w-full focus:outline-none text-center" 
                            >
                                Syarat & Ketentuan
                            </button>
                            <div 
                                x-show="open" 
                                @click.away="open = false" 
                                class="absolute top-12 z-50 left-0 inline-block w-full bg-white p-4 rounded-lg shadow-md"
                            >
                                <!-- Body Card -->
                    <div class="p-4 space-y-2">
                        <p class="text-sm text-gray-600 flex justify-between">
                            <span class="font-medium">Nilai Diskon:</span> 
                            <span class="font-semibold">
                                @if ($coupon->discount_type === 'percentage')
                                    {{ $coupon->discount_value }}%
                                @else
                                    Rp {{ number_format($coupon->discount_value, 0, ',', '.') }}
                                @endif
                            </span>
                        </p>
                        <p class="text-sm text-gray-600 flex justify-between">
                            <span class="font-medium">Minimum Order:</span> 
                            <span class="font-semibold">
                                @if ($coupon->minimum_order)
                                    Rp {{ number_format($coupon->minimum_order, 0, ',', '.') }}
                                @else
                                    Tidak ada minimum order
                                @endif
                            </span>
                        </p>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Tidak ada kupon diskon yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Script untuk Copy to Clipboard -->
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                console.log('Berhasil menyalin kode kupon:', text);
            }).catch(err => {
                console.error('Gagal menyalin kode kupon:', err);
            });
        }
    </script>
</div>