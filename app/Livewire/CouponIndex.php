<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CouponIndex extends Component
{
    public $code;
    public $discount_type = 'percentage';
    public $discount_value;
    public $minimum_order;
    public $valid_until;
    public $usage_limit;
    public $isEdit = false;
    public $couponId;

    public function mount()
    {
        $this->coupons = Coupon::all();
    }

    public function store()
    {
        $this->validate([
            'code' => 'required|unique:coupons,code',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'minimum_order' => 'nullable|numeric|min:0',
            'valid_until' => 'required|date',
            'usage_limit' => 'nullable|integer|min:1',
        ]);

        Coupon::create([
            'code' => $this->code,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'minimum_order' => $this->minimum_order,
            'valid_until' => $this->valid_until,
            'usage_limit' => $this->usage_limit,
        ]);

        session()->flash('message', 'Kupon berhasil ditambahkan.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $this->couponId = $coupon->id;
        $this->code = $coupon->code;
        $this->discount_type = $coupon->discount_type;
        $this->discount_value = $coupon->discount_value;
        $this->minimum_order = $coupon->minimum_order;
        $this->valid_until = $coupon->valid_until;
        $this->usage_limit = $coupon->usage_limit;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'code' => 'required|unique:coupons,code,' . $this->couponId,
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'minimum_order' => 'nullable|numeric|min:0',
            'valid_until' => 'required|date',
            'usage_limit' => 'nullable|integer|min:1',
        ]);

        $coupon = Coupon::findOrFail($this->couponId);
        $coupon->update([
            'code' => $this->code,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'minimum_order' => $this->minimum_order,
            'valid_until' => $this->valid_until,
            'usage_limit' => $this->usage_limit,
        ]);

        session()->flash('message', 'Kupon berhasil diperbarui.');
        $this->resetInput();
    }

    public function delete($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        session()->flash('message', 'Kupon berhasil dihapus.');
    }

    public function resetInput()
    {
        $this->code = '';
        $this->discount_type = 'percentage';
        $this->discount_value = '';
        $this->minimum_order = '';
        $this->valid_until = '';
        $this->usage_limit = '';
        $this->isEdit = false;
        $this->couponId = null;
    }

    public function render()
    {
        $this->coupons = Coupon::all();
        return view('livewire.coupon-index',[
            'coupons' => $this->coupons,
        ]);
    }
}
