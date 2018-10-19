<?php
  require '../../config/bootstrap.php';

  // Faz a verificação se a requisição recebida é via POST ou via GET e dá o tratamento adequado
  if ( !isPost() ) {
    $editora = new Editora();
    $editoras = $editora->all();

  } else {
    $acervo = new Acervo();
    $acervo->add($_POST);
    exit;
  }
?>


<h1><a href="#acervo"></a>Cadastrar</h1>

<form action="pages/acervo/add.php" id="acervo_add_form" onsubmit="sendForm(this, '#acervo');return false;">
  <label for="titulo">Título do Livro
    <input type="text" required name="titulo" id="titulo" placeholder="Título do Livro">
  </label>

  <label for="autor">Autor
    <input type="text" required name="autor" id="autor" placeholder="Autor">
  </label>

  <label for="ano">Ano
    <input type="number" max="<?php echo date('Y')?>" required  name="ano" id="ano" placeholder="Ano">
  </label>

  <label for="Preço">preco
    <input type="number" step="0.01" required  name="preco" id="preco" placeholder="Preço">
  </label>

  <label for="Quantidade">quantidade
    <input type="number"  required name="quantidade" id="quantidade" placeholder="Quantidade">
  </label>

  <label for="Tipo">tipo
    <input type="number" required  name="tipo" id="tipo" placeholder="Tipo">
  </label>

  <label for="editora">Editora
    <select name="idEditora" required  id="editora">
      <option value="">Selecione</option>
      <?php foreach( $editoras as $editora ): ?>
        <option value="<?php echo $editora['id']?>"><?php echo $editora['nome']?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <button type="submit" id="send">Enviar</button>

</form>

