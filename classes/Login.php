<?php
    class Login{

        public static function isLoggedIn(){

            if(isset($_COOKIE['EVALUATION'])){

                if(DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['EVALUATION'])))){
                    $user_id = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['EVALUATION'])))[0]['user_id'];
                    
                    if(isset($_COOKIE['EVALUATION_'])){
                        return $user_id;
                    }
                    else{
                        $cstrong = TRUE;
                        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                        DB::query('INSERT INTO login_tokens VALUES (:token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['EVALUATION'])));
    
                        setcookie("EVALUATION", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                        setcookie("EVALUATION_", '1', time() + 60 * 60 * 24 * 6, '/', NULL, NULL, TRUE);
    
                        return $user_id;
                    }
                    
                }
            }
            return False;
        }
    

    }
?>