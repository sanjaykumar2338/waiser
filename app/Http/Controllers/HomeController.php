<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PasswordRecovery;
use DB;
use Session;
use Redirect;
use Mail;

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
        //return view('pages.home');
        return Redirect::to("/login");
    }

    public function checkout(Request $request){
        return view('pages.checkout');
    }

    public function product(Request $request){
        $product = unserialize(urldecode($request->data));
        $member_info = DB::connection('sqlsrv')->select(DB::raw("exec xpValidaUsuario :socio"),[
            ':socio' => $request->member_id
        ]);

        //echo "<pre>"; print_r($request->title); die;
        return view('pages.product')->with('product',$product)->with('member_info',$member_info[0])->with('station',$request->station)->with('package',$request->package)->with('title',$request->title)->with('coordinacion',$request->title)->with('product_data',urlencode(serialize($product)));
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
        Session::flash('message', 'Cerrar sesión con éxito');
        return redirect('/home');
    }

    public function recovery_by_email(Request $request){
        

        //$rec = DB::connection('sqlsrv')->select(DB::raw("exec xocdiRecupeEmail :socio"),[
        //        ':socio' => $request->email
        //]);
        //echo "<pre>"; print_r($rec); die;

        try{
            //$sql = "SELECT * FROM dbo.Cte where eMail1 = '$request->email' OR eMail2 = '$request->email'";
            //$rec = DB::connection('sqlsrv')->select($sql);
            //echo "<pre>"; print_r($rec); die;
            $rec = DB::connection('sqlsrv')->select(DB::raw("exec xocdiRecupeEmail :socio"),[
                ':socio' => $request->email
            ]);

            $rec2 = DB::connection('sqlsrv')->select(DB::raw("exec xpValidaUsuario :socio"),[
                ':socio' => $request->email
            ]);
            //echo "<pre>"; print_r($rec2); die;


            if($rec && $rec2){
                foreach($rec as $row){
                    //echo "<pre>"; print_r($rec); die;
                    $email = $row->Email;
                    $body = [
                        'Socio'=>$rec2[0]->Socio,
                        'Contrasena'=>$rec2[0]->Contrasena,
                        'Electronico'=>$rec2[0]->Email,
                        'Nombre'=>$rec2[0]->Nombre
                    ];
             
                    Mail::to($email)->send(new PasswordRecovery($body));
                }

                Session::flash('message', 'Correo de recuperación enviado con éxito.');
                return redirect('/home');
            }else{
                Session::flash('message', 'Ningún record fue encontrado.');
                return Redirect::back();
            }

        }catch(\Exceptions $e){
            Session::flash('message', $e->getMessage());
            return Redirect::back();
        }    
    }

    public function recovery_by_socio(Request $request){

        try{
            $rec = DB::connection('sqlsrv')->select(DB::raw("exec xpValidaUsuario :socio"),[
                ':socio' => $request->socio
            ]);

            if($rec){
                //echo "<pre>"; print_r($rec); die;
                $email = $rec[0]->Email;
                $body = [
                    'Socio'=>$rec[0]->Socio,
                    'Contrasena'=>$rec[0]->Contrasena,
                    'Electronico'=>$rec[0]->Email,
                    'Nombre'=>$rec[0]->Nombre
                ];
         
                Mail::to($email)->send(new PasswordRecovery($body));
                Session::flash('message', 'Correo de recuperación enviado con éxito.');
                return redirect('/home');
            }else{
                Session::flash('message', 'Ningún record fue encontrado.');
                return Redirect::back();
            }

        }catch(\Exceptions $e){
            Session::flash('message', $e->getMessage());
            return Redirect::back();
        }             
    }

    public function login_submit(Request $request){
        //echo "<pre>"; print_r($request->all()); die;
        try{
            //$sql = "SELECT * FROM dbo.Ban1";
            $rec = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiLoginSocios :Socio, :contrasena"),[
                ':Socio' => $request->email,
                ':contrasena' => $request->password
            ]);

            //echo "<pre>"; print_r($rec); die;            
            if($rec){
                Session::put('user_id', $rec[0]->Socio);
                Session::put('membresia', $rec[0]->Membresia);
                //echo "<pre>"; print_r($rec); die;
                //dd(session()->all());
                $message = 'Inicie sesión con éxito.';
                Session::flash('message', $message);
                return redirect('/my_account');
            }else{
                $message = 'error de inicio de sesion.';
                Session::flash('message', $message);
                return redirect('/login');
            }
        }catch(\Exceptions $e){
            Session::flash('message', $e->getMessage());
            return Redirect::back();
        }            
    }
}
