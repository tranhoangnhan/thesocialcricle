<?php

namespace App\Livewire\Clients;

use Livewire\Component;

class HomeController extends Component
{
    public function render()
    {
        if (auth()->check()) {
            return view('clients.home.index');

        } else {
            return view('clients.auth.login');
        }
    }
}
