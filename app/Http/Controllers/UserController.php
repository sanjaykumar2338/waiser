<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Mail;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $member_id = Session::get('user_id');
        
        if(!$member_id){
            //dd(session()->all());
            Session::put('cart_message', 'por favor inicie sesión primero.');
            return redirect('/login');
        }
    }

    public function __invoke(Request $request)
    {
        //
    }

    public function my_account(Request $request){
        $member_id = Session::get('user_id');
        if(!$member_id){
            Session::put('cart_message', 'por favor inicie sesión primero.');
            return Redirect::back();
        }

        //echo $member_id; die;
        $member_id = substr($member_id, 0, 5);
        $members = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiPMembresiaIntegrantes :membresia"),[
                ':membresia' => $member_id
            ]);

        //echo "<pre>"; print_r($members); die;
        if(!$members){
            Session::put('cart_message', 'ningún record fue encontrado.');
            return Redirect::back();
        }

        $son_arr = [];
        $daughter_arr = [];
        $sobrino = [];

        if($members){
            foreach($members as $key=>$row){
                //echo $row->Socio;echo "<br>";
                //echo $this->get_image($row->Socio);echo "<br>";
                //echo "<br>";
                $url = $this->get_image($row->Socio.'.jpeg'); 
                $members[$key]->image_url = $url;
                $row->image_url = $url;

                if(!$url){
                    $url = $this->get_image($row->Socio.'.JPEG'); 
                    $members[$key]->image_url = $url;
                    $row->image_url = $url;
                }
                

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

        //die;
        //echo "<pre>"; print_r($son_arr); 
        //echo "<pre>"; print_r($daughter_arr); 
        //echo "<pre>"; print_r($sobrino); 
        //echo "<pre>"; print_r($members); die;
        return view('pages.intergrantes')->with('members',$members)->with('son_arr',$son_arr)->with('daughter_arr',$daughter_arr)->with('sobrino',$sobrino);
    }

    public function course_selection(Request $request){
        $member_id = Session::get('user_id');
        
        if(!$member_id){
            //dd(session()->all());
            Session::put('cart_message', 'por favor inicie sesión primero.');
            return redirect('/login');
        }

        $member_id = $request->id;
        $plans = DB::connection('sqlsrv')->select(DB::raw("exec xpwplanes :socio"),[
                ':socio' => $member_id
            ]);

        $result = array();
        foreach ($plans as $element) {
            $result[$element->Coordinacion][] = $element;
        }

        $member_info = DB::connection('sqlsrv')->select(DB::raw("exec xpValidaUsuario :socio"),[
            ':socio' => $member_id
        ]);

        //echo "<pre>"; print_r($plans); die;
        //echo "<pre>"; print_r($member_info); die;
        return view('pages.course_selection')->with('result',$result)->with('member_info',$member_info[0]);
    }

    public function course_selection_part(Request $request){
        //echo "<pre>"; print_r($request->all()); die;

        $member_id = Session::get('user_id');
        
        if(!$member_id){
            //dd(session()->all());
            Session::put('cart_message', 'por favor inicie sesión primero.');
            return redirect('/login');
        }

        $plans = DB::connection('sqlsrv')->select(DB::raw("exec xpwplanes :socio"),[
                ':socio' => $request->socio_id
            ]);

        $member_id = Session::get('user_id');
        //echo $member_id; die;
        $member_id = substr($member_id, 0, 5);
        $members = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiPMembresiaIntegrantes :membresia"),[
            ':membresia' => $member_id
        ]);

        //echo "<pre>"; print_r($members); die;
        $current_member = '';
        foreach ($members as $key => $value) {
           if($value->Socio==$request->socio_id){
                $current_member = $value;
           }
        }

        //echo "<pre>"; print_r($current_member); die;
        $dob=date('Y', strtotime($current_member->FechaNacimiento));
        $diff = (date('Y') - $dob);
        

        $result = array();

        foreach ($plans as $element) {
            if($element->Coordinacion==$request->title && ($diff >= intval($element->CDIEdadMinimam) && $diff <= intval($element->CDIEdadMaxima))){
                if($element->CDISexo=='Indistinto'){
                    $result[] = $element;
                } else{
                    if($current_member->Sexo==$element->CDISexo){
                        $result[] = $element;
                    }
                }
            }
        }

        if(count($result) > 0 && $request->sede){
            $new_result = $result;
            $result = array();

            foreach($new_result as $row){
                if(in_array($row->SEDE, $request->sede)){
                    $result[] = $row;
                }
            }
        }

        if(count($result) > 0 && $request->dias){
            $new_result = $result;
            $result = array();

            foreach($new_result as $item){

                foreach($request->dias as $row){

                    if($row=='Lunes' && $item->Lunes!=""){
                        $result[] = $item;
                    }

                    if($row=='Martes' && $item->Martes!=""){
                         $result[] = $item;
                    }

                    if($row=='Miercoles' && $item->Miercoles!=""){
                         $result[] = $item;
                    }

                    if($row=='Jueves' && $item->Jueves!=""){
                         $result[] = $item;
                    }

                    if($row=='Viernes' && $item->Viernes!=""){
                         $result[] = $item;
                    }

                    if($row=='Sabado' && $item->Sabado!=""){
                         $result[] = $item;
                    }

                    if($row=='Domingo' && $item->Domingo!=""){
                        $result[] = $item;
                    }

                }
            }
        }

        //echo "<pre>"; print_r($result); die;
        //if(count($result)==0){
        //    Session::flash('message', 'No hay cursos disponibles basados en criterios como edad, sexo');
        //    return Redirect::back();
        //}

        $sede = array();
        foreach($result as $item){
            $sede[] = $item->SEDE;
        }

        if($sede){
            $sede = array_unique($sede);
        }

        $dias_param = array();
        $sede_param = array();

        $dias_param = $request->dias;
        $sede_param = $request->sede;
        //echo "<pre>"; var_dump($request->dias); //die;
        //echo "<pre>"; print_r($sede); die;
        //echo "<pre>"; print_r($current_member); die;
        //echo "<pre>"; print_r($result); die;
        //echo "<pre>"; print_r($plans); die;
        //echo "<pre>"; print_r($member_info); die;
        //echo "<pre>"; print_r($request->title); die;
        return view('pages.collection')->with('result',$result)->with('current_member',$current_member)->with('coordinacion',$request->title)->with('sede',$sede)->with('dias_param',$dias_param)->with('sede_param',$sede_param);
    }

    public function remove_cart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }

        Session::put('cart_message', 'Curso eliminado con éxito');
        //Session::flash('message', 'Curso eliminado con éxito');
        return Redirect::back();
    }

    public function update_password(Request $request){

        try{

            $member_email = Session::get('member_email');
            $socio = Session::get('user_id');

            $sql = "UPDATE dbo.cte SET contrasena='$request->password' WHERE Socio = '$socio' and email1='$member_email'";
            $update_query = DB::select(DB::raw($sql));

            /*
            $change_password = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiNewUpdatePasswd :contrasena,:Socio,:email1"),[
                ':contrasena' => $request->password,
                ':Socio' => Session::get('membresia'),
                ':email1' => Session::get('member_email')
            ]);*/

            Session::put('cart_message', 'Cambio de contraseña con éxito');
            return Redirect::back();
        }catch(\Exception $e){
            $message = $e->getMessage();
            if(strpos($message,'The active result for the query contains no fields')){
                $message = 'Cambio de contraseña con éxito';
            }
            Session::put('cart_message', $message);
            return Redirect::back();
        }
    }

    public function add_to_cart(Request $request){
        $cart = session()->get('cart', []);
        $id = $request->package.'M'.$request->member_id;
        //echo "<pre>"; print_r($cart); die;

        if(isset($cart[$id])) {

            Session::put('cart_message', 'Este curso ya está en el carrito');
            //Session::flash('message', 'Este curso ya está en el carrito');
            return Redirect::to("/course_selection_part/".$request->member_id.'/'.$request->title);
            //return Redirect::to("/course_selection_part/".$request->member_id.'/'.$request->title.'?message=Este curso ya está en el carrito');
        } else {

            $member_info = DB::connection('sqlsrv')->select(DB::raw("exec xpValidaUsuario :socio"),[
                ':socio' => $request->member_id
            ]);

            $profile_info = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiPMembresiaIntegrantes :CoberturaMedica"),[
                ':CoberturaMedica' => substr($request->member_id, 0, 5)
            ]);

            //echo "<pre>"; print_r($profile_info); die;
            $insurance_user = '';
            foreach($profile_info as $row){
                if($row->Socio==$request->member_id){
                    $insurance_user = $row;
                }
            }

            //echo "<pre>"; print_r($insurance_user); die;
            $product_info = unserialize(urldecode($request->data));
            //echo "<pre>"; print_r($product_info); die;

            $insurance_price = 0.00;
            $inusrance_required = 'no';

            $inusrance_one_price = 0.00;
            $inusrance_two_price = 0.00;

            $inusrance_one_description = '';
            $inusrance_two_description = '';

            $has_insuracne_already_added = false;
            if($cart){
                foreach ($cart as $value) {
                    if($value['member_id']==$request->member_id && $value['inusrance_required']=='yes'){
                        $has_insuracne_already_added = true;
                        break;
                    }
                }
            }

            if($insurance_user->CoberturaActual==0 && @$product_info->RequiereCoberturaMedica=='Si' && !$has_insuracne_already_added && $product_info->PeriodoActualCobMed==1){

                    $inusrance_required = 'yes';
                    $insurance_price += $product_info->ImpteCoberturaActual;
                    $inusrance_one_price = $product_info->ImpteCoberturaActual;
                    $inusrance_one_description = $product_info->DescripcionCoberturaActual;
            }

            if($insurance_user->CoberturaSiguiente==0 && @$product_info->RequiereCoberturaMedica=='Si' && !$has_insuracne_already_added && $product_info->PeriodoSiguienteCobMed==1){

                    $inusrance_required = 'yes';
                    $insurance_price += $product_info->ImpteCoberturaSiguiente;
                    $inusrance_two_price = $product_info->ImpteCoberturaSiguiente;
                    $inusrance_two_description = $product_info->DescripcionCoberturaSiguiente;
            }

            $cart[$id] = [
                "package" => $request->package,
                "member_id" => $request->member_id,
                "member_name" => $member_info[0]->Nombre,
                "station" => $request->station,
                "sport_title" => $request->title,
                "product_name" => $product_info->Descripcion,
                "product_price" => $product_info->Precio,
                "product_sede" => $product_info->SEDE,
                "product_professor" => $product_info->NombreproProf,
                "product_days" => $product_info->Lunes.' '.$product_info->Martes.' '.$product_info->Miercoles.' '.$product_info->Jueves.' '.$product_info->Viernes.' '.$product_info->Sabado.' '.$product_info->Domingo,
                "product_time" => $product_info->Horario,
                "product_image" => $product_info->SubCategoriaImagen,
                'inicio' => $product_info->Inicio,
                'fin' => $product_info->Fin,
                'inusrance_required' => $inusrance_required,
                'insurance_price' => $insurance_price,
                'inusrance_two_price' => $inusrance_two_price,
                'inusrance_two_description' => $inusrance_two_description,
                'inusrance_one_price' => $inusrance_one_price,
                'inusrance_one_description' => $inusrance_one_description,
                'product_full_information' => $request->data
            ];

            //echo "<pre>"; print_r($cart); die;

            session()->put('cart', $cart);
            Session::put('cart_message', 'Curso agregado al carrito con éxito');
            //Session::flash('message', 'Curso agregado al carrito con éxito');
            return Redirect::to("/course_selection_part/".$request->member_id.'/'.$request->title);
            //return Redirect::to("/course_selection_part/".$request->member_id.'/'.$request->title.'?message=Este curso ya está en el carrito');
        }
    }

    public function add_to_cart_detail(Request $request){
        $cart = session()->get('cart', []);
        $id = $request->package.'M'.$request->member_id;
        //echo "<pre>"; print_r($cart); die;

        if(isset($cart[$id])) {

            Session::put('cart_message', 'Este curso ya está en el carrito');
            //Session::flash('message', 'Este curso ya está en el carrito');
            return Redirect::to("/product/".$request->data.'/'.$request->station.'/'.$request->package.'/'.$request->member_id.'/'.$request->title);
            //return Redirect::to("/course_selection_part/".$request->member_id.'/'.$request->title.'?message=Este curso ya está en el carrito');
        } else {
            $member_info = DB::connection('sqlsrv')->select(DB::raw("exec xpValidaUsuario :socio"),[
                ':socio' => $request->member_id
            ]);

            $profile_info = DB::connection('sqlsrv')->select(DB::raw("exec xpcdiPMembresiaIntegrantes :CoberturaMedica"),[
                ':CoberturaMedica' => substr($request->member_id, 0, 5)
            ]);

            //echo "<pre>"; print_r($profile_info); die;
            $insurance_user = '';
            foreach($profile_info as $row){
                if($row->Socio==$request->member_id){
                    $insurance_user = $row;
                }
            }

            //echo "<pre>"; print_r($insurance_user); die;
            $product_info = unserialize(urldecode($request->data));
            //echo "<pre>"; print_r($product_info); die;

            $insurance_price = 0.00;
            $inusrance_required = 'no';

            $inusrance_one_price = 0.00;
            $inusrance_two_price = 0.00;

            $inusrance_one_description = '';
            $inusrance_two_description = '';

            $has_insuracne_already_added = false;
            if($cart){
                foreach ($cart as $value) {
                    if($value['member_id']==$request->member_id && $value['inusrance_required']=='yes'){
                        $has_insuracne_already_added = true;
                        break;
                    }
                }
            }

            if($insurance_user->CoberturaActual==0 && @$product_info->RequiereCoberturaMedica=='Si' && !$has_insuracne_already_added && $product_info->PeriodoActualCobMed==1){

                    $inusrance_required = 'yes';
                    $insurance_price += $product_info->ImpteCoberturaActual;
                    $inusrance_one_price = $product_info->ImpteCoberturaActual;
                    $inusrance_one_description = $product_info->DescripcionCoberturaActual;
            }

            if($insurance_user->CoberturaSiguiente==0 && @$product_info->RequiereCoberturaMedica=='Si' && !$has_insuracne_already_added && $product_info->PeriodoSiguienteCobMed==1){

                    $inusrance_required = 'yes';
                    $insurance_price += $product_info->ImpteCoberturaSiguiente;
                    $inusrance_two_price = $product_info->ImpteCoberturaSiguiente;
                    $inusrance_two_description = $product_info->DescripcionCoberturaSiguiente;
            }

            $cart[$id] = [
                "package" => $request->package,
                "member_id" => $request->member_id,
                "member_name" => $member_info[0]->Nombre,
                "station" => $request->station,
                "sport_title" => $request->title,
                "product_name" => $product_info->Descripcion,
                "product_price" => $product_info->Precio,
                "product_sede" => $product_info->SEDE,
                "product_professor" => $product_info->NombreproProf,
                "product_days" => $product_info->Lunes.' '.$product_info->Martes.' '.$product_info->Miercoles.' '.$product_info->Jueves.' '.$product_info->Viernes.' '.$product_info->Sabado.' '.$product_info->Domingo,
                "product_time" => $product_info->Horario,
                "product_image" => $product_info->SubCategoriaImagen,
                'inicio' => $product_info->Inicio,
                'fin' => $product_info->Fin,
                'inusrance_required' => $inusrance_required,
                'insurance_price' => $insurance_price,
                'inusrance_two_price' => $inusrance_two_price,
                'inusrance_two_description' => $inusrance_two_description,
                'inusrance_one_price' => $inusrance_one_price,
                'inusrance_one_description' => $inusrance_one_description,
                'product_full_information' => $request->data
            ];

            session()->put('cart', $cart);
            Session::put('cart_message', 'Curso agregado al carrito con éxito');
            //Session::flash('message', 'Curso agregado al carrito con éxito');
            return Redirect::to("/product/".$request->data.'/'.$request->station.'/'.$request->package.'/'.$request->member_id.'/'.$request->title);
            //return Redirect::to("/course_selection_part/".$request->member_id.'/'.$request->title.'?message=Este curso ya está en el carrito');
        }
    }

    public function get_image($id){
        try{
            $s3Client = new S3Client([
                'version'     => 'latest',
                'region'      => 'us-east-1',
                'credentials' => [
                    'key'    => 'AKIARBV6JGDHUWPUDOMJ',
                    'secret' => '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',
                ],
            ]);
                
            $bucket = 'socioscdifotos';
            $key = $id;

            $response = $s3Client->doesObjectExist($bucket,$key);
            if($response){
                $cmd = $s3Client->getCommand('GetObject', [
                    'Bucket' => $bucket,
                    'Key'    => $key
                ]);

                $request = $s3Client->createPresignedRequest($cmd, '+7 days');
                if($request){
                    $presignedUrl = (string) $request->getUri();
                    return $presignedUrl; //die;
                    //header("LOCATION: $presignedUrl");
                    //die;
                }

                return '';
            }
          }catch(\Exception $e){
            return '';
        }
    }

    public function submit_payment(Request $request){
        //echo "<pre>"; print_r($request->all());

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

        $total = $total - $coupon_discount;

        if($request->payment_type=='pay_later'){
            $cart = session()->get('cart', []);
            if($cart){
                foreach($cart as $row){
                    $product_info = (array) unserialize(urldecode($row['product_full_information']));
                    //echo "<pre>"; print_r($product_info); die;

                    $Estacion = Session::get('user_id');
                    $Modulo = $request->payment_type=='pay_later' ? 'CECDI':'CE';
                    $IdTransaccionWeb = $row['member_id'].date('d/m/y').time().uniqid();
                    $CDISocio = $row['member_id'];
                    $Id = $product_info['CEPlan'];
                    $Movimiento = $product_info['Grupo'];
                    $Concepto = $product_info['Programa'];
                    $Monto = $product_info['Precio'];
                    $UnidadCantidad = 1;
                    $FechaEmision = date('d/m/y h:i');
                    $Nombre = $row['member_name'];
                    $CDIWImagen = NULL;
                    $CDIDistribuible = NULL;
                    $CDIExclusivoMem = NULL;
                    $ReferenciaTransaccion = uniqid();
                    $FechaTransaccion = date('Y-m-d h:i').':000';
                    $CantidadComprada = 1;
                    $ImporteTransaccion = $total;
                    $ImporteDetalle = $product_info['Precio'];
                    $Estatus = 'Ordenado';
                    $RespuestaBanco = NULL;
                    $MovGeneradoV = NULL;
                    $IdMovGeneradoV = NULL;
                    $MovGeneradoCxc = NULL;
                    $IdMovGeneradoCxc = NULL;
                    $A = $product_info['DesctoPorcentaje'];
                    $B = substr($row['member_id'], 0, 5);
                    $C = $product_info['descto1'];
                    $D = $product_info['descto2'];
                    $E = $product_info['descto3'];
                    $F = $product_info['descto4'];
                    $G = $product_info['Precio'];
                    $H = $total;
                    $I = $product_info['Paquete'];
                    $J = NULL;
                    $K = NULL;
                    $L = NULL;
                    $M = NULL;
                    $N = NULL;
                    $O = $this->get_client_ip();

                    $Token = '#$%&/(2019)CDI201908010e63e6383fb838ea568a4c31da1bbc2bCDI#$%&';
                    $IdTran = '1703700202211141820320000000000000000124';
                    //echo "<pre>"; print_r(unserialize(urldecode($row['product_full_information'])));

                    $payment_param = '';
                    $payment_param = '<?xml version="1.0" encoding="ISO-8859-1"?>';
                    $payment_param .= "<CDIWTemp><row Estacion='$Estacion' Modulo='$Modulo' IdTransaccionWeb='$IdTran' Id='$Id ' Movimiento='$Movimiento' Concepto='$Concepto ' Importe='$Monto' UnidadCantidad='$UnidadCantidad' FechaEmision='$FechaEmision' CDISocio='$CDISocio' Nombre='$Nombre' CDIWImagen='$CDIWImagen' CDIDistribuible='$CDIDistribuible' CDIExclusivoMem='$CDIExclusivoMem' ReferenciaTransaccion='$ReferenciaTransaccion' FechaTransaccion='$FechaEmision' CantidadComprada='$CantidadComprada' ImporteTransaccion='$ImporteTransaccion' ImporteDetalle='$ImporteDetalle' Estatus='$Estatus' RespuestaBanco='$RespuestaBanco' MovGeneradoV='$MovGeneradoV' IdMovGeneradoV='$IdMovGeneradoV' MovGeneradoCxC='$MovGeneradoCxc' IdMovGeneradoCxC='$IdMovGeneradoCxc' A='$A' B='$B' C='$C' D='$D' E='$E' F='$F' G='$G' H='$H' I='$I' J='$J' K='$K' L='$L' M='$M' N='$N' O='$O'/></CDIWTemp>";
                    //echo $payment_param; die;
                    try{

                        $rec = DB::connection('sqlsrv')->update(DB::raw("SET NOCOUNT ON; EXEC spRecibirCobrosWeb :Token,:Estacion,:IdTran,:xml"),[
                            ':Token' => $Token,
                            ':Estacion' => $Estacion,
                            ':IdTran' => $IdTran,
                            ':xml' => $payment_param
                        ]);

                    }catch(\Exceptions $e){
                        print_r($e->getMessage());
                        die;
                    }
                }
            }
        }
    }

    public function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
