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
            Session::flash('message', 'por favor inicie sesión primero.');
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
            Session::flash('message', 'por favor inicie sesión primero.');
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
        $member_id = Session::get('user_id');
        
        if(!$member_id){
            //dd(session()->all());
            Session::flash('message', 'por favor inicie sesión primero.');
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

        if(count($result)==0){
            Session::flash('message', 'No hay cursos disponibles basados en criterios como edad, sexo');
            return Redirect::back();
        }

        echo "<pre>"; print_r($result); die;
        //echo "<pre>"; print_r($plans); die;
        //echo "<pre>"; print_r($member_info); die;
        return view('pages.collection')->with('result',$result)->with('current_member',$current_member)->with('coordinacion',$request->title);
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
}
