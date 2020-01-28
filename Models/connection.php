<?php

class Connection {
  static public function connect() {
    #PDO("server; database", "username", "password")
    $connection = new PDO("mysql:host=localhost;dbname=course_php", "root", "@dmin1234");
    $connection->exec("set names utf8");
    return $connection;
  }
}
