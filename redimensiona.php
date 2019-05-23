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
  }

  for($i = 0; $i < count($arquivos['tmp_name']); $i++){
    if($arquivos['type'][$i] != 'image/jpeg' && $arquivos['type'][$i] != 'image/png'){
      $erro .= 'Arquivo: "'.$arquivos['name'][$i].'" tem formato inválido. Envie somente imagens em formato PNG ou JPEG/JPG<br>';
    } else if($arquivos['size'][$i] >= 4194304){
      $erro .= 'O Arquivo: "'.$arquivos['name'][$i].'" é muito grande. Tamanho máximo de 4Mb<br>';
    }
  }

  return $erro;
}

$erros = '';
$erros .= valida($_POST['largura'], 'Largura');
$erros .= valida($_POST['altura'], 'Altura');
$erros .= valida_arquivos($_FILES['arquivo']);

echo $erros;


?>
