<?php
require_once 'cabecalho.html';
?>

<div class="container formulario">
  <div class="row">
    <div class="col-md-6 col-sm-12 offset-md-3">
      <form method="post" action="redimensiona.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="largura">Largura: </label>
          <input type="text" name="largura" placeholder="em pixels" class="form-control">
        </div>
        <div class="form-group">
          <label for="altura">Altura: </label>
          <input type="text" name="altura" placeholder="em pixels" class="form-control">
        </div>

        <div class="form-group">
          <label>Deseja manter a proporção?</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="proporcao" id="proporcao1" value="1" checked>
            <label class="form-check-label" for="proporcao1">Sim</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="proporcao" id="proporcao2" value="2">
            <label class="form-check-label" for="proporcao2">Não</label>
          </div>
        </div>

        <div class="input-group mb-3">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="arquivo[]" multiple id="arquivo" aria-describedby="arquivo">
            <label class="custom-file-label" for="arquivo">Escolha os Arquivos</label>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Redimensionar</button>
      </form>
    </div>

  </div>
</div>

<?php
require_once 'rodape.html';
?>
