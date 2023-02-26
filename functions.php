<?php
require_once('connection.php');

function getPosts()
{
  global $pdo;
  $sql = "SELECT * FROM posts";

  $query = $pdo->prepare($sql);
  $query->execute();
  echo json_encode($query->fetchAll());
}

function getPost($id)
{
  global $pdo;
  $sql = "SELECT * FROM posts WHERE id = $id";

  $query = $pdo->prepare($sql);
  $query->execute();
  $post = $query->fetch();

  if (!$post) {
    http_response_code(404);
    echo json_encode([
      'status' => false,
      'message' => 'post not found',
    ]);
  } else {
    echo json_encode($post);
  }
}

function insertPost($data)
{
  global $pdo;

  $title = $data['title'];
  $content = $data['content'];

  $sql = "INSERT INTO `posts`(`title`, `content`) VALUES ($title,$content)";

  http_response_code(201);
  $query = $pdo->prepare($sql);
  $query->execute();

  echo json_encode([
    'status' => true,
    'post_id' => $pdo->lastInsertId(),
  ]);
}

function updatePost($id, $data)
{
  global $pdo;

  $title = $data['title'];
  $content = $data['content'];

  $sql = "UPDATE `posts` SET `title`='$title',`content`='$content' WHERE id=$id";

  http_response_code(200);
  $query = $pdo->prepare($sql);
  $query->execute();

  echo json_encode([
    'status' => true,
    'message' => "Post is updated",
  ]);
}

function deletePost($id)
{
  global $pdo;

  $sql = "DELETE FROM `posts` WHERE `id` = $id ";

  http_response_code(200);
  $query = $pdo->prepare($sql);
  $query->execute();

  echo json_encode([
    'status' => true,
    'message' => "Post is deleted",
  ]);
}