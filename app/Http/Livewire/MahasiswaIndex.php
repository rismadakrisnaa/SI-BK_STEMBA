<?php

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
