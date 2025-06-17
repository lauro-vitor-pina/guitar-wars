<?php

require_once(__DIR__ . '../../../appvars.php');

//a função verifica se frase digitada no capctha é valida
function captcha_validator($senha)
{
    $senha_criptografada = sha1($senha);

    return $senha_criptografada == $_SESSION[KEY_SESSION_CAPTCHA_PASSWORD];
}
