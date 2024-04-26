<?php

if (isset ($_POST['enviar'])){
    if (!empty($_POST['g-recaptcha-response'])){
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $secret = "6Lff9KMpAAAAAGUqLLHlvyxXVB8VWm9M-4tnPQ4X";
        $response = $_POST['g-recaptcha-response'];
        $variaveis = "secret=".$secret."&response=".$response;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $variaveis);
        curl_setopt($ch, CURLOPT_FOLLOWCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $resposta = curl_exec($ch);
        // print_r($resposta);
        $resultado = json_decode($resposta);
        // print_r($resposta);
        // echo $resultado->suscess;
        if ($resultado->suscess == 1){
            echo "Constinuar envio do seu formulário";
        }
    }
}

?>