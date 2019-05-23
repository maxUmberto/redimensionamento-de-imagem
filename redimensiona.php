<?php

function valida($dado, $campo){
  if(empty($dado)){
    return $campo.' não pode ser vazio<br>';
  } else if (!preg_match('/^[1-9][0-9]+$/', $dado)){
    return $campo.' aceita somente números<br>';
  }
}

function valida_arquivos($arquivos){
  $erro = '';
  if(empty($arquivos['tmp_name'][0])){
    $erro .= 'Nenhum arquivo selecionado';
  } else {

    for($i = 0; $i < count($arquivos['tmp_name']); $i++){
      if($arquivos['type'][$i] != 'image/jpeg' && $arquivos['type'][$i] != 'image/png'){
        $erro .= 'Arquivo: "'.$arquivos['name'][$i].'" tem formato inválido. Envie somente imagens em formato PNG ou JPEG/JPG<br>';
      } else if($arquivos['size'][$i] >= 4194304){
        $erro .= 'O Arquivo: "'.$arquivos['name'][$i].'" é muito grande. Tamanho máximo de 4Mb<br>';
      }
    }

  }

  return $erro;
}

function redimensiona($imagem_final, $imagem_original,$largura, $altura, $largura_original, $altura_original){
  return imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $largura_original, $altura_original);
}

$erros = '';
$erros .= valida($_POST['largura'], 'Largura');
$erros .= valida($_POST['altura'], 'Altura');
$erros .= valida_arquivos($_FILES['arquivo']);

if($erros != ''){
  echo $erros;
  echo '<br><br><a href="index.php"><- Voltar</a>';
  exit();
}

$largura = $_POST['largura'];
$altura = $_POST['altura'];
$arquivos = $_FILES['arquivo'];

for($i = 0; $i < count($arquivos['tmp_name']); $i++){
  list($largura_original, $altura_original) = getImageSize($arquivos['tmp_name'][$i]);

  $proporcao = $largura_original / $altura_original;

  if($largura / $altura > $proporcao){
    $largura = $altura * $proporcao;
  } else{
    $altura = $largura / $proporcao;
  }

  $imagem_final = imagecreatetruecolor($largura, $altura);

  if($arquivos['type'][$i] == 'image/jpeg'){
    $imagem_original = imagecreatefromjpeg($arquivos['tmp_name'][$i]);
    redimensiona($imagem_final, $imagem_original,$largura, $altura, $largura_original, $altura_original);
    imagejpeg($imagem_final, 'imagens/'.$i.'.jpeg',100);
    echo '<img src="imagens/'.$i.'.jpeg"><br><br>';
  } else {
    $imagem_original = imagecreatefrompng($arquivos['tmp_name'][$i]);
    redimensiona($imagem_final, $imagem_original,$largura, $altura, $largura_original, $altura_original);
    imagepng($imagem_final, 'imagens/'.$i.'.png');
    echo '<img src="imagens/'.$i.'.jpeg"><br><br>';
  }

}

?>
