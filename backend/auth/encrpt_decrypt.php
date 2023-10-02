<?php

// function encrypt($data) {
//     $key_unique = 'Klinik-GIGI-APP';
//     $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
//     $encrypted = openssl_encrypt($data, 'aes-256-cbc',$key_unique, 0, $iv);
//     return base64_encode($iv . $encrypted);
// }

// function decrypt($data) {
//     $key_unique = 'Klinik-GIGI-APP';
//     $data = base64_decode($data);
//     $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
//     $data = substr($data, openssl_cipher_iv_length('aes-256-cbc'));
//     return openssl_decrypt($data, 'aes-256-cbc', $key_unique , 0, $iv);
// }

// $text = "given";

// try {
//     echo decrypt($text);

// } catch (\Throwable $th) {
//     echo $text;
// }

function decrypt($data) {
    $key_unique = 'Klinik-GIGI-APP';
    $asli = $data;
    $data = base64_decode($data);
    $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $data = substr($data, openssl_cipher_iv_length('aes-256-cbc'));

    try {
        if (strlen($iv) !== openssl_cipher_iv_length('aes-256-cbc')) {
            throw new \Exception('Invalid IV length');
        }
        $decrypted = openssl_decrypt($data, 'aes-256-cbc', $key_unique, 0, $iv);
        if ($decrypted === false) {
            throw new \Exception('Decryption failed');
        }
        return $decrypted;
    } catch (\Throwable $th) {
    
        return $asli;
    }
}

$text = "6aEBvEYeS7P83fI9XkpKlVVFY1NtdEdoOEpxdWxraE1uSi85ZGc9PQ==";
echo decrypt($text);

try {
} catch (\Throwable $th) {
    // You can choose to handle this exception differently or not display the error message to the user
    // echo "Decryption failed or an error occurred";
}


?>