<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Fakultas;

class FakultasIndex extends Component
{
    public function render()
    {
        $sql = Fakultas::orderBy('fak_kode')->get();
        return view('livewire.fakultas-index', ['rows' => $sql]);
    }
}
