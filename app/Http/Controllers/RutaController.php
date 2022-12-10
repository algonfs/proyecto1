<?php

namespace App\Http\Controllers;

use App\Ruta;
use Illuminate\Http\Request;
use App;

class RutaController extends Controller
{

   public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $rutas = Ruta::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $rutas = Ruta::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $rutas->total(),
                'current_page' => $rutas->currentPage(),
                'per_page'     => $rutas->perPage(),
                'last_page'    => $rutas->lastPage(),
                'from'         => $rutas->firstItem(),
                'to'           => $rutas->lastItem(),
            ],
            'rutas' => $rutas
        ];
    }
    public function buscarRutaVenta(Request $request ){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $rutas = Ruta::where('destino','=', $filtro)
        ->select('id', 'destino','precio')
        ->orderBy('destino', 'asc')->take(1)->get();

        return ['rutas' => $rutas];
    }
        public function listarRutaVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
         $rutas = Ruta::select('rutas.id','rutas.destino','rutas.precio','rutas.condicion')
            ->orderBy('rutas.id', 'desc')->paginate(10);
        }
        else{
            $rutas = Ruta::select('rutas.id','rutas.destino','rutas.precio','rutas.condicion')
            ->where('rutas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('rutas.id', 'desc')->paginate(10);
        }
        

        return ['rutas' => $rutas];
    }
    public function selectRuta(Request $request){

       // if (!$request->ajax()) return redirect('/');

        $rutas = Ruta::where('condicion','=','1')
        ->select('id','destino')->orderBy('destino', 'asc')->get();
        return ['rutas' => $rutas];
    }

  
    public function store(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $ruta = new Ruta();
        $ruta->destino = $request->destino;
        $ruta->precio = $request->precio;
        $ruta->condicion = '1';
        $ruta->save();
    }
  
    public function update(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $ruta = Ruta::findOrFail($request->id);
          $ruta->destino = $request->destino;
          $ruta->precio = $request->precio;
        $ruta->condicion = '1';;
        $ruta->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ruta = Ruta::findOrFail($request->id);
        $ruta->condicion = '0';
        $ruta->save();
    }

    public function activar(Request $request)
    {
      if (!$request->ajax()) return redirect('/');
        $ruta = Ruta::findOrFail($request->id);
        $ruta->condicion = '1';
        $ruta->save();
    }
}
