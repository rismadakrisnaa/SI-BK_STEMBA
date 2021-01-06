<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $perPage = 10;
    public string $search = '';

    public function render()
    {
        $sql = User::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })->paginate($this->perPage);

        return view('livewire.user-index', ['rows' => $sql]);
    }
}
