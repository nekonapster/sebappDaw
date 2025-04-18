<div>
	<button type="button" class="btn btn-sm btn-accent btn-outline"
		onclick="nuevoProveedor.showModal()">Proveedor</button>

	{{-- ! modal 'nuevo proveedor' --}}
	<dialog id="nuevoProveedor" class="modal" wire:ignore.self>
		<div class="modal-box max-w-full w-screen max-h-screen h-screen">
			<form method="dialog">
				<button class="btn btn-sm btn-circle btn-ghost absolute right-5 top-2">✕</button>
			</form>
			<h3 class="font-bold text-lg">Proveedor</h3>
			<div class="card-body card-bordered px-3">
				<div class="grid grid-cols-4 gap-3">
					{{-- <label class="text-xs">ID
						<input wire:model='id_proveedor' type="text" placeholder="ID" class="input input-sm input-bordered w-full"
						disabled />
					</label> --}}
					<label class="text-xs">Proveedor
						<input wire:model='proveedor_name' type="text"
							placeholder="@error('proveedor_name'){{ $message }} @else NOMBRE @enderror"
							class="input input-sm input-bordered w-full @error('proveedor_name') border-red-500 text-red-500 @enderror" />
					</label>
					<label class="text-xs">Descripción
						<input wire:model='descripcion' type="text" value="{{$descripcion}}"
							placeholder="@error('descripcion'){{ $message }} @else DESCRIPCIÓN @enderror"
							class="input input-sm input-bordered w-full @error('descripcion') border-red-500 text-red-500 @enderror"
							disabled />
					</label>
					<label class="text-xs">Rubro
						<input wire:model='rubro' type="text" placeholder="@error('rubro'){{ $message }} @else RUBRO @enderror"
							class="input input-sm input-bordered w-full @error('rubro') border-red-500 text-red-500 @enderror"
							disabled />
					</label>
					<div class="flex gap-3">
						<label class="text-xs w-full">CC
							<input wire:model='cc' wire:change="handleCcChange($event.target.value)" list="cc"
								placeholder="@error('cc'){{ $message }} @else CC @enderror"
								class="input input-sm input-bordered w-full @error('cc') border-red-500 text-red-500 @enderror" />
						</label>
						<datalist name="cc" id="cc">
							@foreach ($numerosCC as $numeroCC)
							<option value="{{$numeroCC}}"></option>
							@endforeach
						</datalist>
						<div class="mt-4">
							{{-- ! boton para modal de CC cuenta contable --}}
							@livewire('modal-nuevo-cc-component')
						</div>
					</div>
					<label class="text-xs">Teléfono
						<input wire:model='tel' type="string" placeholder="@error('tel'){{ $message }} @else TELÉFONO @enderror"
							class="input input-sm input-bordered w-full @error('tel') border-red-500 text-red-500 @enderror" />
					</label>
					<label class="text-xs">Email
						<input wire:model='email' type="email" placeholder="@error('email'){{ $message }} @else EMAIL @enderror"
							class="input input-sm input-bordered w-full @error('email') border-red-500 text-red-500 @enderror" />
					</label>
					<label class="text-xs">Contacto
						<input wire:model='contacto' type="text"
							placeholder="@error('contactp'){{ $message }} @else CONTACTO @enderror"
							class="input input-sm input-bordered w-full @error('contacto') border-red-500 text-red-500 @enderror" />
					</label>
					<div class="flex gap-3">
						<label class="text-xs">Just in case...
							<input class="input input-sm input-bordered w-full" placeholder="DISABLED" disabled />
						</label>
					</div>

				</div>

				<div class="flex justify-between mt-5">
					{{-- ! modal para la carga masiva de datos y su boton --}}
					@livewire('modal-carga-masiva-component')
					<div>
	
						<button wire:click='editarProveedor' class="btn btn-sm btn-warning mr-5">Modificar</button>
						<button wire:click='crearProveedor' class="btn btn-sm btn-accent">Guardar</button>
					</div>
				</div>
				{{-- loading --}}
				<div wire:loading class="position absolute left-[47%] top-[77%] drop-shadow-md">
					{{-- <span class=" loading loading-spinner text-accent w-14"></span> --}}
					{{-- <span class="loading loading-infinity w-14"></span> --}}
					<span class="loading loading-bars w-12 text-cyan-500"></span>
				</div>
				{{-- /////////////////////////////////////////////////////////////////////// --}}

				<div class="divider m-0 p-0"></div>

				<!-- tabla dentro del modal ↓ -->
				<div class="overflow-y-auto h-80">
					@livewire('tabla-nuevo-proveedores-component')
				</div>
				<!-- tabla dentro del modal ↑ -->
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