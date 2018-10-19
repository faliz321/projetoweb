<?php

  /**
   * Classe responsável pela conexão e consulta no mysql
   */
  class Database {

    /**
     * @var
     * Armazena o objeto da conexão
     */
    protected $connection;

    /**
     * @var
     * Armazena a última SQL executada, facilitando o debug
     */
    protected $lastSql;

    /**
     * Faz a conexão com o banco de dados
     */
    function connect() {
      try {
        // Retorna o objeto de conexão caso a conexão já esteja aberta
        if ( $this->connection ) return $this->connection;
        
        // Conecta caso ainda não esteja
        return $this->connection = new PDO('mysql:host=' . HOST . ';dbname=' . NAME, USER, PASS, [ PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ] );
      } catch ( PDOException $e ) {
        // Erro ao conectar
        echo 'Erro ao conectar com o Mysql' . $e->getMessage();
      }
    }

    /**
     * Executa uma consulta e retorna os resultados
     */
    function fetch( $sql, $params = [] ) {
      $this->connect();
      $this->lastSql = $sql;

      $query = $this->connection->prepare( $sql );
      $query->execute( $params );

      return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Executa uma operação no banco de dados sem retornar resultados
     */
    function exec( $sql, $params = [] ) {
      $this->connect();
      $this->lastSql = $sql;

      $query = $this->connection->prepare( $sql );
      return $query->execute( $params );
    }

    /**
     * Devolve a última SQL executada
     */
    public function lastSql(){
      return $this->lastSql;
    }
  }