<?php

namespace App\Livewire;

use App\Models\Base;
use App\Models\Metrica;
use App\Models\Proveedor;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormularioGeneralComponent extends Component
{
    public $baseGeneral_id;
    #[Validate('required', message: 'Obligatorio')]
    public $proveedor_name;
    #[Validate('required', message: 'Obligatorio')]
    public $fechaFactura;
    #[Validate('required', message: 'Obligatorio')]
    public $fechaVencimiento;
    #[Validate('required', message: 'Obligatorio')]
    public $auxiliar;

    public $activacion;
    #[Validate('required', message: 'Obligatorio')]
    public $ptoVenta;
    #[Validate('required', message: 'Obligatorio')]
    public $nFactura;
    #[Validate('required', message: 'Obligatorio')]
    public $importe;
    #[Validate('required', message: 'Obligatorio')]
    public $gastos;

    public $proyecto;
    #[Validate('required', message: 'Obligatorio')]
    public $notas;
    #[Validate('required', message: 'Obligatorio')]
    public $proveedorName;
    protected $listeners = [
        'recargaSelectNombreProveedor' => 'actualizarProveedores',
    ];

    public $tipoPago;
    public $fechaPago;
    public $banco;
    public $cuentaBanco;
    public $nCheque;
    public $ordenPago;
    public $proyectarGastos;
    public $activarProyectarGastos = false;
    public $metrica_id;
    public $estado = false;
    public $proveedores;
    // contiene tanto el nombre como el id del proveedor que viene desde el select.
    public $selectedProveedor;
    // de lo anterior el id viene a esta variable y el name va a su variable mas arriba.
    public $proveedor_id;


    public function mount()
    {
        $this->actualizarProveedores();
    }

    // Convierte un string formateado a un número flotante
    public function parseNumber($number)
    {
        // Reemplaza comas (separadores de miles)
        $number = str_replace(',', '', $number); // Elimina las comas de miles

        // Convierte la cadena resultante a flotante
        return (float) $number;
    }

    // carga los datos en el formulario segun el id que nos llega
    #[On('cargarEnFormulario')]
    public function cargarEnFormulario($id)
    {
        $loadUserToForm = Base::find($id);
        $this->baseGeneral_id = $id;
        $this->proveedor_name = $loadUserToForm->proveedor_name;
        $this->fechaFactura = $loadUserToForm->fechaFactura;
        $this->fechaVencimiento = $loadUserToForm->fechaVencimiento;
        $this->auxiliar = $loadUserToForm->auxiliar;
        $this->activacion = $loadUserToForm->activacion;
        $this->ptoVenta = $loadUserToForm->ptoVenta;
        $this->nFactura = $loadUserToForm->nFactura;
        $this->importe = $loadUserToForm->importe;
        $this->gastos = $loadUserToForm->gastos;
        $this->proyecto = $loadUserToForm->proyecto;
        $this->notas = $loadUserToForm->notas;
    }

    public function actualizarDatosFormulario()
    {
        // Encontrar el registro en la colección Base
        $loadUserToForm = Base::find($this->baseGeneral_id);

        if ($loadUserToForm) {
            // Actualizar los datos de la base
            $loadUserToForm->update([
                '_id' => $this->baseGeneral_id, // Este campo no es necesario, ya que _id no cambia
                'proveedor_name' => $this->proveedor_name,
                'fechaFactura' => $this->fechaFactura,
                'fechaVencimiento' => $this->fechaVencimiento,
                'auxiliar' => $this->auxiliar,
                'activacion' => $this->activacion,
                'ptoVenta' => $this->ptoVenta,
                'nFactura' => $this->nFactura,
                'importe' => $this->parseNumber($this->importe),
                'gastos' => $this->gastos,
                'proyecto' => $this->proyecto,
                'notas' => $this->notas,
            ]);

            // Buscar el registro relacionado en la colección Metrica
            $loadMetricaById = Metrica::where('base_id', $this->baseGeneral_id)->first();

            if ($loadMetricaById) {
                // Calcular el valor de proyectarGastos
                $mesCarbon = Carbon::parse($this->fechaFactura)->month;
                $mesesProyectados = 12 - $mesCarbon;
                $this->proyectarGastos = $this->importe * $mesesProyectados;

                // Actualizar la métrica relacionada
                $loadMetricaById->update([
                    'proyectarGastos' => $this->proyectarGastos,
                    'mesActual' => $mesCarbon, // Opcional, si necesitas almacenar el mes
                ]);
            }
            return $this->redirect('/general', navigate: true);
        }
    }

    // Actualiza la lista de proveedores
    public function actualizarProveedores()
    {
        $this->proveedorName = Proveedor::pluck('proveedor_name');
        $this->proveedores = Proveedor::all();
    }

    // crea un nuevo dato en la base de datos
    public function nuevoDatoBaseGeneral()
    {
        $this->validate();


        $proveedor = Proveedor::find($this->proveedor_id);
        $numeroCC_delProveedor = $proveedor ? $proveedor->numeroCC : null;
        
        // Formatear las fechas antes de guardarlas
        $fechaFacturaFormateada = Carbon::parse($this->fechaFactura)->format('d-m-Y');
        $fechaVencimientoFormateada = Carbon::parse($this->fechaVencimiento)->format('d-m-Y');

            $base = Base::create([
            'baseGeneral_id' => $this->baseGeneral_id ?? '',
            'proveedor_name' => strtolower($this->proveedor_name),
            'fechaFactura' => $fechaFacturaFormateada,
            'fechaVencimiento' =>  $fechaVencimientoFormateada,
            'auxiliar' => strtolower($this->auxiliar),
            'activacion' => $this->activacion,
            'ptoVenta' => strtolower($this->ptoVenta),
            'nFactura' => strtolower($this->nFactura),
            'importe' => $this->parseNumber($this->importe),
            'gastos' => $this->gastos,
            'proyecto' => strtolower($this->proyecto),
            'notas' => strtolower($this->notas),
            'tipoPago' => $this->tipoPago ?? '-',
            'fechaPago' => $this->fechaPago ?? '-',
            'banco' => $this->banco ?? '-',
            'cuentaBanco' => $this->cuentaBanco ?? '-',
            'nCheque' => $this->nCheque ?? '-',
            'ordenPago' => $this->ordenPago ?? '-',
            'estado' => strtolower($this->estado),
            'proveedor_id' => $this->proveedor_id,
            // casting a string
            'cc' => (string) $numeroCC_delProveedor,
        ]);



        $this->dispatch('estado_fromFormularioGeneralComponent', estado: $this->estado);

        $base_id  = $base->_id;

        if ($this->activarProyectarGastos == true) {
            $this->proyectarGastos($base_id);
        }

        // refresco la pagina
        return $this->redirect('/general', navigate: true);
    }

    // proyecta los gastos de un dato en la base de datos
    public function proyectarGastos($base_id)
    {
        $base_id = $base_id;
        $mesCarbon = Carbon::parse($this->fechaFactura)->month;

        $mesesProyectados = 12 - $mesCarbon;
        $this->proyectarGastos = $this->importe * $mesesProyectados;

        Metrica::create([
            'proyectarGastos' => $this->proyectarGastos,
            'mesActual' => $mesCarbon,
            'base_id' => $base_id,
        ]);

        return $this->redirect('/general', navigate: true);
    }


    // detecta el cambio del select y separa los datos que llegan desde el value en name e id.
    public function updatedSelectedProveedor($value)
    {
        if ($value) {
            // Divide el valor usando "%" como separador
            [$this->proveedor_name, $this->proveedor_id] = explode('%', $value);
        }
    }

    public function render()
    {
        // ORDEN ALFABETICO DE LOS PROVEEDORES POR SU NOMBRE
        $this->proveedores = Proveedor::orderBy('proveedor_name', 'asc')->get();

        return view('livewire.formulario-general-component', [
            'proveedores' => $this->proveedores
        ]);
    }
}
