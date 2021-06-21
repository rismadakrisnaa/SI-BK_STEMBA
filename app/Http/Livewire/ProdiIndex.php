<?php

/**
 * Copyright Gosoftware Media 2021
 * --
 * Gosoftware Media
 * Site   : http://gosoftware.web.id
 * e-mail : cs@gosoftware.web.id
 * WA     : 62852-6361-6901
 * --
 */

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
