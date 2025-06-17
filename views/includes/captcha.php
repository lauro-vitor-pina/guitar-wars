<?php
require_once(__DIR__ . '../../../appvars.php');
require_once(__DIR__ . '/session_start.php');

define('CAPTCHA_NUMCHARS', 6); //numeros de caracteres na senha
define('CAPTCHA_WIDTH', 100); //largura da imagem
define('CAPTCHA_HEIGHT', 25); //altura da imagem
define('CAPTCHA_PATH_FONTS', '/usr/share/fonts/truetype/');


$senha_captcha = gerar_senha_captcha();

$_SESSION[KEY_SESSION_CAPTCHA_PASSWORD] = sha1($senha_captcha); //armazena a senha criptografada em uma variável de sessão.

$imagem_captcha = gerar_imagem_captcha($senha_captcha);

header('Content-type: image/png'); //faz o output da imagem como PNG, usando o cabeçalho.

imagepng($imagem_captcha); //gera uma imagem PNG contendo tudo o que foi desenhado.

imagedestroy($imagem_captcha); //liberar os recursos da imagem criada.


function gerar_senha_captcha() //gera uma senha aleatória
{

    $senha_captcha = '';

    for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++) {
        //esta função interna rand retorna um número aleartório. 
        //Para obter um número aleatório dentro de uma determinada faixa, basta enviar os limites inferior e superior da faixa.
        //Nós só precisamos dos códigos ASCII na faixa de 97-122, que representa letras minusculas de a-z
        $random_number = rand(97, 122);

        $senha_captcha .= chr($random_number); // esta função interna chr converte um número no seu caracter ASCII equivalente.
    }

    return $senha_captcha;
}


function gerar_imagem_captcha($senha_captcha)
{
    //GD: GRAPHICS DRAW

    //a função imagecreatetruecolor cria uma imagem em branco na memória,
    //pronta para ser editada por outras funções GD. Os dois argumentos são a largura e altura da imagem.
    $img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT); //cria a imagem

    //define as cores que serão utilizadas na imagem
    $bg_color = imagecolorallocate($img, 255, 255, 255); //branco
    $text_color = imagecolorallocate($img, 0, 0, 0); //preto
    $graphic_color = imagecolorallocate($img, 64, 64, 64); //cinza


    //a função imagefilledrectangle desenha um retângulo começando em um ponto e terminando em outro com uma cor especificada.
    //existem também o imagerectangle a diferença é que o imagefilledrectangle desenha um retângulo cujo interior é preenchido com a cor especificada.
    $rectangle_x1 = 0;
    $rectangle_y1 = 0;
    $rectangle_x2 = CAPTCHA_WIDTH;
    $rectangle_y2 = CAPTCHA_HEIGHT;
    imagefilledrectangle($img, $rectangle_x1, $rectangle_y1, $rectangle_x2, $rectangle_y2, $bg_color); // preenche o fundo

    //desenha linhas aleatórias
    for ($i = 0; $i < 5; $i++) {

        $line_x1 = 0;
        $line_y1 = rand() % CAPTCHA_HEIGHT;
        $line_x2 = CAPTCHA_WIDTH;
        $line_y2 = rand() % CAPTCHA_HEIGHT;

        //a função imageline desenha uma linha entre dois pontos ou coordenadas (x1,y1,x2,y2)
        imageline($img, $line_x1, $line_y1, $line_x2, $line_y2, $graphic_color);
    }

    //desenha pontos aleatórios
    for ($i = 0; $i < 50; $i++) {

        $point_x = rand() % CAPTCHA_WIDTH;
        $point_y = rand() % CAPTCHA_HEIGHT;

        //a função imagesetpixel desenha um único pixel em uma coordenada especificada, dentro da imagem.
        imagesetpixel($img, $point_x, $point_y, $graphic_color);
    }

    //desenha string da senha
    $text_size = 18;
    $text_angle = 0;
    $text_x = 5;
    $text_y = CAPTCHA_HEIGHT - 5;
    $text_font_filename = CAPTCHA_PATH_FONTS . 'liberation/LiberationSans-Bold.ttf';

    //a função imagettftext
    imagettftext($img, $text_size, $text_angle, $text_x, $text_y, $text_color, $text_font_filename, $senha_captcha);

    return $img;
}
