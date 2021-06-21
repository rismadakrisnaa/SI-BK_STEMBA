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
use Livewire\WithPagination;
use App\Models\Guru;

class GuruIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $perPage = 10;
    public string $search = '';

    public function render()
    {
        //$sql = Guru::orderBy('kelasjurusan.kelasjurusan_kode', 'ASC')->orderBy('guru_nama', 'ASC')->get();
        
        $sql = Guru::query()
        ->when($this->search, function ($query) {
            return $query->where('guru_nidn', 'like', '%' . $this->search . '%')
                ->orWhere('guru_nama', 'like', '%' . $this->search . '%');
        })->paginate($this->perPage);

        return view('livewire.guru-index', ['rows' => $sql]);
    }
}
