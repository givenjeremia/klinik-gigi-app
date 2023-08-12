<?php

function encrypt($data) {
    $key_unique = 'Klinik-GIGI-APP';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc',$key_unique, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function decrypt($data) {
    $key_unique = 'Klinik-GIGI-APP';
    $data = base64_decode($data);
    $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $data = substr($data, openssl_cipher_iv_length('aes-256-cbc'));
    return openssl_decrypt($data, 'aes-256-cbc', $key_unique , 0, $iv);
}
?>