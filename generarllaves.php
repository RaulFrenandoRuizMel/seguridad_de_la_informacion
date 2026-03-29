<?php

$configargs = array(
    "config" => "C:/xampp/php/extras/openssl/openssl.cnf", //ARGUMENTOS PARA GENERAR LAS LLAVES
    'private_key_bits' => 2048,
    'default_md' => "sha256"
);

$generar=openssl_pkey_new($configargs); //CREACION DE LAS LLAVES

openssl_pkey_export($generar, $keypriv, NULL, $configargs);     //EXPORTA EL CONTENIDO DE LA LLAVE PRIVADA A LAS VARIABLES $KEYPRIV

$keypub = openssl_pkey_get_details($generar);   // OBTIENE LOS VALORES DE LLLAVE PARA GENERAR LA LLAVE PUBLICA

file_put_contents('privada.key', $keypriv);     //  CREA EL ARCHIVO .KEY DE LA LLAVE PRIVADA
file_put_contents('publica.key', $keypub['key']);      //  CREA EL ARCHIVO .KEY DE LA LLAVE PRIVADA

echo "<br/> LAS LLAVES SE GENERARON CORRECTAMENTE"

?>