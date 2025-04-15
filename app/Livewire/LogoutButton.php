<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class LogoutButton extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true); // Esto no devuelve nada
    }
    

    public function render()
    {
        return view('livewire.logout-button');
    }
}
