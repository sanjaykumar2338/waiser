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
        return Redirect::to("/login");
    }

    public function checkout(Request $request){
        //Session::flush();
        //Session::forget('cart'); die;
        $total = 0.00;
        $cart = session()->get('cart', []);
        if($cart){
            foreach($cart as $row){
                $total += $row['product_price'] + $row['insurance_price'];
            }
        }

        $coupons = session()->get('coupons',[]);
        //echo "<pre>"; print_r($coupons); die;
        //echo $total;  die;
        $coupon_discount = 0.00;
        if($coupons && $total){
            foreach($coupons as $coupon){
                if($coupon['coupon_type']=='Percentage'){
                    //echo $coupon['coupon_amount']; die;
                    //echo ($coupon['coupon_amount'] / $total) * 100; die;
                    $percent = ($coupon['coupon_amount'] / $total) * 100;
                    $coupon_discount += round((float)$percent * 100 );
                }

                if($coupon['coupon_type']=='Fixed'){
                    $coupon_discount += $coupon['coupon_amount'];
                }
            }
        }

        //echo $coupon_discount; die;
        return view('pages.checkout')->with('coupon_discount',$coupon_discount);
    }

    public function product(Request $request){
        $product = unserialize(urldecode($request->data));
        $member_info = DB::connection('sqlsrv')->select(DB::raw("exec xpValidaUsuario :socio"),[
            ':socio' => $request->member_id
        ]);

        //echo "<pre>"; print_r($member_info); die;
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
        $member_id = Session::get('user_id');
        
        if(!$member_id){
            //dd(session()->all());

            Session::put('cart_message', 'Por favor inicia sesión para continuar.');
            return redirect('/login');
        }

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
        Session::put('cart_message', 'Sesión cerrada con éxito');
        return redirect('/home');
    }

    public function terms_condition(Request $request){
        return view('pages.terms_condition');
    }

    public function regulations(Request $request){
        return view('pages.regulations');
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

                Session::put('cart_message', 'Correo de recuperación enviado con éxito.');
                return redirect('/home');
            }else{
                Session::put('cart_message', 'Ningún record fue encontrado.');
                return Redirect::back();
            }

        }catch(\Exceptions $e){
            Session::put('cart_message', $e->getMessage());
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
                Session::put('cart_message', 'Correo de recuperación enviado con éxito.');
                return redirect('/home');
            }else{
                Session::put('cart_message', 'Ningún record fue encontrado.');
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

                $member_id = substr($rec[0]->Socio, 0, 5);
                $members = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiPMembresiaIntegrantes :membresia"),[
                    ':membresia' => $member_id
                ]);

                if($members){
                    $member_info = DB::connection('sqlsrv')->select(DB::raw("exec xpValidaUsuario :socio"),[
                        ':socio' => $rec[0]->Socio
                    ]);

                    Session::put('user_id', $rec[0]->Socio);
                    Session::put('membresia', $rec[0]->Membresia);
                    Session::put('member_name', $member_info[0]->Nombre);
                    Session::put('member_email', $member_info[0]->Email);

                    //echo "<pre>"; print_r($rec); die;
                    //dd(session()->all());
                    $message = 'Inicio de sesión exitoso.';
                    Session::put('cart_message', $message);
                    return redirect('/my_account');
                }else{
                   $message = 'Número de socio dado de baja. Favor de contactar al comité de socios.';
                   Session::put('cart_message', $message);
                   return redirect('/login'); 
                }
            }else{
                $message = 'Usuario o contraseña incorrectos';
                Session::put('cart_message', $message);
                return redirect('/login');
            }
        }catch(\Exceptions $e){
            Session::put('cart_message', $e->getMessage());
            return Redirect::back();
        }            
    }

    public function login_professor(Request $request){
        //echo Session::get('membresia');
        $members = '';
        return view('professor.login')->with('members','');
    }

    public function login_professor_submit(Request $request){
        //echo "<pre>"; print_r($request->all()); die;
        try{
            //$sql = "SELECT * FROM dbo.Ban1";
            $rec = DB::connection('sqlsrv')->select(DB::raw("exec xpLoginProf :Email, :contrasena,:contrasena2,:accion"),[
                ':Email' => $request->email,
                ':contrasena' => $request->password,
                ':contrasena2' => NULL,
                'accion' => '1'
            ]);

            //$sql = "Select * from dbo.Profesor where Email='".$request->email."'";
            ///echo $sql;
            //$member_info = DB::select(DB::raw($sql));
            //echo "<pre>"; print_r($member_info); die; 
            //echo "<pre>"; print_r($rec); die; 

            if($rec && $rec[0]->Estatus==1){
                Session::put('professor_email', $request->email);
                Session::put('professor_id', $request->password);
                Session::put('professor_login', true);
                return redirect('/profesores/group');
            }else{
                $message = 'Usuario o contraseña incorrectos';
                Session::put('cart_message', $message);
                return Redirect::back();
            }
        }catch(\Exceptions $e){
            Session::put('cart_message', $e->getMessage());
            return Redirect::back();
        }            
    }
}
