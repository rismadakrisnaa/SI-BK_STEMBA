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
use App\Models\Siswa;

class SiswaIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $statusUpdate=false;
    public $perPage = 2;
    public $search;
    

    protected $updateQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.siswa-index', [
            'rows'=> $this->search === null?
                Siswa::latest()->paginate($this->perPage) :
                Siswa::latest()->where('siswa_nama', 'like', '%' . $this->search . '%')->paginate ($this->perPage)
        ]);
    }
}

// $sql = Siswa::query()
        //     ->when($this->search, function ($query) {
        //         return $query->where('siswa_nim', 'like', '%' . $this->search . '%')
        //             ->orWhere('siswa_nama', 'like', '%' . $this->search . '%');
        //     })->perPage($this->perPage);

        // return view('livewire.siswa-index', ['rows' => $sql]);