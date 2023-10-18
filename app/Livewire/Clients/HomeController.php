<?php

namespace App\Livewire\Clients;

use Livewire\Component;

class HomeController extends Component
{
    public function render()
    {
        if (auth()->check()) {
            // if (auth()->user()->user_email_verified == 0) {
            //     return view('clients.auth.verify');
            // }
            return view('clients.home.index');
        } else {
            return view('clients.auth.login');
        }
    }
}
