{{-- COMPONENTE DE SALDOS --}}
<x-app-layout>
    <span class="text-4xl text-base-content font-bold ml-10">Saldos</span>
    <div class="py-5 bg-base-200 mx-10 rounded-xl">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-4">
            <div class="overflow-hidden sm:rounded-lg">
                <div>
                    {{-- tabla de saldos --}}
                    @livewire('saldos-component')
                </div>


            </div>
        </div>
    </div>

    <div class="mt-3 py-5 bg-base-200 mx-10 rounded-xl">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-4">
            <div class="overflow-hidden sm:rounded-lg">
                @livewire('tabla-saldos-component')
            </div>
        </div>
    </div>
</x-app-layout>