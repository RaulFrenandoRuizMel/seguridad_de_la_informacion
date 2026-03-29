<?php

function cifrar($mensaje, $llave)   //funcion para cifrar el mensaje
{
    $inivec = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));     //vector de inicializacion para generar el cifrado
    $men_encriptado = openssl_encrypt($mensaje, "AES-256-CBC", $llave, 0, $inivec);     //metodo para cifrar la informacion
    return base64_encode($men_encriptado."::" .$inivec);    //regresa el mensaje cifrado
}

function descifrar($mensaje, $llave)    //funcion para descifar el mensaje
{
    list($datos_encriptados, $inivec) = explode('::', base64_decode($mensaje), 2);  //convert_undecode() --> otra funcion para descifrar

    return openssl_decrypt($datos_encriptados,'AES-256-CBC',$llave,0,$inivec);      //Metodo para descifrar la informacion
}

$llave = "AsDSDFSdsfDFgfds_35";     //contrase;a par acifrar y descifrar
echo "El valor de la llave es: " . $llave . "<br/><br/>";   //imprime la contrase;a en pantalla

$mensaje_cifrar = "Materia Seguridad de la informacion";    //mensaje para cifrar
echo "El mensaje a cifrar es: " . $mensaje_cifrar . "<br/><br/>";    //Imprime el mensaje a cifrar en pantalla

$mensaje_cifrado = cifrar($mensaje_cifrar, $llave);     //llama la funcion para cifrar la informacion
echo "El mensaje cifrado es: " . $mensaje_cifrado . "<br/><br/>";    //Imprime el mensaje cifrado en pantalla

$mensaje_descifrado = descifrar($mensaje_cifrado, $llave);  //Llama la funcion para descifrar la informacion
echo "El mensaje descifrado es: " . $mensaje_descifrado . "<br/><br/>";  //  imprime el mensaje descifrado en la pantalla
?>