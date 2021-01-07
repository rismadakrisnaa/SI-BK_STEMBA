<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Prodi;

class ProdiIndex extends Component
{
    public function render()
    {
        $sql = Prodi::orderBy('fakultas.fak_kode', 'ASC')->orderBy('prodi_kode', 'ASC')->get();
        return view('livewire.prodi-index', ['rows' => $sql]);
    }
}
