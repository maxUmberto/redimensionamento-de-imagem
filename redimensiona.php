<?php

require_once 'validacao.php';

function redimensiona($imagem_final, $imagem_original,$largura, $altura, $largura_original, $altura_original, $i){

  imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $largura_original, $altura_original);

  $watermark = 'imagens/watermark.png';
  list($largura_original, $altura_original) = getImageSize($watermark);
  $watermark = imagecreatefrompng($watermark);
  imagecopyresampled($imagem_final, $watermark,0,0,0,0,$largura, $altura, $largura_original, $altura_original);


  imagejpeg($imagem_final, 'imagens/'.$i.'.jpeg',100);
}

/*function marca($imagem_final, $largura, $altura, $i){
  $watermark = 'imagens/watermark.png';
  list($largura_original, $altura_original) = getImageSize($watermark);
  $watermark = imagecreatefrompng($watermark);
  imagecopyresampled($imagem_final, $watermark,0,0,0,0,$largura, $altura, $largura_original, $altura_original);
  imagejpeg($imagem_final, 'imagens/'.$i.'.jpeg',100);
}*/

$largura = $_POST['largura'];
$altura = $_POST['altura'];
$manter_proporcao = $_POST['proporcao'];
$arquivos = $_FILES['arquivo'];

for($i = 0; $i < count($arquivos['tmp_name']); $i++){
  list($largura_original, $altura_original) = getImageSize($arquivos['tmp_name'][$i]);

  if($manter_proporcao == 1){
    $proporcao = $largura_original / $altura_original;

    if($largura / $altura > $proporcao){
      $largura = $altura * $proporcao;
    } else{
      $altura = $largura / $proporcao;
    }
  }

  $imagem_final = imagecreatetruecolor($largura, $altura);

  if($arquivos['type'][$i] == 'image/jpeg'){
    $imagem_original = imagecreatefromjpeg($arquivos['tmp_name'][$i]);
    redimensiona($imagem_final, $imagem_original,$largura, $altura, $largura_original, $altura_original,$i);
    //marca("imagens/'.$i.'.jpeg", $largura, $altura, $i);
    echo '<img src="imagens/'.$i.'.jpeg"><br><br>';
  } else {
    $imagem_original = imagecreatefrompng($arquivos['tmp_name'][$i]);
    redimensiona($imagem_final, $imagem_original,$largura, $altura, $largura_original, $altura_original);
    imagepng($imagem_final, 'imagens/'.$i.'.png');
    echo '<img src="imagens/'.$i.'.jpeg"><br><br>';
  }

}

?>
