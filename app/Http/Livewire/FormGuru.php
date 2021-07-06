<?php

namespace App\Http\Livewire;

use App\Models\Guru;
use App\Models\GuruBk;
use Livewire\Component;

class FormGuru extends Component
{
    public $dataGuru;
    public $guru;

    public function mount()
    {
        $guruBk=GuruBk::all();
        $waliKelas=Guru::all();
        foreach($guruBk as $g){
            $this->dataGuru[]=['nip'=>$g->nim,'nama'=>$g->name];
        }
        foreach($waliKelas as $wk){
            $this->dataGuru[]=['nip'=>$wk->guru_nip,'nama'=>$wk->guru_nama];
        }
        $this->guru=[
            ['nama'=>'','jabatan'=>'Cek'],
            ['nama'=>'','jabatan'=>'Cek'],
            ['nama'=>'','jabatan'=>'Cek'],
        ];
    }

    public function addGuru()
    {
        $this->guru[]=['nama'=>'','jabatan'=>'Cek'];
    }

    public function deleteGuru($index)
    {
        unset($guru[$index]);
        $this->guru=array_values($this->guru);
    }

    public function render()
    {
        return view('livewire.form-guru');
    }
}
