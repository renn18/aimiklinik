<?php

namespace App\Livewire;

use App\Models\Obat;
use Livewire\Component;
use Livewire\WithPagination;

class Obats extends Component
{
    use WithPagination;

    public $active;

    public function render()
    {
        $obats = Obat::where('user_id', auth()->user()->id)
            ->when($this->active, function ( $query) {
                return $query->where('status', 1);
            })
            ->paginate(10);

        return view('livewire.obats', [
            'obats' => $obats
        ]);
    }
}