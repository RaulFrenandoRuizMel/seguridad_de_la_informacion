<?php

//CARGAR LLAVES
$keypublica  = openssl_pkey_get_public(file_get_contents('publica.key'));
$keyprivada  = openssl_pkey_get_private(file_get_contents('privada.key'));

if (!$keypublica || !$keyprivada) {
    die("Error: No se encontraron las llaves. Genera las llaves primero.");
}

//MENSAJE
$mensaje = "Mi materia Seguridad de la Informacion";
echo "<h3>Mensaje original:</h3>";
echo "<p>" . $mensaje . "</p>";


//CIFRAR MENSAJE CON AES-256
$clave_aes = openssl_random_pseudo_bytes(32);   // Clave AES aleatoria de 256 bits
$iv        = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));

$mensaje_cifrado_aes = openssl_encrypt($mensaje, 'AES-256-CBC', $clave_aes, 0, $iv);

echo "<h3>Mensaje cifrado con AES:</h3>";
echo "<p>" . $mensaje_cifrado_aes . "</p>";

//CIFRAR LA CLAVE AES CON RSA (llave pública)
openssl_public_encrypt($clave_aes, $clave_aes_cifrada, $keypublica);

echo "<h3>Clave AES cifrada con RSA (llave pública):</h3>";
echo "<p>" . base64_encode($clave_aes_cifrada) . "</p>";

//DESCIFRAR LA CLAVE AES CON RSA (llave privada)
openssl_private_decrypt($clave_aes_cifrada, $clave_aes_recuperada, $keyprivada);

echo "<h3>Clave AES descifrada con RSA (llave privada):</h3>";
echo "<p>Clave recuperada correctamente</p>";

//DESCIFRAR EL MENSAJE CON AES
$mensaje_descifrado = openssl_decrypt($mensaje_cifrado_aes, 'AES-256-CBC', $clave_aes_recuperada, 0, $iv);

echo "<h3>Mensaje descifrado:</h3>";
echo "<p>" . $mensaje_descifrado . "</p>";

// Guardar IV para poder descifrar (en producción se enviaría junto al mensaje cifrado)
?>