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
use App\Models\Kelasjurusan;

class KelasjurusanIndex extends Component
{
    public function render()
    {
        $sql = Kelasjurusan::orderBy('guru.guru_nip', 'ASC')->orderBy('guru_nip', 'ASC')->get();
        return view('livewire.kelasjurusan-index', ['rows' => $sql]);
    }
}
