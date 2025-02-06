<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Models\Coupon;

class HomeIndex extends Component
{
    public $cart = [];
    public $isOpen = false; // State untuk membuka/tutup sidebar
    public $couponCode = '';
    public $discountApplied = false;
    public $discountType = ''; // 'percentage' atau 'fixed'
    public $discountValue = 0; // Nilai diskon
    public $discountAmount = 0; // Jumlah diskon yang diterapkan
    public $subtotal = 0;
    public $total = 0;
    public $invalidCoupon = false;

    public function addToCart($menuId)
    {
        if (isset($this->cart[$menuId])) {
            $this->cart[$menuId]++;
        } else {
            $this->cart[$menuId] = 1;
        }
        session()->flash('message', 'Menu berhasil ditambahkan ke keranjang.');
        $this->calculateTotals(); // Hitung ulang total harga
    }

    public function removeFromCart($menuId)
    {
        if (isset($this->cart[$menuId])) {
            unset($this->cart[$menuId]);
        }
        $this->calculateTotals(); // Hitung ulang total harga
    }

    public function increaseQuantity($menuId)
    {
        if (isset($this->cart[$menuId])) {
            $this->cart[$menuId]++;
        }
        $this->calculateTotals(); // Hitung ulang total harga
    }

    public function decreaseQuantity($menuId)
    {
        if (isset($this->cart[$menuId]) && $this->cart[$menuId] > 1) {
            $this->cart[$menuId]--;
        } elseif (isset($this->cart[$menuId]) && $this->cart[$menuId] === 1) {
            unset($this->cart[$menuId]); // Hapus item jika jumlah menjadi 0
        }
        $this->calculateTotals(); // Hitung ulang total harga
    }

    public function applyCoupon()
    {
        // Reset state
        $this->discountApplied = false;
        $this->invalidCoupon = false;

        // Cari kupon berdasarkan kode
        $coupon = Coupon::where('code', $this->couponCode)->first();

        if ($coupon) {
            // Validasi kupon
            if ($this->isCouponValid($coupon)) {
                $this->discountApplied = true;
                $this->discountType = $coupon->discount_type;
                $this->discountValue = $coupon->discount_value;

                // Hitung subtotal dan total harga
                $this->calculateTotals();

                // Update penggunaan kupon
                $coupon->increment('used_count');
            } else {
                $this->invalidCoupon = true;
                $this->calculateTotals(); // Hitung ulang total harga tanpa diskon
            }
        } else {
            $this->invalidCoupon = true;
            $this->calculateTotals(); // Hitung ulang total harga tanpa diskon
        }
    }

    private function isCouponValid($coupon)
    {
        // Periksa apakah kupon masih berlaku
        if ($coupon->valid_until && now()->gt($coupon->valid_until)) {
            return false; // Kupon kedaluwarsa
        }

        // Periksa batas penggunaan kupon
        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            return false; // Batas penggunaan tercapai
        }

        // Periksa minimum order
        $this->subtotal = array_sum(array_map(function ($menuId, $quantity) {
            $menu = Menu::find($menuId);
            return $menu ? $menu->harga * $quantity : 0;
        }, array_keys($this->cart), $this->cart));

        if ($coupon->minimum_order && $this->subtotal < $coupon->minimum_order) {
            return false; // Minimum order tidak terpenuhi
        }

        return true; // Kupon valid
    }

    private function calculateTotals()
    {
        // Hitung subtotal
        $this->subtotal = array_sum(array_map(function ($menuId, $quantity) {
            $menu = Menu::find($menuId);
            return $menu ? $menu->harga * $quantity : 0;
        }, array_keys($this->cart), $this->cart));

        // Hitung diskon jika ada
        if ($this->discountApplied) {
            if ($this->discountType === 'percentage') {
                $this->discountAmount = ($this->subtotal * $this->discountValue) / 100;
            } elseif ($this->discountType === 'fixed') {
                $this->discountAmount = min($this->subtotal, $this->discountValue); // Diskon tidak melebihi subtotal
            }
        } else {
            $this->discountAmount = 0; // Tidak ada diskon
        }

        // Hitung total
        $this->total = $this->subtotal - $this->discountAmount;
    }

    public function render()
    {
        $menus = Menu::with('kategori')->get();
        return view('livewire.home-index', compact('menus'));
    }
}