<?php
  // Carrega os dados
  require '../../config/bootstrap.php';

  // Instancia a classe
  $editora = new Editora();

  // Verifico se o usuário está ou não está fazendo uma busca
  if ( !isset($_GET['q']) ) {
    $results = $editora->all();
  } else {
    $results = $editora->search( $_GET['q'] );
  }

?>
  <h1>
    <?php
      if ( !isset( $_GET['q'] ) ) {
        echo 'Editoras';
      } else {
        echo '<a href="#editora"></a>';
        echo 'Resultados da Busca';
      }
    ?>
  </h1>

  <!-- Busca -->
  <section id="search">
    <input type="text" onkeypress="search(event, '#editora/search')" value="<?php echo isset($_GET['q']) ? $_GET['q'] : '';?>" name="q" placeholder="Digite o titulo do livro">
    <a href="#editora/add"></a>
  </section>


  <!-- Número de resultados -->
  <div id="results">
    <?php
      $n = count( $results );
      if ( $n == 0 ) echo 'Nenhum resultado econtrado';
      elseif ( $n == 1 ) echo '1 resultado econtrado';
      else echo $n . ' resultados econtrados';
    ?>
  </div>


  <!-- Resultado -->
  <ul id="acervo-results">
    <?php foreach( $results as $row ):  ?>
      <li>
        <div class="lines">
          <div class="line1">
            <div class="titulo"><?php echo $row['nome']?></div>
            <!-- <div class="autor"><?php echo $row['autor']?>, <?php echo $row['ano']?></div> -->
          </div>
          <div class="line2">
            <div class="editora"><a href="#editora/view/<?php echo $row['id']?>">Livros desta editora</a></div>
            <!-- <div class="preco"><?php echo $row['preco']?></div>
            <div class="quantidade"><?php echo $row['quantidade']?> unidades</div> -->
          </div>
        </div>
        <div class="edit">
          <a href="#editora/edit/<?php echo $row['id']?>"></a>
        </div>
      </li>
    <?php endforeach;?>
  </ul>
