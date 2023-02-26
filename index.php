<?php
require_once('connection.php');

$method = $_SERVER['REQUEST_METHOD'];
function getPosts()
{
  global $pdo;
  $sql = "SELECT * FROM posts";

  $query = $pdo->prepare($sql);
  $query->execute();
  echo json_encode($query->fetchAll());
}

if ($method === 'GET') {
  getPosts();
}