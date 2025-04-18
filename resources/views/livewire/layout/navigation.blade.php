<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="">
    <!-- MENU DE NAVEGACION PRIMARIO -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('baseGeneral')" :active="request()->routeIs('baseGeneral')" wire:navigate>
                        {{ __('Base general') }}
                    </x-nav-link>
                    <x-nav-link :href="route('saldos')" :active="request()->routeIs('saldos')" wire:navigate>
                        {{ __('Saldos') }}
                    </x-nav-link>
                    <x-nav-link :href="!auth()->guest() && auth()->user()->role !== 'guest' ? route('users') : '#'"
                        :class="auth()->guest() || auth()->user()->role === 'guest' ? 'opacity-25' : ''"
                        :active="request()->routeIs('users')" wire:navigate>
                        {{ __('Users') }}
                    </x-nav-link>
                    <x-nav-link :href="!auth()->guest() && auth()->user()->role !== 'guest' ? route('dangerZone') : '#'"
                        :class="auth()->guest() || auth()->user()->role === 'guest' ? 'opacity-25' : ''"
                        :active="request()->routeIs('dangerZone')" wire:navigate>
                        {{ __('DangerZone') }}
                    </x-nav-link>
                </div>
            </div>





            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

               {{-- theme controller --}}
                @persist('theme-checkbox')
                    @livewire('theme-component')
                @endpersist

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger" class="flex items-center">

                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        @livewire('logout-button')

                        {{-- <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}

                            </x-dropdown-link>
                        </button> --}}
                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

   <!-- Responsive Navigation Menu -->
<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
            {{ __('Dashboard') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('baseGeneral')" :active="request()->routeIs('baseGeneral')" wire:navigate>
            {{ __('Base general') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('saldos')" :active="request()->routeIs('saldos')" wire:navigate>
            {{ __('Saldos') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link 
            :href="!auth()->guest() && auth()->user()->role !== 'guest' ? route('users') : '#'"
            :class="auth()->guest() || auth()->user()->role === 'guest' ? 'opacity-25' : ''"
            :active="request()->routeIs('users')" wire:navigate>
            {{ __('Users') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link 
            :href="!auth()->guest() && auth()->user()->role !== 'guest' ? route('dangerZone') : '#'"
            :class="auth()->guest() || auth()->user()->role === 'guest' ? 'opacity-25' : ''"
            :active="request()->routeIs('dangerZone')" wire:navigate>
            {{ __('DangerZone') }}
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t">
        <div class="px-4">
            <div class="font-medium text-base" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
            <div class="font-medium text-sm">{{ auth()->user()->email }}</div>
        </div>

        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile')" wire:navigate>
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <!-- Authentication -->
            @livewire('logout-button')
            {{-- <button wire:click="logout" class="w-full text-start">
                <x-responsive-nav-link>
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </button> --}}
        </div>
    </div>
</div>
