<?php
class Editora extends Model {

  /**
   * Define o nome da tabela usada neste model
   */
  public $table = 'editora';

  /**
   * Cria um método de busca
   */
  public function search ( $word ) {
    return $this->fetch("select * 
      from ". $this->table ." 
      where nome LIKE ?
      order by nome ASC
    ", [ '%'.$word.'%' ]);
  }
}