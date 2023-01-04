<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Mail;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class CouponController extends Controller
{

	public function index(Request $request){
		//echo $request->secret; die;
		if($request->secret=='9z$C&F)J@NcRfUjX'){
			$coupons = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM dbo.CDICupones"));
			//echo "<pre>"; print_r($coupons); die();
			return view('pages.coupon.index')->with('coupons',$coupons);
		}else{
			echo "page not found!!!";
		}
	}

	public function save(Request $request){

		//echo "<pre>"; print_r($request->all()); die();
		//$now = \DateTime::createFromFormat('U.u', microtime(true));
		//$date = $now->format("Y-m-d H:i:s.u");
		$date = date('Y-m-d',strtotime($request->expire_date));
		$date = "'".$date."'";
		//echo $date; die;
		try{
			$sql = "INSERT INTO dbo.CDICupones (CodigoCupon,NombreCupon,FechaCaducidad,Tipo,Cantidad,Acumulable) VALUES ('$request->coupon_code','$request->coupon_name',$date,'$request->type','$request->discount_amount','$request->user_with')";
			$save_query = DB::select(DB::raw($sql));

			Session::put('cart_message', 'Cupón guardado con éxito');
            return redirect('/coupon/index/9z$C&F)J@NcRfUjX');
		}catch(\Exception $e){
			//echo $e->getMessage(); die;
			$message = $e->getMessage();
			if(strpos($e->getMessage(),'datos varchar en datetime')!== false){
				$message = 'Cupón guardado con éxito';
			}

			if(strpos($e->getMessage(),'The active result for the query contains no fields')!== false){
				$message = 'Cupón guardado con éxito';
			}

			Session::put('cart_message', $message);
            return redirect('/coupon/index/9z$C&F)J@NcRfUjX');
		}
	}

	public function add_coupon(Request $request){
		//DB::connection('sqlsrv')->select('exec xpCDICuponConsulta("Param1", "param2",..)');
		//$sql = "INSERT INTO dbo.CDICupones (CodigoCupon,NombreCupon,FechaCaducidad,Tipo,Cantidad,Acumulable) VALUES ('John123', 'Doe', '2023-01-02','test','22','1')";

		/*
		$member_info = DB::select(DB::raw("call xpCDICuponConsulta :CodigoCupon,:NombreCupon,:FechaCaducidad,:Tipo,:Cantidad,:Acumulable"),[
		    ':CodigoCupon' => 'test1234',
		    ':NombreCupon' => 'Test',
		    ':FechaCaducidad' => '2023-01-02',
		    ':Tipo' => 'test',
		    ':Cantidad' => '20',
		    ':Acumulable' => '1'
		]);
		*/

		//$member_info = DB::select(DB::raw($sql));
		$profile_info = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM dbo.CDICupones"));

		//echo "<pre>"; print_r($profile_info); die();
		return view('pages.coupon.add');
	}

	public function edit_coupon(Request $request){

		try{

			$sql = "SELECT * FROM dbo.CDICupones WHERE Id='".$request->id."'";
			$coupon = DB::select(DB::raw($sql));
			return view('pages.coupon.edit')->with('coupon',$coupon[0]);

		}catch(\Exception $e){
			//echo $e->getMessage(); die;
			$message = $e->getMessage();
			if(strpos($e->getMessage(),'query contains no fields')!== false){
				$message = 'Cupón eliminado con éxito';
			}

			Session::put('cart_message', $message);
            return redirect('/coupon/index/9z$C&F)J@NcRfUjX');
		}
	}

	public function delete_coupon(Request $request){
		try{
			$sql = "DELETE FROM dbo.CDICupones WHERE Id='".$request->id."'";
			$query = DB::select(DB::raw($sql));

			Session::put('cart_message', 'Cupón eliminado con éxito');
            return redirect('/coupon/index/9z$C&F)J@NcRfUjX');
		}catch(\Exception $e){
			//echo $e->getMessage(); die;
			$message = $e->getMessage();
			if(strpos($e->getMessage(),'query contains no fields')!== false){
				$message = 'Cupón eliminado con éxito';
			}

			Session::put('cart_message', $message);
            return redirect('/coupon/index/9z$C&F)J@NcRfUjX');
		}
	}

	public function update(Request $request){

		//echo "<pre>"; print_r($request->all()); die();
		$date = date('Y-m-d',strtotime($request->expire_date));
		$date = "'".$date."'";
		//echo $date; die;
		try{
			$sql = "UPDATE dbo.CDICupones SET CodigoCupon='$request->coupon_code',NombreCupon='$request->coupon_name',FechaCaducidad=$date,Tipo='$request->type',Cantidad='$request->discount_amount',Acumulable='$request->user_with' WHERE Id = $request->id";
			$update_query = DB::select(DB::raw($sql));

			Session::put('cart_message', 'Cupón actualizado con éxito');
            return redirect('/coupon/index/9z$C&F)J@NcRfUjX');
		}catch(\Exception $e){
			//echo $e->getMessage(); die;
			$message = $e->getMessage();
			if(strpos($e->getMessage(),'datos varchar en datetime')!== false){
				$message = 'Cupón actualizado con éxito';
			}

			if(strpos($e->getMessage(),'The active result for the query contains no fields')!== false){
				$message = 'Cupón actualizado con éxito';
			}

			Session::put('cart_message', $message);
            return redirect('/coupon/index/9z$C&F)J@NcRfUjX');
		}
	}

	public function applyCoupon(Request $request){
		$sql = "SELECT * FROM dbo.CDICupones WHERE CodigoCupon='".$request->coupon."'";
		$coupon = DB::connection('sqlsrv')->select(DB::raw($sql));
		//echo "<pre>"; print_r($coupon); die;
		//session()->forget('cart'); die;
		if(!$coupon){
			$response = array(
	          'status' => 'error',
	          'msg' => 'Cupón no válido'
	      	);
	      	return response()->json($response);
		}

		$expire = strtotime($coupon[0]->FechaCaducidad);
		$today = time();

		if($today >= $expire){
			$response = array(
	          'status' => 'error',
	          'msg' => 'Cupón caducado'
	      	);
	      	return response()->json($response);
		}

		$cart = session()->get('cart', []);
		if($cart && $coupon[0]->Acumulable==0){
			$response = array(
	          'status' => 'error',
	          'msg' => 'Este cupón no se puede utilizar con otro cupón'
	      	);
	      	return response()->json($response);
		}

      	$coupons = session()->get('coupons', []);
      	if(isset($coupons[$coupon[0]->Id])){
      		$response = array(
	          'status' => 'error',
	          'msg' => 'Cupón ya aplicado'
	      	);

	      	return response()->json($response);
      	}
		

		$coupons[$coupon[0]->Id] = [
                "coupon_id" => $coupon[0]->Id,
                "coupon_name" => $coupon[0]->NombreCupon,
                "coupon_type" => $coupon[0]->Tipo,
                "coupon_amount" => $coupon[0]->Cantidad,
                "coupon_expiry_date" => $coupon[0]->FechaCaducidad
            ];

        //echo "<pre>"; print_r($cart); die;
        session()->put('coupons', $coupons);
        $response = array(
	          'status' => 'success',
	          'msg' => 'Cupón aplicado con éxito'
      	);

      	return response()->json($response);
	}
}