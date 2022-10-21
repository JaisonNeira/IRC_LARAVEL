<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\tipos_proceso;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\Failure;
use App\Imports\BrigadaImport;
use App\Imports\HospitalizadoImport;
use App\Imports\InasistidoImport;
use App\Imports\RecordatorioImport;
use App\Imports\ReprogramacionImport;
use App\Imports\SeguimientoImport;

class ImportarController extends Controller
{


    function index(){
        $tipos_procesos = tipos_proceso::where('tpp_estado', '=','1')->get();

        return view('importar.index', compact('tipos_procesos'));
    }

    function importar(request $request){

        $request->validate([
            'tipo_proceso' => 'required',
            'file' => 'required'
        ]);

        return DB::transaction(function () use ($request){

            $tipo = $request->tipo_proceso;
            $file = $request->file('file');

            if($tipo == '1'){
                /* inasistidos */
                try {
                    Excel::import(new InasistidoImport, $file);
                    return back()->with('mSucces', 'Inasistidos importados exitosamente!');
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    /* $failures = $e->failures();
                    return back()->with('import_error', $failures); */
                    return back()->with('mDanger', 'No se ha podido importar los inasistidos!');
                }
            }
            else if($tipo == '2'){
                /* seguimiento */
                try {
                    Excel::import(new SeguimientoImport, $file);
                    return back()->with('mSucces', 'Seguimientos importados exitosamente');
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    return back()->with('import_error', $failures);
                }
            }
            else if($tipo == '3'){
                /* recordatorio */
                try {
                    Excel::import(new RecordatorioImport, $file);
                    return back()->with('mSucces', 'Recordatorios importados exitosamente');
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    return back()->with('import_error', $failures);
                }
            }
            else if($tipo == '4'){
                /* hospitalizados */
                try {
                    Excel::import(new HospitalizadoImport, $file);
                    return back()->with('mSucces', 'Hospitalizados importados exitosamente');
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    return back()->with('import_error', $failures);
                }
            }
            else if($tipo == '5'){
                /* brigadas */
                try {

                    Excel::import(new BrigadaImport, $file);

                    
                    return back()->with('mSucces', 'Brigadas importadas exitosamente');
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    return back()->with('import_error', $failures);
                }
            }
            else if($tipo == '6'){
                /* reprogramacion */
                try {
                    Excel::import(new ReprogramacionImport, $file);
                    return back()->with('mSucces', 'Reprogramaciones importadas exitosamente');
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    return back()->with('import_error', $failures);
                }
            }
            else{

            }

        }, 5);


    }

}
