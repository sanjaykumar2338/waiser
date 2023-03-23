<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Mail;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class ProfessorController extends Controller
{
	public function __construct(){
        $professor_login = Session::get('professor_email');
        if(!$professor_login){
            Session::put('cart_message', 'Por favor inicie sesión de nuevo.');
            return redirect('/profesores');
        }
    }

    public function __invoke(Request $request)
    {
        //
    }

    public function group(Request $request)
    {
        $rec = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiRecPlanProf :profesor"),[
                ':profesor' => Session::get('professor_id')
        ]);

        //echo "<pre>"; print_r($rec); die;
       	return view('professor.group')->with('group', $rec);
    }

    public function logout(Request $request){
        Session::forget('professor_email');
        Session::forget('professor_id');
        Session::put('cart_message', 'Sesión cerrada con éxito');
        return redirect('/profesores');
    }

    public function group_team(Request $request){
        $rec = DB::connection('sqlsrv')->select(DB::raw("exec xpCDIProfSociosRepres :profesor"),[
                ':profesor' => $request->id
        ]);

        //echo "<pre>"; print_r($rec); die;
        return view('professor.team_members')->with('members', $rec)->with('paquete_no', $request->paquete_no);
    }

    public function change_status(Request $request){
        //echo "<pre>"; print_r($request->all()); die;

        try{  
            /*          
            $rec = DB::connection('sqlsrv')->query(DB::raw("exec xpCDIInscRepreProfEstatus :socio,:paqueteno,:estatus"),[
                    ':socio' => $request->socio,
                    ':paqueteno' => $request->paqueteno,
                    ':estatus' => $request->action
            ]);
            */

            $rec = DB::connection('sqlsrv')->update(DB::raw("SET NOCOUNT ON; EXEC xpCDIInscRepreProfEstatus :socio,:paqueteno,:estatus"),[
                            ':socio' => $request->socio,
                    ':paqueteno' => $request->paqueteno,
                    ':estatus' => $request->action
                        ]);

            return response()->json(['status' => true, 'message' => 'el estado cambió con éxito']);
        }catch(\Exceptions $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }

        //echo "<pre>"; print_r($rec); die;
    }
}