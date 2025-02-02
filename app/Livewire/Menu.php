<?php

namespace App\Livewire;

use Livewire\Component;

class Menu extends Component
{
    public $items = [
        [
            'name' => 'Nasi Goreng Special',
            'price' => 15.000,
            'image' => 'path/to/image1.jpg',
        ],
        [
            'name' => 'Sate Ayam Madura',
            'price' => 20.000,
            'image' => 'path/to/image2.jpg',
        ],
        [
            'name' => 'Mie Goreng Jawa',
            'price' => 12.000,
            'image' => 'path/to/image3.jpg',
        ],
        [
            'name' => 'Rendang Padang',
            'price' => 30.000,
            'image' => 'path/to/image4.jpg',
        ],
        [
            'name' => 'Gado-Gado',
            'price' => 18.000,
            'image' => 'path/to/image5.jpg',
        ],
        // Tambahkan item lain sesuai kebutuhan
    ];

    public function render()
    {
        return view('livewire.menu');
    }
}
