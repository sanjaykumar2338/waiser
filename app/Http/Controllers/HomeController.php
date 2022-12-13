<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function login(Request $request){
        return view('pages.login_page');
    }

    public function forget(Request $request){
        return view('pages.forget');
    }
}
