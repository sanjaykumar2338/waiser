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
        //echo Session::get('professor_email');
        //$sql = "Select * from dbo.Profesor where Email='".Session::get('professor_email')."'";
        ///echo $sql;
        //$member_info = DB::select(DB::raw($sql));
        //echo "<pre>"; print_r($member_info); //die; 
        //echo "<pre>"; print_r($rec); die;

        $rec = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiRecPlanProf :profesor"),[
                ':profesor' => Session::get('professor_id')
        ]);

        //echo "<pre>"; print_r($rec); die;
       	return view('professor.group')->with('group', $rec);
    }

    public function group_team(Request $request){
        $rec = DB::connection('sqlsrv')->select(DB::raw("exec xpCDIProfSociosRepres :profesor"),[
                ':profesor' => $request->id
        ]);

        //echo "<pre>"; print_r($rec); die;
        return view('professor.team_members')->with('members', $rec);
    }
}