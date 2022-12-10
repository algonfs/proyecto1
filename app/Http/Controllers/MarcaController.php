<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
///use Illuminate\Support\Facades\DB;
use App\Marca;
use App;

class MarcaController extends Controller
{
 
   public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $marcas = Marca::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $marcas = Marca::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $marcas->total(),
                'current_page' => $marcas->currentPage(),
                'per_page'     => $marcas->perPage(),
                'last_page'    => $marcas->lastPage(),
                'from'         => $marcas->firstItem(),
                'to'           => $marcas->lastItem(),
            ],
            'marcas' => $marcas
        ];
    }

    public function selectMarca(Request $request){

       // if (!$request->ajax()) return redirect('/');

        $marcas = Marca::where('condicion','=','1')
        ->select('id','marca')->orderBy('marca', 'asc')->get();
        return ['marcas' => $marcas];
    }

  
    public function store(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $marca = new Marca();
        $marca->marca = $request->marca;
        $marca->condicion = '1';
        $marca->save();
    }
  
    public function update(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $marca = Marca::findOrFail($request->id);
        $marca->marca = $request->marca;
        $marca->condicion = '1';
        $marca->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $marca = Marca::findOrFail($request->id);
        $marca->condicion = '0';
        $marca->save();
    }

    public function activar(Request $request)
    {
      if (!$request->ajax()) return redirect('/');
        $marca = Marca::findOrFail($request->id);
        $marca->condicion = '1';
        $marca->save();
    }


}
