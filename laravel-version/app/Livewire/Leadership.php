<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Leadership extends Component
{
    public $users;

    public function mount()
    {
        $this->fetchUsers();
    }

    public function fetchUsers()
    {
        $this->users = User::select('name', 'simple_mode_victories', 'x2_luck_mode_victories')
            ->orderBy('simple_mode_victories', 'desc')
            ->orderBy('x2_luck_mode_victories', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.leadership');
    }
}
