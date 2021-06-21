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
use App\Models\Mahasiswa;

class MahasiswaIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $perPage = 10;
    public string $search = '';

    public function render()
    {
        $sql = Mahasiswa::query()
            ->when($this->search, function ($query) {
                return $query->where('mhsw_nim', 'like', '%' . $this->search . '%')
                    ->orWhere('mhsw_nama', 'like', '%' . $this->search . '%');
            })->paginate($this->perPage);

        return view('livewire.mahasiswa-index', ['rows' => $sql]);
    }
}
