<?php

  /**
   * Classe responsável por individualizar as consultas ao banco de dados
   * utilizando estruturas unificadas de acesso aos dados
   */
  class Model extends Database {

    /**
     * Armazena o nome da tabela
     */
    protected $table;

    /**
     * Pega todos os dados da tabela definida
     * Ex.: 
     * $usuario = new Usuario();
     * $usuario->all();
     */
    public function all () {
      return $this->fetch( 'select * from ' . $this->table );
    }

    /**
     * Adiciona dados na tabela em forma de array.
     * Ex.: 
     * $usuario = new Usuario();
     * $usuario->add( [ 'nome' => 'claudio', 'idade' => 36  ] );
     */
    public function add ( $data ) {
      // Junta as chaves do array, separando-os por vírgula
      $fields = join(', ', array_keys( $data ));

      // Pega somente os valores de cada uma das entradas do array
      $values = array_values($data);

      // Cria interrogações para cada um dos valores, que serão inseridas
      // na SQL
      $questionMarks = join( ', ', array_pad( [], count($data), '?' ) );

      // SQL Final
      $sql = 'insert into '. $this->table .' ( ' . $fields . ' ) values ( ' . $questionMarks . ' )';

      // Executa e devolve o número de linhas afetadas
      return $this->exec( $sql, $values );
    }

    /**
     * Edita dados de uma tabela
     * Ex.: 
     * $usuario = new Usuario();
     * $usuario->edit( 4, [ 'nome' => 'claudio', 'idade' => 36 ] );
     * 
     * @param integer $id O id da linha que será modificada
     * @param array   $data Os dados que serão modificados
     */
    public function edit ( $id, $data ) {
      $fields = [];
      $values = array_merge( array_values( $data ), [ $id ] );

      // Converte $data em uma string no formato "nome = ?, idade = ?"
      // para ser usada na consulta
      foreach( $data as $key => $row ) {
        $fields[] = $key . ' = ?';
      }
      
      // Converte o array acima em uma string, unind suas partes por uma vírgula
      $fields = join( ', ', $fields );

      // SQL gerada
      $sql = 'update '. $this->table .' set ' . $fields . ' where id = ?';

      // Executa e retorna a quantidade de linhas afetadas
      return $this->exec( $sql, $values );
    }


    /**
     * Busca uma linha específica por um ID
     */
    public function firstById( $id ) {
      // Recebe a linha desejada como um array de arrays
      $result = $this->fetch('select * from ' . $this->table . ' where id = ?', [ $id ]);

      // Se existir dados no array, devolva o primeiro elemento
      if ( !empty( $result ) ) return $result[0];
      // Caso contrário, devolva um array vazio
      else return [];
    }
  }