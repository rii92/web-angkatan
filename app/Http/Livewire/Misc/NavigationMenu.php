<?php

namespace App\Http\Livewire\Misc;

use Laravel\Jetstream\Http\Livewire\NavigationMenu as LivewireNavigationMenu;

class NavigationMenu extends LivewireNavigationMenu
{
    public function render()
    {
        return view('components.homepage.navigation-menu');
    }
}
