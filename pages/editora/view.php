<?php
  // Carrega os dados
  require '../../config/bootstrap.php';

  // Transforma as variáveis da url em variáveis normais. 
  // Ex.: ?id=2 se transforma em $id com valor 2
  parse_str(parse_url($_SERVER['REQUEST_URI'] )['query']);

  // Se for método GET
  if ( !isPost() ) {
    
    $obj = new Editora();
    $editora = $obj->firstById($id);

    $acervo = new Acervo();

    $results = $acervo->fetch("select acervo.*, editora.nome as editora 
      from acervo 
      inner join editora on ( acervo.idEditora = editora.id )
      where idEditora=?
      order by titulo ASC
    ", [ $id ]);
  }

?>
  <!-- Cabeçalho da página -->
  <h1>
    <a href="#editora" title="Página de editoras"></a>
    Livros da <?php echo $editora['nome']; ?>
  </h1>

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