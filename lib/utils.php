<?php

function pr($var) {
  echo '<pre>';
  print_r($var);
  echo '</pre>';
}

function isPost() {
  return !empty( $_POST );
}
