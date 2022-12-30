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
		//if($request->secret=='9z$C&F)J@NcRfUjX'){
			return view('pages.coupon.index');
		//}else{
		//	echo "page not found!!!";
		//}
	}
}