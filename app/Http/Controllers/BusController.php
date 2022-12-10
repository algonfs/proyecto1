<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bus;
use App;

class BusController extends Controller
{
 public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $buses = Bus::join('marcas','buses.idmarca','=','marcas.id')
            ->select('buses.id','buses.idmarca','buses.planta','buses.placa','marcas.marca as nombre','buses.capacidad','buses.codicion')
            ->orderBy('buses.id', 'desc')->paginate(3);
        }
        else{
      $buses = Bus::join('marcas','buses.idmarca','=','marcas.id')
               ->select('buses.id','buses.idmarca','buses.planta','buses.placa','marcas.marca as nombre','buses.capacidad','buses.codicion')
            ->where('buses.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('buses.id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $buses->total(),
                'current_page' => $buses->currentPage(),
                'per_page'     => $buses->perPage(),
                'last_page'    => $buses->lastPage(),
                'from'         => $buses->firstItem(),
                'to'           => $buses->lastItem(),
            ],
            'buses' => $buses
        ];
    }
    public function selectBus(Request $request){

       // if (!$request->ajax()) return redirect('/');

        $buses = Bus::where('codicion','=','1')
        ->select('id','placa')->orderBy('placa', 'asc')->get();
        return ['buses' => $buses];
    }
    
        public function listarPdf(){
        $buses = Bus::join('marcas','buses.idmarca','=','marcas.id')
           ->select('buses.id','buses.idmarca','buses.planta','buses.placa','marcas.marca as nombre','buses.capacidad','buses.codicion') 
        ->orderBy('buses.placa', 'desc')->get();

        $cont=Bus::count();

        $pdf = \PDF::loadView('pdf.busespdf',['buses'=>$buses,'cont'=>$cont]);
        return $pdf->download('buses.pdf');
    }


  /*  public function buscarBus(Request $request ){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $buses = Bus::where('placa','=', $filtro)
        ->select('id', 'placa')->orderBy('placa', 'asc')->take(1)->get();

        return ['buses' => $buses];
    }*/
    public function store(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $bus = new Bus();
        $bus->idmarca = $request->idmarca;
        $bus->planta = $request->planta;
        $bus->placa = $request->placa;
        $bus->capacidad = $request->capacidad;
        $bus->codicion = '1';
        $bus->save();
    }
    public function update(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $bus =  Bus::findOrFail($request->id);
         $bus->idmarca = $request->idmarca;
        $bus->planta = $request->planta;
        $bus->placa = $request->placa;
        $bus->capacidad = $request->capacidad;
        $bus->codicion = '1';
        $bus->save();
    }

    public function desactivar(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $bus = Bus::findOrFail($request->id);
        $bus->codicion = '0';
        $bus->save();
    }

    public function activar(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $bus = Bus::findOrFail($request->id);
       $bus->codicion = '1';
        $bus->save();
    }
}
