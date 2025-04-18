<div>
    <button type="button" class="btn btn-sm btn-accent btn-outline" onclick="nuevoBanco.showModal()">Nuevo Banco</button>

    {{-- ! modal para 'Nuevo Banco' --}}
    <dialog id="nuevoBanco" class="modal" wire:ignore.self>
        <div class="card bg-base-100 w-96 shadow-xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
              </form>
            <div class="card-body items-center">
                <div>
                    <p class="mb-5 text-start text-2xl w-full">Nueva Banco</p>
                    <div class="divider"></div>
                        <span class="label-text">Nombre del Banco</span>
                        <input wire:model='nombre_banco' type="text"
                        placeholder="@error('nombre_banco') {{ $message }} @enderror"
                        class="input input-sm w-full select-bordered mb-5 @error('nombre_banco') border-red-500 @enderror"
                         />
                           
                        <span class="label-text">Cuenta asociada</span>
                        <input wire:model='cuentaAsociada' type="text"
                            class="input input-sm input-bordered w-full mb-5 @error('cuentaAsociada') border-red-500" @enderror
                            placeholder=" @error('cuentaAsociada') {{$message}} @enderror"
                            />
                        <div class="card-actions w-full">
                            <button wire:click='nuevoBanco' class="btn w-full mt-5 btn-success">Crear</button>
                        </div>
                </div>
            </div>
        </div>
    </dialog>


    @script
        <script>
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                location.reload();
            }
        });
        </script>
    @endscript
</div>