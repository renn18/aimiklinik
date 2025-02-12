<?php

namespace App\Livewire;

use App\Models\Obat;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Obats extends Component
{

    use WithPagination;

    public bool $active = false;

    public $search = '';

    public $obat;

    public $confirmingObatDeletion = false;
    public $confirmingObatAdd = false;

    protected $rules = [
        'obat.nama' => 'required|string|min:4',
        'obat.harga' => 'required|numeric|between:1000,1000000',
        'obat.status' => 'boolean'
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

    public function deleteObat(Obat $obat)
    {
        $obat->delete();
        $this->confirmingObatDeletion = false;
    }

    public function confirmObatAdd()
    {
        $this->confirmingObatAdd = true;
    }
}
