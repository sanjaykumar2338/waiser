<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function get_image_course($id){
        //return '';
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
                    //echo $presignedUrl; //die;
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