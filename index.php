<form method="post" action="redimensiona.php" enctype="multipart/form-data">
  Largura
  <input type="text" name="largura" placeholder="em pixels"><br><br>

  Altura:
  <input type="text" name="altura" placeholder="em pixels"><br><br>

  Deseja manter a proporção?
  <input type="radio" name="proporcao" value="1" checked>Sim
  <input type="radio" name="proporcao" value="2">Não<br><br>

  <input type="file" name="arquivo[]" multiple><br><br>

  <input type="submit" value="Redimensionar">
</form>
