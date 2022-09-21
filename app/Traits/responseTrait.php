<?php

namespace App\Traits;


trait responseTrait {

   
    public function response($data=null ,$status=null,$msg=null ) {
        $array = [
            'data'=>$data,
            'msg'=>$msg,
            'status'=>$status,
        ];
        return response($array);


    }

}