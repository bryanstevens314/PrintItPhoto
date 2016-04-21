<?php
require('app/dbconfig.php');
include_once 'app/class.crud.php';
$crud = new crud();
  $query = "SELECT * FROM students";       
  print($crud->jsonview($query));
  ?>