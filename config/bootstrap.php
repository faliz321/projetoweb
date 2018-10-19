<?php
  /**
   * Este arquivo carrega todos os demais arquivos necessários na aplicação
   */

  // Define a condificação
  header('Content-Type: text/html; charset=utf-8');

  // Define um caminho absoluto para ser utilizado no carregamento dos arquivos
  define('PATH',     dirname(dirname( __FILE__ ))); 

  // Conexão ao banco de dados
  require PATH . '/config/database.php';

  // Funções úteis
  require PATH . '/lib/utils.php';

  // Classe de manipulação do banco de dados
  require PATH . '/lib/database.php';

  // Models
  require PATH . '/lib/model.php';
  require PATH . '/models/acervo.php';
  require PATH . '/models/editora.php';