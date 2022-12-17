<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;

class HomeController extends Controller
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

    public function home(Request $request){
        /*
        $sql = "SELECT * FROM dbo.Ban1";
        $rec = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiLoginSocios :Socio, :contrasena"),[
            ':Socio' => '2413500',
            ':contrasena' => 'STJurSZk',
        ]);
        echo "<pre>"; print_r($rec); die;
        */

        
        //echo "<pre>"; print_r($rec); die;
        return view('pages.home');
    }

    public function checkout(Request $request){
        return view('pages.checkout');
    }

    public function product(Request $request){
        return view('pages.product');
    }

    public function pago(Request $request){
        return view('pages.pago');
    }

    public function collection(Request $request){
        return view('pages.collection');
    }

    public function intergrantes(Request $request){
        return view('pages.intergrantes');
    }

    public function mi_cuenta(Request $request){
        return view('pages.mi-cuenta');
    }

    public function mis_inscripciones(Request $request){
        return view('pages.mis-inscripciones');
    }

    public function forget(Request $request){
        return view('pages.forget');
    }

    public function login(Request $request){
        //echo Session::get('membresia');
        return view('pages.login_page');
    }

    public function logout(Request $request){
        //echo Session::get('membresia');
        Session::forget('user_id');
        Session::forget('membresia');
        Session::flash('message', 'Logout successfully');
        return redirect('/home');
    }

    public function login_submit(Request $request){
        //echo "<pre>"; print_r($request->all()); die;
        try{
            $sql = "SELECT * FROM dbo.Ban1";
            $rec = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiLoginSocios :Socio, :contrasena"),[
                ':Socio' => $request->email,
                ':contrasena' => $request->password
            ]);

            //echo "<pre>"; print_r($rec); die;            
            if($rec){
                $message = 'Login successfully!!!';
                Session::put('user_id', $rec[0]->Socio);
                Session::put('membresia', $rec[0]->Membresia);
                //echo "<pre>"; print_r($rec); die;
                Session::flash('message', $message);
                return redirect('/home');
            }else{
                $message = 'Login failed!!!';
                Session::flash('message', $message);
                return redirect('/login');
            }
        }catch(\Exceptions $e){
            Session::flash('message', $e->getMessage());
            return Redirect::back();
        }            
    }
}
