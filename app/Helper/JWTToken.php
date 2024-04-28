<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function generateToken($user_email,$user_id):string{
        $key=env("JWT_KEY");
        $payload=[
            "iss"=>"laravel-token",
            "iat"=> time(),
            "exp"=> time()+60*60,
            "user_email"=> $user_email,
            "user_id"=> $user_id
        ];
         return JWT::encode($payload, $key, "HS256");
    }

    public static function checkToken($token){
        try{
            if($token==null){
                return "unauthorized";
            }else{
                $key=env("JWT_KEY");
                $decode = JWT::decode($token, new Key($key,"HS256"));
            }

        }
        catch(Exception $e){
            return "unauthorized";
        }


    }

    public static function createTokenForSetPassword($user_email):string{

        $key=env("JWT_KEY");
        $payload=[
            "iss"=>"laravel-token",
            "iat"=> time(),
            "exp"=> time()+60*60,
            "user_email"=> $user_email,
            "user_id"=>'0'

        ];
        return JWT::encode($payload, $key, "HS256");
    }


  public static function verifyToken($token){
    try{
        if($token==null){
            return "unauthorized";
        }else{
            $key=env("JWT_KEY");
            $decode = JWT::decode($token, new Key($key,"HS256"));
            return $decode;
        }

    }catch(Exception $e){
        return "unauthorized";
    }

}

}
