<?php 

if(!function_exists("encrypt")){
    function encrypt($plainText){
        $cipher = config("cryptographic.encryption_mode");
        $key =config("cryptographic.encryption_key");
        $ivLen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivLen);
        $cipherTextRaw = openssl_encrypt($plainText , $cipher , $key , OPENSSL_RAW_DATA , $iv);
        $hmac = hash_hmac("sha256" , $cipherTextRaw , $key , true);
        return base64_encode($iv.$hmac.$cipherTextRaw); 
    }
}
if(!function_exists("decrypt")){
    function decrypt($cipherText){
        $cipher = config("cryptographic.encryption_mode");
        $key = config("cryptographic.encryption_key");
        $decode = base64_decode($cipherText); 
        $ivLen = openssl_cipher_iv_length($cipher);
        $iv = substr($decode, 0, $ivLen);
        $hmac = substr($decode, $ivLen, 32);
        $cipherTextRaw = substr($decode , $ivLen + 32);
        $plainText = openssl_decrypt($cipherTextRaw, $cipher, $key, OPENSSL_RAW_DATA,$iv);
        $original = hash_hmac('sha256' , $cipherTextRaw , $key , true);
        if(hash_equals($hmac , $original)){
            return $plainText;
        }
    }
}