<?php
class Acervo extends Model{

  /**
   * Define o nome da tabela usada neste model
   */
  public $table = 'acervo';

  /**
   * Sobrescreve o método all() da classe pai para a inclusão do join
   */
  public function all () {
    return $this->fetch('select acervo.*, editora.nome as editora 
    from acervo 
    inner join editora on ( acervo.idEditora = editora.id )
    order by titulo ASC
    ');
  }

  /**
   * Cria um método de busca juntamente com um join
   */
  public function search ( $word ) {
    return $this->fetch("select acervo.*, editora.nome as editora 
      from acervo 
      inner join editora on ( acervo.idEditora = editora.id )
      where titulo LIKE ?
      order by titulo ASC
    ", [ '%'.$word.'%' ]);
  }


}