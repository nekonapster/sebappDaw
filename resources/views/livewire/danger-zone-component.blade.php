<div wire:poll.3>
    @if (session('msg'))
    <div role="alert" class="alert alert-success mb-5 drop-shadow-xl" id="alert-message">
        {{session('msg')}}
    </div>
    @endif
    <div class="overflow-x-auto px-5">
        <table class="table table-xs text-center bg-base-100">
            <!-- head -->
            <thead>
                <tr>
                    <th class="w-1/6 pt-5 pb-5 text-base-content">Nombre de la colección</th>
                    <th class="w-96 pt-5 pb-5 text-base-content">Número de documentos</th>
                    <th class="w-1 pt-5 pb-5 text-base-content">Acción</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                <tr>
                    <td>Base General</td>
                    <td>{{$contadores['basesGenerales']}}</td>
                    <td> <button onclick="dangerZone.showModal()" wire:click="loadTableToTruncate('1')" type="button"
                            class="btn btn-sm btn-error">
                            <x-lineawesome-skull-crossbones-solid class="w-6" />
                            Vaciar
                        </button></td>
                </tr>
                <!-- row 2 -->
                <tr>
                    <td>Proveedores</td>
                    <td>{{$contadores['proveedores']}}</td>
                    <td> <button onclick="dangerZone.showModal()" wire:click="loadTableToTruncate('2')" type="button"
                            class="btn btn-sm btn-error">
                            <x-lineawesome-skull-crossbones-solid class="w-6" />
                            Vaciar
                        </button></td>
                </tr>
                <!-- row 3 -->
                <tr>
                    <td>Cuentas Contables</td>
                    <td>{{$contadores['cuentasContables']}}</td>
                    <td> <button onclick="dangerZone.showModal()" wire:click="loadTableToTruncate('3')" type="button"
                            class="btn btn-sm btn-error">
                            <x-lineawesome-skull-crossbones-solid class="w-6" />
                            Vaciar
                        </button></td>
                </tr>
                <!-- row 4 -->
                <tr>
                    <td>Bancos</td>
                    <td>{{$contadores['bancos']}}</td>
                    <td> <button onclick="dangerZone.showModal()" wire:click="loadTableToTruncate('4')" type="button"
                            class="btn btn-sm btn-error">
                            <x-lineawesome-skull-crossbones-solid class="w-6" />
                            Vaciar
                        </button></td>
                </tr>
                <!-- row 5 -->
                <tr>
                    <td>Saldos</td>
                    <td>{{$contadores['saldos']}}</td>
                    <td> <button onclick="dangerZone.showModal()" wire:click="loadTableToTruncate('5')" type="button"
                            class="btn btn-sm btn-error">
                            <x-lineawesome-skull-crossbones-solid class="w-6" />
                            Vaciar
                        </button></td>
                </tr>
            </tbody>
        </table>
    </div>





    {{-- modal --}}
    <dialog id="dangerZone" class="modal" wire:ignore.self>
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
              </form>
            <h3 class="text-lg text-red-700 font-bold">Atención!</h3>
            <p class="py-4">Está a punto de eliminar todos los registros de la tabla...</p>
            <div class="modal-action">
                <!-- if there is a button in form, it will close the modal -->
                <button wire:click='truncateTable' class="btn" wire:loading.remove {{-- wire:loading.attr.3s='disabled'
                    --}}>Confirmar</button>
            </div>
        </div>
    </dialog>
</div>