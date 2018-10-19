<?php
  require '../../config/bootstrap.php';

  // Faz a verificação se a requisição recebida é via POST ou via GET e dá o tratamento adequado
  if ( !isPost() ) {
    
    $editora = new Editora();
    $editoras = $editora->all();

  } else {
    // POST
    $obj = new Editora();
    $obj->add($_POST);
    exit;
  }

?>
  <h1><a href="#editora"></a>Cadastrar</h1>

  <form action="pages/editora/add.php" id="editora_add_form" onsubmit="sendForm(this, '#editora');return false;">
    <label for="nome">Nome da Editora
      <input type="text" required name="nome" id="nome" placeholder="Nome da Editora">
    </label>

    <button type="submit" id="send">Enviar</button>

  </form>

