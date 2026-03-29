<?php

$datos = "mi materia Seguridad de la informacion";  //TEXTO A CIFRAR
echo "<br/>El texto a cifrar es: ". $datos . "<br/><br/>";

$keypublica = openssl_pkey_get_public(file_get_contents('publica.key'));    //EXTRAE EL COTENIDO DEL ARCHIVO DE LA LLAVE PUBLICA

openssl_public_encrypt($datos, $datos_cifrados, $keypublica);   //METODO PARA CIFRAR LOS DATOS

echo "Los dats cifrados son: " . $datos_cifrados . "<br/><br/>";    //IMPRIME LA INFORMACION CIFRADA

$keyprivada = openssl_pkey_get_private(file_get_contents('privada.key'));   //EXTRAE EL COTENIDO DEL ARCHIVO DE LA LLAVE PRIVADA

openssl_private_decrypt($datos_cifrados, $datos_descifrados, $keyprivada);  //METODO PARA DESCIFRAR LOS DATOS

echo "LOIS DATOS DESCIFRADOS SON: " . $datos_descifrados . "<br/><br/>";     //IMPIME LA INFORMACION DESCIFRADA

?>