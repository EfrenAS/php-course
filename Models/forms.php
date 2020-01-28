<?php

require_once 'connection.php';

class Forms {
  static public function create($table, $data) {
    $stmt = Connection::connect()->prepare("INSERT INTO $table(token, fullname, email, password) VALUES (:token, :fullname, :email, :password)");
    $stmt->bindParam(":token", $data['token'], PDO::PARAM_STR);
    $stmt->bindParam(":fullname", $data['fullname'], PDO::PARAM_STR);
    $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
    $stmt->bindParam(":password", $data['password'], PDO::PARAM_STR);

    if ($stmt->execute()) {
      return 'ok';
    } else {
      print_r(Connection::connect()->errorInfo());
    }
    $stmt->close();
    $stmt = null;
  }

  static public function read($table, $item, $value) {
    if ($item == null && $value == null) {
      $stmt = Connection::connect()
                        ->prepare("SELECT *, DATE_FORMAT(created_at, '%d-%m-%Y') as created_at FROM $table ORDER BY id DESC");
      $stmt->execute();
      return $stmt->fetchAll();
    } else {
      $stmt = Connection::connect()
                        ->prepare("SELECT *, DATE_FORMAT(created_at, '%d-%m-%Y') as created_at FROM $table WHERE $item = :$item ORDER BY id DESC");
      $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetch();
    }
    $stmt->close();
    $stmt = null;
  }

  static public function update($table, $data) {
    $stmt = Connection::connect()->prepare("UPDATE $table SET fullname=:fullname, email=:email, password=:password WHERE token = :token");
    $stmt->bindParam(':fullname', $data['fullname'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
    $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
    $stmt->bindParam(':token', $data['token'], PDO::PARAM_STR);
    if ($stmt->execute()) {
      return 'ok';
    } else {
      print_r(Connection::connect()->errorInfo());
    }
  }

  static public function updateAttempts($table, $attempts, $token) {
    $stmt = Connection::connect()->prepare("UPDATE $table SET failed_attempts = :failed_attempts WHERE token = :token");
    $stmt->bindParam(':failed_attempts', $attempts, PDO::PARAM_INT);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    if ($stmt->execute()) {
      return 'ok';
    } else {
      print_r(Connection::connect()->errorInfo());
    }
  }

  static public function delete($table, $value) {
    $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE token = :token");
    $stmt->bindParam(':token', $value, PDO::PARAM_STR);
    if ($stmt->execute()) {
      return 'ok';
    } else {
      print_r(Connection::connect()->errorInfo());
    }
  }
}
