<div class="px-5">
	<div class="py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-base-300">
		<!-- Input -->
		<div class="flex items-center">
			<div class="z-10">
				<div class="relative tooltip" data-tip="Busqueda por Nº Factura o Proveedor">
					<input wire:model.live.debounce.300ms="search" type="text" id="hs-as-table-product-review-search"
						name="hs-as-table-product-review-search"
						class="py-2 px-3 ps-11 block w-full bg-gray-50 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 input-sm cursor-pointer"
						placeholder="Search">
					<div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
						<svg class="flex-shrink-0 size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg"
							width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
							stroke-linecap="round" stroke-linejoin="round">
							<circle cx="11" cy="11" r="8" />
							<path d="m21 21-4.3-4.3" />
						</svg>
					</div>
				</div>
			</div>

				<button wire:click='resetTabla' class="btn btn-square btn-xs text-white -ml-7 z-20">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>
		{{-- botones de exportar excel y pdf --}}
		<div>
			<button wire:loading.attr='disabled' wire:click="baseToExcel"
				class="ml-3 btn btn-xs btn-outline btn-accent"><span><svg class="w-4 h-4 text-gray-800 dark:text-teal-500"
						aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
						viewBox="0 0 24 24">
						<path fill-rule="evenodd"
							d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
							clip-rule="evenodd" />
						<path fill-rule="evenodd"
							d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
							clip-rule="evenodd" />
					</svg>
				</span>Excel</button>
			<button wire:loading.attr='disabled' wire:click="baseToPdf" class="ml-3 btn btn-error btn-xs btn-outline "
				wire><span><svg class="w-4 h-4 text-gray-800 dark:text-red-500" aria-hidden="true"
						xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
						<path fill-rule="evenodd"
							d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
							clip-rule="evenodd" />
						<path fill-rule="evenodd"
							d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
							clip-rule="evenodd" />
					</svg>
				</span>PDF</button>
		</div>
		<!-- End Input -->
	</div>
	<!-- End Header -->

	{{-- !table --}}
	<div class="min-w-full inline-block align-middle overflow-y-auto h-72 ">
		<table class="table table-xs table-pin-rows bg-base-100">
			<thead class="text-center">
				<tr>
					{{-- <th scope="col" class="text-start w-12">ID</th> --}}
					<th scope="col" class="">Nº FACTURA</th>
					<th scope="col" class="">PROV.</th>
					{{-- <th scope="col" class="">FECHA FAC.</th> --}}
					<th scope="col" class="">VENCE</th>
					{{-- <th scope="col" class="">AUXILIAR</th> --}}
					{{-- <th scope="col" class="">PTO.VENTA</th> --}}
					<th scope="col" class="">IMPORTE</th>
					{{-- <th scope="col" class="">GASTOS</th> --}}
					{{-- <th scope="col" class="">PROYECTO</th> --}}
					{{-- <th scope="col" class="">ACTIVACION</th> --}}
					<th scope="col" class="">t-PAGO</th>
					<th scope="col" class="">f-PAGO</th>
					<th scope="col" class="">BANCO</th>
					<th scope="col" class="">c-BANCO</th>
					<th scope="col" class="">n-CHEQUE</th>
					<th scope="col" class="">ORDEN PAGO</th>
					<th scope="col" class="w-48">ACCIÓN</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($listarTablas as $listarTabla)
				<tr wire:key='{{$listarTabla->id}}' class="text-center">
					{{-- <td class="text-start">{{$tabla['_id']}}</td> --}}
					<td>{{$listarTabla['nFactura']}}</td>
					<td>{{$listarTabla['proveedor_name']}}</td>
					<td>{{$listarTabla['fechaVencimiento']}}</td>
					{{-- parseo directamente al mostrarlo --}}
					<td>{{ number_format($listarTabla['importe'], 2, '.', ',') }}</td>
					<td>{{$listarTabla['tipoPago']}}</td>
					<td>{{$listarTabla['fechaPago']}}</td>
					<td>{{$listarTabla['banco']}}</td>
					<td>{{$listarTabla['cuentaBanco']}}</td>
					<td>{{$listarTabla['nCheque']}}</td>
					<td>{{$listarTabla['ordenPago']}}</td>
					<td class="py-1">
						{{-- boton editar --}}
						<button wire:click="$dispatch('cargarEnFormulario', { id: '{{ $listarTabla->id }}'} )" type="button"
							class="mx-3"><svg class="w-5 h-5 text-gray-800 dark:text-yellow-500" aria-hidden="true"
								xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
								<path fill-rule="evenodd"
									d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
									clip-rule="evenodd" />
								<path fill-rule="evenodd"
									d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
									clip-rule="evenodd" />
							</svg>
						</button>
						{{-- boton borrar --}}
						<button wire:click="borrarDatoBaseGeneral('{{$listarTabla->id}}')" type=" button" class="mx-3"
							wire:confirm="Estás seguro?"><svg class="w-5 h-5 text-gray-800 dark:text-red-500" aria-hidden="true"
								xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
								<path fill-rule="evenodd"
									d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
									clip-rule="evenodd" />
							</svg>
						</button>
						{{-- boton pagar que abre un modal --}}
						<button wire:click="$dispatch('idPagar', { id: '{{ $listarTabla->id }}'} )" type="button" class="mx-3"
							onclick="pagar.showModal()"><svg class="w-5 h-5 text-gray-800 dark:text-orange-600" aria-hidden="true"
								xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
								<path fill-rule="evenodd"
									d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
									clip-rule="evenodd" />
							</svg>
						</button>
					</td>
				<tr>
					@endforeach
			</tbody>
		</table>
	</div>

	{{-- loading --}}
	<div wire:loading class="position absolute left-[47%] top-[77%] drop-shadow-md">
		{{-- <span class=" loading loading-spinner text-accent w-14"></span> --}}
		{{-- <span class="loading loading-infinity w-14"></span> --}}
		<span class="loading loading-bars w-12 text-cyan-500"></span>
	</div>
	{{--! MODAL 'PAGAR FACTURAS' --}}
	@livewire('modalPagar-component')
</div>