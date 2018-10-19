<?php
require '../../config/bootstrap.php';

// Transforma as variáveis da url em variáveis normais. 
// Ex.: ?id=2 se transforma na variável $id com valor 2
parse_str(parse_url($_SERVER['REQUEST_URI'] )['query']);

// Se for método GET
if ( !isPost() ) {
  
  $editora = new Editora();
  $editoras = $editora->all();

  $acervo = new Acervo();
  $livro = $acervo->firstById($id);

} else {
  // POST
  $acervo = new Acervo();
  $acervo->edit($id, $_POST);
  exit;
}





?>
<h1><a href="#acervo"></a>Editar</h1>

<form action="pages/acervo/edit.php?id=<?php echo $id?>" id="acervo_add_form" onsubmit="sendForm(this, '#acervo');return false;">
  <label for="titulo">Título do Livro
    <input type="text" required name="titulo" value="<?php echo $livro['titulo'] ?>" id="titulo" placeholder="Título do Livro">
  </label>

  <label for="autor">Autor
    <input type="text" required name="autor" value="<?php echo $livro['autor'] ?>" id="autor" placeholder="Autor">
  </label>

  <label for="ano">Ano
    <input type="number" max="<?php echo date('Y')?>" required  name="ano" value="<?php echo $livro['ano'] ?>" id="ano" placeholder="Ano">
  </label>

  <label for="Preço">preco
    <input type="number" step="0.01" required  name="preco" value="<?php echo $livro['preco'] ?>" id="preco" placeholder="Preço">
  </label>

  <label for="Quantidade">quantidade
    <input type="number"  required name="quantidade" value="<?php echo $livro['quantidade'] ?>" id="quantidade" placeholder="Quantidade">
  </label>

  <label for="Tipo">tipo
    <input type="number" required  name="tipo" value="<?php echo $livro['tipo'] ?>" id="tipo" placeholder="Tipo">
  </label>

  <label for="editora">Editora
    <select name="idEditora" required  id="editora">
      <option value="">Selecione</option>
      <?php foreach( $editoras as $editora ): ?>
        <option value="<?php echo $editora['id']?>"  <?php echo $livro['idEditora'] === $editora['id'] ? 'selected': '' ?> ><?php echo $editora['nome']?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <button type="submit" id="send">Enviar</button>

</form>

