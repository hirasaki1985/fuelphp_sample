<?php
$pdo = new PDO ( 'mysql:host=localhost;dbname=fuel_dev;charset=utf8', 'root', '' );
$sql = $pdo->prepare ( 'show tables' );
$sql->execute();
foreach ( $sql->fetchAll () as $row ) {
  echo '$row';
  echo '';
}
?>
