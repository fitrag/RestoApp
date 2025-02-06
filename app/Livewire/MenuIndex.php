<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Models\Kategori;
use Livewire\WithFileUploads; // Untuk handle upload file

class MenuIndex extends Component
{
    use WithFileUploads; // Gunakan trait ini untuk upload file

    public $nama;
    public $deskripsi;
    public $harga;
    public $kategori_id;
    public $gambar; // Properti untuk file gambar
    public $menus;
    public $kategoris;
    public $isEdit = false;
    public $menuId;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'harga' => 'required|numeric|min:0',
        'kategori_id' => 'required|exists:kategoris,id',
        'gambar' => 'nullable|image|max:2048', // Validasi gambar (maksimal 2MB)
    ];

    public function mount()
    {
        $this->menus = Menu::with('kategori')->get();
        $this->kategoris = Kategori::all();
    }

    public function store()
    {
        $this->validate();

        // Simpan gambar jika ada
        $gambarPath = null;
        if ($this->gambar) {
            $gambarPath = $this->gambar->store('menu-images', 'public'); // Simpan di folder "storage/app/public/menu-images"
        }

        // dd($gambarPath);

        Menu::create([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'kategori_id' => $this->kategori_id,
            'gambar' => $gambarPath, // Simpan path gambar ke database
        ]);

        session()->flash('message', 'Menu berhasil ditambahkan.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $this->nama = $menu->nama;
        $this->deskripsi = $menu->deskripsi;
        $this->harga = $menu->harga;
        $this->kategori_id = $menu->kategori_id;
        $this->menuId = $menu->id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $menu = Menu::findOrFail($this->menuId);

        // Simpan gambar baru jika ada
        if ($this->gambar) {
            $gambarPath = $this->gambar->store('menu-images', 'public'); // Simpan gambar baru
            $menu->update(['gambar' => $gambarPath]); // Update path gambar
        }

        $menu->update([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'kategori_id' => $this->kategori_id,
        ]);

        session()->flash('message', 'Menu berhasil diperbarui.');
        $this->resetInput();
    }

    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        session()->flash('message', 'Menu berhasil dihapus.');
    }

    public function resetInput()
    {
        $this->nama = '';
        $this->deskripsi = '';
        $this->harga = '';
        $this->kategori_id = '';
        $this->gambar = null; // Reset gambar
        $this->menuId = null;
        $this->isEdit = false;
        $this->menus = Menu::with('kategori')->get();
    }

    public function render()
    {
        return view('livewire.menu-index');
    }
}