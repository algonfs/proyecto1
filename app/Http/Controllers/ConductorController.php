<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Conductor;

use App;

class ConductorController extends Controller
{
  public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $conductores = Conductor::orderBy('id', 'desc')->paginate(9);
        }
        else{
            $conductores = Conductor::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(5);
        }
        

        return [
            'pagination' => [
                'total'        => $conductores->total(),
                'current_page' => $conductores->currentPage(),
                'per_page'     => $conductores->perPage(),
                'last_page'    => $conductores->lastPage(),
                'from'         => $conductores->firstItem(),
                'to'           => $conductores->lastItem(),
            ],
            'conductores' => $conductores
        ];
    }
    public function selectConductor(Request $request){

       // if (!$request->ajax()) return redirect('/');

        $conductores = Conductor::where('condicion','=','1')
        ->select('id','nombre','cedula','brevete','direccion')->orderBy('nombre', 'asc')->get();
        return ['conductores' => $conductores];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $conductor = new Conductor();
    $conductor->nombre = $request->nombre;
        $conductor->cedula = $request->cedula;
        $conductor->brevete = $request->brevete;
        $conductor->direccion = $request->direccion;
        $conductor->telefono = $request->telefono;
        $conductor->condicion = '1';
        $conductor->save();
    }
        public function listarPdf(){
        $conductores = Conductor::select('conductores.id','conductores.nombre','conductores.cedula','conductores.brevete','conductores.direccion','conductores.telefono','conductores.condicion') 
        ->orderBy('conductores.nombre', 'desc')->get();

        $cont=Conductor::count();

        $pdf = \PDF::loadView('pdf.conductorespdf',['conductores'=>$conductores,'cont'=>$cont]);
        return $pdf->download('conductores.pdf');
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $conductor = Conductor::findOrFail($request->id);
          $conductor->nombre = $request->nombre;
        // $conductor->cedula = $request->cedula;
        // $conductor->brevete = $request->brevete;
        $conductor->direccion = $request->direccion;
        $conductor->telefono = $request->telefono;
        $conductor->condicion = '1';
        $conductor->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $conductor = Conductor::findOrFail($request->id);
        $conductor->condicion = '0';
        $conductor->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $conductor = Conductor::findOrFail($request->id);
        $conductor->condicion = '1';
        $conductor->save();
    }

}
