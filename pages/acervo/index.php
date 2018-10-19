<?php
  // Carrega os dados
  require '../../config/bootstrap.php';

  // Instancia a classe
  $acervo = new Acervo();

  // Verifico se o usuário está ou não está fazendo uma busca
  if ( !isset($_GET['q']) ) {
    $results = $acervo->all();
  } else {
    $results = $acervo->search( $_GET['q'] );
  }

?>
  <h1>
    <?php
      if ( !isset( $_GET['q'] ) ) {
        echo 'Acervo';
      } else {
        echo '<a href="#acervo"></a>';
        echo 'Resultados da Busca';
      }
    ?>
  </h1>

  <!-- Busca -->
  <section id="search">
    <input type="text" onkeypress="search(event, '#acervo/search')" value="<?php echo isset($_GET['q']) ? $_GET['q'] : '';?>" name="q" placeholder="Pesquisa por titulo">
    <a href="#acervo/add"></a>
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
            <div class="titulo"><?php echo $row['titulo']?></div>
            <div class="autor"><?php echo $row['autor']?>, <?php echo $row['ano']?></div>
          </div>
          <div class="line2">
            <div class="editora"><a href="#editora/view/<?php echo $row['idEditora']?>"><?php echo $row['editora']?></a></div>
            <div class="preco"><?php echo $row['preco']?></div>
            <div class="quantidade"><?php echo $row['quantidade']?> unidades</div>
          </div>
        </div>
        <div class="edit">
          <a href="#acervo/edit/<?php echo $row['id']?>"></a>
        </div>
      </li>
    <?php endforeach;?>
  </ul>
