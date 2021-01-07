<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dosen;

class DosenIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $perPage = 10;
    public string $search = '';

    public function render()
    {
        //$sql = Dosen::orderBy('prodi.prodi_kode', 'ASC')->orderBy('dsn_nama', 'ASC')->get();
        
        $sql = Dosen::query()
        ->when($this->search, function ($query) {
            return $query->where('dsn_nidn', 'like', '%' . $this->search . '%')
                ->orWhere('dsn_nama', 'like', '%' . $this->search . '%');
        })->paginate($this->perPage);

        return view('livewire.dosen-index', ['rows' => $sql]);
    }
}
