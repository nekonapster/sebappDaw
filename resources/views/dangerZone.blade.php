{{-- COMPONENTE DE USUARIOS --}}
<x-app-layout>
    <span class="text-4xl text-base-content font-bold ml-10">Danger Zone</span>
    <div class="py-5 bg-base-200 mx-10 rounded-xl">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-4">
            <div class="overflow-hidden sm:rounded-lg mx-5">
                <h1 class="text-2xl ml-0 mt-3">Vaciado de tablas</h1>
                <span class="text-sm text-left">Estás en una zona peligrosa, los cambios que hagas acá no son reversibles y sé perderá toda la información almacenada en las base de datos.</span>
                </div>
            </div>
        </div>
        <div class="py-5 bg-base-200 mx-10 rounded-xl mt-3">
            @livewire('danger-zone-component')
        </div>

        <div class="py-5 bg-base-200 mx-10 rounded-xl mt-3">
            <footer class="footer footer-center bg-base-neutral text-base-content p-0">
                <aside>
                    <div class="flex">
                        <span class="px-1">Copyright © {{ now()->year }} - All right reserved by Nekonapster </span> <x-rpg-cat class="w-5"/>
                    </div>
                </aside>
              </footer>
        </div>
    </x-app-layout>