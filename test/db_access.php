<?php
$pdo = new PDO ( 'mysql:host=mysql;dbname=fuel_dev;charset=utf8', 'root', 'secret' );
// $sql = $pdo->prepare ( 'select * from migration' );
$sql = $pdo->prepare ( 'show tables' );
$sql->execute();
foreach ( $sql->fetchAll () as $row ) {
  print_r($row);
  echo '';
}
?>
