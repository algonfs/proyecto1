<?php

namespace App\Http\Controllers;

use App\Viaje;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
//use App\Bus;
//use App\Ruta;
//use App\Conductor;
use App;
//use App\Notifications\NotifyAdmin;

class ViajeController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){

          $viajes = Viaje::join('conductores','viajes.idconductor','=','conductores.id')
             ->join('buses','viajes.idbus','=','buses.id')
            ->join('rutas','viajes.idruta','=','rutas.id')
              ->select('viajes.id','viajes.descripcion','viajes.condicion','conductores.nombre as conductor','buses.placa as numero','rutas.destino as nombre')    
            ->orderBy('viajes.id', 'desc')->paginate(10);
        }
        else{
        $viajes = Viaje::join('conductores','viajes.idconductor','=','conductores.id')
             ->join('buses','viajes.idbus','=','buses.id')
            ->join('rutas','viajes.idruta','=','rutas.id')
          ->select('viajes.id','viajes.descripcion','viajes.condicion','conductores.nombre as conductor','buses.placa as numero','rutas.destino as nombre')        
            ->where('viajes.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('viajes.id', 'desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $viajes->total(),
                'current_page' => $viajes->currentPage(),
                'per_page'     => $viajes->perPage(),
                'last_page'    => $viajes->lastPage(),
                'from'         => $viajes->firstItem(),
                'to'           => $viajes->lastItem(),
            ],
            'viajes' => $viajes
        ];
    }
  

    
public function listarPdf(){
        $viajes = Viaje::join('conductores','viajes.idconductor','=','conductores.id')
             ->join('buses','viajes.idbus','=','buses.id')
            ->join('rutas','viajes.idruta','=','rutas.id')
           ->select('viajes.id','viajes.descripcion','viajes.condicion','conductores.nombre as conductor','buses.placa as numero','rutas.destino as nombre')
        ->orderBy('viajes.descripcion', 'desc')->get();

        $cont=Viaje::count();

        $pdf = \PDF::loadView('pdf.viajespdf',['viajes'=>$viajes,'cont'=>$cont]);
        return $pdf->download('viajes.pdf');
    }

    public function store(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $viaje = new Viaje();
        $viaje->idconductor = $request->idconductor;
        $viaje->idbus = $request->idbus;
        $viaje->idruta = $request->idruta;
        $viaje->descripcion = $request->descripcion;
        $viaje->condicion = '1';
        $viaje->save();
    }
    public function update(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $viaje = Viaje::findOrFail($request->id);
        $viaje->idconductor = $request->idconductor;
        $viaje->idbus = $request->idbus;
        $viaje->idruta = $request->idruta;
        $viaje->descripcion = $request->descripcion;
        $viaje->condicion = '1';
        $viaje->save();
    }

    public function desactivar(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $viaje = Viaje::findOrFail($request->id);
        $viaje->condicion = '0';
        $viaje->save();
    }

    public function activar(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $viaje = Viaje::findOrFail($request->id);
       $viaje->condicion = '1';
        $viaje->save();
    }
}
