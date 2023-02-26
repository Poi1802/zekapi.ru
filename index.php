<?php
require_once 'functions.php';
// die(print_r($_POST));
header('Content-type: json/application');
$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
$id = isset($params[1]) ? $params[1] : 0;


if ($method === 'GET') {
  if ($type === 'posts') {
    if ($id !== 0) {
      getPost($id);
    } else {
      getPosts();
    }
  }
} elseif ($method === 'POST') {
  if ($type === 'posts') {
    insertPost($_POST);
  }
} elseif ($method === 'PATCH') {
  if ($id !== 0) {
    $data = file_get_contents('php://input');
    $data = json_decode($data, true);

    updatePost($id, $data);
  }
} elseif ($method === 'DELETE') {
  if ($type === 'posts') {
    if ($id !== 0) {
      deletePost($id);
    }
  }
}