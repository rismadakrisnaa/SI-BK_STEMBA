<?php



namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jenispelanggaran;

class JenispelanggaranIndex extends Component
{
    public function render()
    {
        $sql = Jenispelanggaran::orderBy('jenispelanggaran_kode')->get();
        return view('livewire.jenispelanggaran-index', ['rows' => $sql]);
    }
}
