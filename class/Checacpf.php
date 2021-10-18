<?php

include_once("Cliente.php");
class Checacpf extends Cliente {
    public function validaCpf($cpf):bool {

echo $cpf;

if(empty($cpf)) {
    echo "Numero de CPF não encontrado";
    return false;
}

$cpf = preg_match('/[0-9]/', $cpf)?$cpf:0;

$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
 

if (strlen($cpf) != 11) {
    echo "Numero de caracteres diferente de 11";
    return false;
}

else if ($cpf == '00000000000' || 
    $cpf == '11111111111' || 
    $cpf == '22222222222' || 
    $cpf == '33333333333' || 
    $cpf == '44444444444' || 
    $cpf == '55555555555' || 
    $cpf == '66666666666' || 
    $cpf == '77777777777' || 
    $cpf == '88888888888' || 
    $cpf == '99999999999') {

        echo "CPF Invalido: Numeros repetidos frequentemente <br />";
    return false;

 } else {   
     
    
    return true;
}
    }
}


?>