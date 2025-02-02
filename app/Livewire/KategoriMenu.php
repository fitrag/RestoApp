<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kategori;

class KategoriMenu extends Component
{
    public $kategoris, $nama, $kategori_id;
    public $isEdit = false;
    public $sortBy = 'id'; // Kolom yang akan disortir
    public $sortDirection = 'asc'; // Arah pengurutan (ascending/descending)

    public function render()
    {
        // Ambil semua kategori dari database dengan urutan yang sesuai
        $this->kategoris = Kategori::orderBy($this->sortBy, $this->sortDirection)->get();
        return view('livewire.kategori-menu');
    }

    // Method untuk sorting
    public function sortingBy($field)
    {
        if ($this->sortBy === $field) {
            // Jika sudah disort berdasarkan kolom yang sama, toggle urutannya
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Jika kolom berbeda, set urutan ascending
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }


    // Menambahkan kategori baru
    public function store()
    {
        $this->validate([
            'nama' => 'required|min:3|max:255',
        ], [
            'nama.required' => 'Nama kategori harus diisi.',
            'nama.min' => 'Nama kategori minimal terdiri dari 3 karakter.',
            'nama.max' => 'Nama kategori maksimal terdiri dari 255 karakter.',
        ]);

        Kategori::create([
            'nama' => $this->nama,
        ]);

        session()->flash('message', 'Kategori berhasil ditambahkan!');
        $this->resetInputFields();
    }


    // Mengedit kategori
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        $this->kategori_id = $kategori->id;
        $this->nama = $kategori->nama;
        $this->isEdit = true;
    }

    // Memperbarui kategori
    public function update()
    {
        $this->validate([
            'nama' => 'required|min:3|max:255',
        ], [
            'nama.required' => 'Nama kategori harus diisi.',
            'nama.min' => 'Nama kategori minimal terdiri dari 3 karakter.',
            'nama.max' => 'Nama kategori maksimal terdiri dari 255 karakter.',
        ]);

        $kategori = Kategori::find($this->kategori_id);
        $kategori->update([
            'nama' => $this->nama,
        ]);

        session()->flash('message', 'Kategori berhasil diperbarui!');
        $this->resetInputFields();
    }

    // Menghapus kategori
    public function delete($id)
    {
        Kategori::find($id)->delete();
        session()->flash('message', 'Kategori berhasil dihapus!');
    }

    // Reset input fields
    public function resetInputFields()
    {
        $this->nama = '';
        $this->kategori_id = '';
        $this->isEdit = false;
    }
    
}
