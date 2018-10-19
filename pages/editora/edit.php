<?php
  require '../../config/bootstrap.php';

  // Transforma as variáveis da url em variáveis normais. 
  // Ex.: ?id=2 se transforma em $id com valor 2
  parse_str(parse_url($_SERVER['REQUEST_URI'] )['query']);

  // Faz a verificação se a requisição recebida é via POST ou via GET e dá o tratamento adequado
  if ( !isPost() ) {
  
    $obj = new Editora();
    $editora = $obj->firstById($id);

  } else {
    // POST
    $editora = new Editora();
    $editora->edit($id, $_POST);
    exit;
  }
?>

  <h1><a href="#editora"></a>Editar <?php echo $editora['nome'] ?></h1>

  <form action="pages/editora/edit.php?id=<?php echo $id?>" id="acervo_add_form" onsubmit="sendForm(this, '#editora');return false;">
    <label for="titulo">Nome da Editora
      <input type="text" required name="nome" value="<?php echo $editora['nome'] ?>" id="nome" placeholder="Nome da Editora">
    </label>

    <button type="submit" id="send">Enviar</button>

  </form>

