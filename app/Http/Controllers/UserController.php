<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Mail;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function my_account(Request $request){
        $member_id = Session::get('user_id');
        if(!$member_id){
            Session::flash('message', 'por favor inicie sesión primero.');
            return Redirect::back();
        }

        //echo $member_id; die;
        $member_id = substr($member_id, 0, 5);
        $members = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiPMembresiaIntegrantes :membresia"),[
                ':membresia' => $member_id
            ]);

        //echo "<pre>"; print_r($members); die;
        if(!$members){
            Session::flash('message', 'ningún record fue encontrado.');
            return Redirect::back();
        }

        $son_arr = [];
        $daughter_arr = [];
        $sobrino = [];

        if($members){
            foreach($members as $row){
                if (str_contains($row->Parentesco, 'Hijo') && $row->Sexo=='Masculino') { 
                    $son_arr[] = $row;
                }

                if (str_contains($row->Parentesco, 'Hijo') && $row->Sexo=='Femenino') { 
                    $daughter_arr[] = $row;
                }

                if (str_contains($row->Parentesco, 'sobrino')) { 
                    $sobrino[] = $row;
                }
            }
        }

        //echo "<pre>"; print_r($members); die;
        return view('pages.intergrantes')->with('members',$members)->with('son_arr',$son_arr)->with('daughter_arr',$daughter_arr)->with('sobrino',$sobrino);
    }

    public function course_selection(Request $request){
        return view('pages.course_selection');
    }
}
