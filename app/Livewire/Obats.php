<?php

namespace App\Livewire;

use App\Models\Obat;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;

class Obats extends Component
{

    use WithPagination;

    public bool $active = false;

    public $search = '';

    public $obat;

    // Form variable
    public $nama, $harga;
    public $status = false;

    public $confirmingObatDeletion = false;
    public $confirmingObatAdd = false;

    protected $rules = [
        'nama' => 'required|string|min:4',
        'harga' => 'required|numeric|between:1000,1000000',
        'status' => 'boolean'
    ];

    public function toggleActive()
    {
        $this->active = !$this->active;
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination ketika search berubah
    }

    public function render()
    {
        $obats = Obat::where('user_id', auth()->id())
            ->when(
                $this->search,
                fn($query) =>
                $query->where('nama', 'like', '%' . $this->search . '%') // Pencarian
            )
            ->when(
                $this->active,
                fn($query) =>
                $query->where('status', 1) // Filter aktif
            )
            ->paginate(10);

        return view('livewire.obats', compact('obats'));
    }

    public function confirmObatDeletion($id)
    {
        $this->confirmingObatDeletion = $id;
    }

    public function confirmObatEdit($id)
    {
        $obat = Obat::findOrFail($id);

        $this->obat = $obat;
        $this->nama = $obat->nama;
        $this->harga = $obat->harga;
        $this->status = $obat->status;
        $this->confirmingObatAdd = true;
    }

    public function deleteObat(Obat $obat)
    {
        $obat->delete();
        $this->confirmingObatDeletion = false;
    }

    public function confirmObatAdd()
    {
        $this->reset(['obat']);
        $this->confirmingObatAdd = true;
    }

    public function saveObat()
    {
        $this->validate();

        if ($this->obat) {
            $this->obat->update([
                'nama' => $this->nama,
                'harga' => $this->harga,
                'status' => $this->status ? 1 : 0
            ]);
            session()->flash('message', 'Obat berhasil diubah.');
        } else {
            Obat::create([
                'user_id' => Auth::id(),
                'nama' => $this->nama,
                'harga' => $this->harga,
                'status' => $this->status ? 1 : 0
            ]);
            session()->flash('message', 'Obat berhasil ditambahkan.');
        }

        $this->confirmingObatAdd = false;

        $this->reset(['nama', 'harga', 'status']);
    }
}
