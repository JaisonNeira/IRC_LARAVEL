<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\tipos_proceso;
use App\Models\actas_cargue;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\Failure;
use App\Imports\BrigadaImport;
use App\Imports\HospitalizadoImport;
use App\Imports\InasistidoImport;
use App\Imports\RecordatorioImport;
use App\Imports\ReprogramacionImport;
use App\Imports\SeguimientoImport;
use App\Imports\CaptacionImport;

use PDF;
use Illuminate\Support\Facades\Mail;
/* use App\Mail\ImportMailable; */

class ImportarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            /* VALIDACIONES */
            $tipo = $request->tipo_proceso;
            $file = $request->file('file');
            $file_name = $request->file_name;
            $file_ir = substr($file_name, 0, -18);
            $file_pro = substr($file_name, 2, -15);
            $file_fecha = substr($file_name, 5, -7);
            $file_v = substr($file_name, 13, 2);
            $file_tipe = substr($file_name, 16);
            $file_len = strlen($file_name);

            $email = $request->email;

            /* VALIDAMOS QUE EL NOMBRE DEL ARCHIVO ESTE BIEN */
            if($file_len != 20 || $file_ir != "IR"){
                return back()->with('mDanger', 'El nombre del archivo no es adecuado, cambielo e intentelo nuevamente!');
            }
            /* VALIDAMOS QUE SEA UN ARCHOVO XLSX */
            if($file_tipe != "xlsx"){
                return back()->with('mDanger', 'Tipo de archivo erroneo, debe ser formato excel (.xlsx)!');
            }

            $validador_car = actas_cargue::where('Acc_nombre', '=',substr($file_name, 0, -5))->count();
            if($validador_car > 0){
                return back()->with('mDanger', 'Ya subio un archivo con este mismo nombre!');
            }

            /* VALIDAMOS QUE LA FECHA EN EL NOMBRE DEL ARCHIVO ESTE BIEN */
            $año = intval(substr($file_fecha, 0, -4));
            $mes = intval(substr($file_fecha, 4, -2));
            $dia = intval(substr($file_fecha, 6));

            if($mes > 12 || $dia > 31 || $mes < 0 || $dia < 0 || $mes == 0 || $año == 0 || $dia == 0){
                return back()->with('mDanger', 'La fecha dentro del nombre es invalida!');
            }

            if($tipo == '1'){
                /* inasistidos */

                if($file_pro != "INA"){
                    return back()->with('mDanger', 'Este archivo no es de inasistidos, seleccione un tipo correcto!');
                }

                $fecha = date('Ymd-hms');
                $acc_codigo = substr($file_name, 0, -5)."-".$fecha;

                try {

                    $excel = Excel::import(new InasistidoImport($acc_codigo, substr($file_name, 0, -5)), $file);

                    /* return back()->with('import_pro', $acc_codigo); */
                    $acta = actas_cargue::where('Acc_codigo', $acc_codigo)->get();

                    $pdf = PDF::loadView('importar.pdf-correcto', compact('acta'));

                    /* Mail::send('email.email_validacion', compact($acta), function ($mail) use ($pdf, $email) {
                        $mail->from('contactatest2020@gmail.com', 'Admin IRC');
                        $mail->to($email);
                        $mail->attachData($pdf->output(), 'ActaCargue.pdf');
                    }); */

                    /* return back()->with('mSucces', 'Inasistidos importados exitosamente'); */
                    return $pdf->download(substr($file_name, 0, -5).'ActaCargue.pdf');

                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    $nombre = substr($file_name, 0, -5);
                    $pdf = PDF::loadView('importar.pdf-incorrecto', compact('failures','nombre'));
                    return $pdf->stream('Actaerror.pdf');
                    /* return back()->with('import_error', $failures); */
                }
            }
            else if($tipo == '2'){
                /* seguimiento */

                if($file_pro != "SEG"){
                    return back()->with('mDanger', 'Este archivo no es de seguimientos, seleccione un tipo correcto!');
                }

                $fecha = date('Ymd-hms');
                $acc_codigo = substr($file_name, 0, -5)."-".$fecha;

                try {

                    $excel = Excel::import(new SeguimientoImport($acc_codigo, substr($file_name, 0, -5)), $file);

                    /* return back()->with('import_pro', $acc_codigo); */
                    $acta = actas_cargue::where('Acc_codigo', $acc_codigo)->get();

                    $pdf = PDF::loadView('importar.pdf-correcto', compact('acta'));

                    /* Mail::send('email.email_validacion', compact($acta), function ($mail) use ($pdf, $email) {
                        $mail->from('contactatest2020@gmail.com', 'Admin IRC');
                        $mail->to($email);
                        $mail->attachData($pdf->output(), 'ActaCargue.pdf');
                    }); */

                    /* return back()->with('mSucces', 'Seguimientos importados exitosamente!'); */
                    return $pdf->download(substr($file_name, 0, -5).'ActaCargue.pdf');

                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    $nombre = substr($file_name, 0, -5);
                    $pdf = PDF::loadView('importar.pdf-incorrecto', compact('failures','nombre'));
                    return $pdf->stream('Actaerror.pdf');
                    /* return back()->with('import_error', $failures); */
                }
            }
            else if($tipo == '3'){
                /* recordatorio */

                if($file_pro != "REC"){
                    return back()->with('mDanger', 'Este archivo no es de recordatorios, seleccione un tipo correcto!');
                }

                $fecha = date('Ymd-hms');
                $acc_codigo = substr($file_name, 0, -5)."-".$fecha;

                try {

                    $excel = Excel::import(new RecordatorioImport($acc_codigo, substr($file_name, 0, -5)), $file);

                    /* return back()->with('import_pro', $acc_codigo); */
                    $acta = actas_cargue::where('Acc_codigo', $acc_codigo)->get();

                    $pdf = PDF::loadView('importar.pdf-correcto', compact('acta'));

                    /* Mail::send('email.email_validacion', compact($acta), function ($mail) use ($pdf, $email) {
                        $mail->from('contactatest2020@gmail.com', 'Admin IRC');
                        $mail->to($email);
                        $mail->attachData($pdf->output(), 'ActaCargue.pdf');
                    }); */

                    /* return back()->with('mSucces', 'Recordatorios importados exitosamente!'); */
                    return $pdf->download(substr($file_name, 0, -5).'ActaCargue.pdf');

                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    $nombre = substr($file_name, 0, -5);
                    $pdf = PDF::loadView('importar.pdf-incorrecto', compact('failures','nombre'));
                    return $pdf->stream('Actaerror.pdf');
                    /* return back()->with('import_error', $failures); */
                }
            }
            else if($tipo == '4'){
                /* hospitalizados */

                if($file_pro != "HOS"){
                    return back()->with('mDanger', 'Este archivo no es de hospitalizados, seleccione un tipo correcto!');
                }

                $fecha = date('Ymd-hms');
                $acc_codigo = substr($file_name, 0, -5)."-".$fecha;

                try {

                    $excel = Excel::import(new HospitalizadoImport($acc_codigo, substr($file_name, 0, -5)), $file);

                    /* return back()->with('import_pro', $acc_codigo); */
                    $acta = actas_cargue::where('Acc_codigo', $acc_codigo)->get();

                    $pdf = PDF::loadView('importar.pdf-correcto', compact('acta'));

                    /* Mail::send('email.email_validacion', compact($acta), function ($mail) use ($pdf, $email) {
                        $mail->from('contactatest2020@gmail.com', 'Admin IRC');
                        $mail->to($email);
                        $mail->attachData($pdf->output(), 'ActaCargue.pdf');
                    }); */

                    /* return back()->with('mSucces', 'Hospitalizados importados exitosamente'); */
                    return $pdf->download(substr($file_name, 0, -5).'ActaCargue.pdf');

                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    $nombre = substr($file_name, 0, -5);
                    $pdf = PDF::loadView('importar.pdf-incorrecto', compact('failures','nombre'));
                    return $pdf->stream('Actaerror.pdf');
                    /* return back()->with('import_error', $failures); */
                }
            }
            else if($tipo == '5'){
                /* brigadas */

                if($file_pro != "BRI"){
                    return back()->with('mDanger', 'Este archivo no es de brigadas, seleccione un tipo correcto!');
                }

                $fecha = date('Ymd-hms');
                $acc_codigo = substr($file_name, 0, -5)."-".$fecha;

                try {

                    $excel = Excel::import(new BrigadaImport($acc_codigo, substr($file_name, 0, -5)), $file);

                    /* return back()->with('import_pro', $acc_codigo); */
                    $acta = actas_cargue::where('Acc_codigo', $acc_codigo)->get();

                    $pdf = PDF::loadView('importar.pdf-correcto', compact('acta'));

                    /* Mail::send('email.email_validacion', compact($acta), function ($mail) use ($pdf, $email) {
                        $mail->from('contactatest2020@gmail.com', 'Admin IRC');
                        $mail->to($email);
                        $mail->attachData($pdf->output(), 'ActaCargue.pdf');
                    }); */

                    /* return back()->with('mSucces', 'Brigadas importadas exitosamente'); */
                    return $pdf->download(substr($file_name, 0, -5).'ActaCargue.pdf');

                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    $nombre = substr($file_name, 0, -5);
                    $pdf = PDF::loadView('importar.pdf-incorrecto', compact('failures','nombre'));
                    return $pdf->stream('Actaerror.pdf');
                    /* return back()->with('import_error', $failures); */

                }
            }
            else if($tipo == '6'){
                /* reprogramacion */

                if($file_pro != "REP"){
                    return back()->with('mDanger', 'Este archivo no es de reprogramaciones, seleccione un tipo correcto!');
                }

                $fecha = date('Ymd-hms');
                $acc_codigo = substr($file_name, 0, -5)."-".$fecha;

                try {

                    $excel = Excel::import(new ReprogramacionImport($acc_codigo, substr($file_name, 0, -5)), $file);

                    /* return back()->with('import_pro', $acc_codigo); */
                    $acta = actas_cargue::where('Acc_codigo', $acc_codigo)->get();

                    $pdf = PDF::loadView('importar.pdf-correcto', compact('acta'));

                    /* Mail::send('email.email_validacion', compact($acta), function ($mail) use ($pdf, $email) {
                        $mail->from('contactatest2020@gmail.com', 'Admin IRC');
                        $mail->to($email);
                        $mail->attachData($pdf->output(), 'ActaCargue.pdf');
                    }); */

                    /* return back()->with('mSucces', 'Reprogramaciones importadas exitosamente'); */
                    return $pdf->download(substr($file_name, 0, -5).'ActaCargue.pdf');

                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    $nombre = substr($file_name, 0, -5);
                    $pdf = PDF::loadView('importar.pdf-incorrecto', compact('failures','nombre'));
                    return $pdf->stream('Actaerror.pdf');
                    /* return back()->with('import_error', $failures); */
                }
            }
            else if($tipo == '7'){
                /* captacion */

                if($file_pro != "CAP"){
                    return back()->with('mDanger', 'Este archivo no es de captacion, seleccione un tipo correcto!');
                }

                $fecha = date('Ymd-hms');
                $acc_codigo = substr($file_name, 0, -5)."-".$fecha;

                try {

                    $excel = Excel::import(new CaptacionImport($acc_codigo, substr($file_name, 0, -5)), $file);

                    /* return back()->with('import_pro', $acc_codigo); */
                    $acta = actas_cargue::where('Acc_codigo', $acc_codigo)->get();

                    $pdf = PDF::loadView('importar.pdf-correcto', compact('acta'));

                    /* Mail::send('email.email_validacion', compact($acta), function ($mail) use ($pdf, $email) {
                        $mail->from('contactatest2020@gmail.com', 'Admin IRC');
                        $mail->to($email);
                        $mail->attachData($pdf->output(), 'ActaCargue.pdf');
                    }); */

                    Session::flash('mSucces', 'Captaciones importadas exitosamente');
                    return $pdf->download(substr($file_name, 0, -5).'ActaCargue.pdf');

                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    $nombre = substr($file_name, 0, -5);
                    $pdf = PDF::loadView('importar.pdf-incorrecto', compact('failures','nombre'));
                    return $pdf->stream('Actaerror.pdf');
                    /* return back()->with('import_error', $failures); */
                }
            }
            else{
                return back()->with('mDanger', 'Error en la seleccion del proceso!');
            }

        }, 5);


    }

}
