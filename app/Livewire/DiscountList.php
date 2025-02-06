<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Coupon;

class DiscountList extends Component
{
    public function render()
    {
        // Ambil semua kupon yang masih valid
        $coupons = Coupon::where('used_count', '<=', \DB::raw('IFNULL(usage_limit, used_count)'))
            ->where(function ($query) {
                $query->whereNull('valid_until') // Kupon tanpa batas waktu
                      ->orWhere('valid_until', '>=', now()); // Kupon dengan batas waktu yang belum kedaluwarsa
            })
            ->get();

        return view('livewire.discount-list', compact('coupons'));
    }
}