<?php

if(array_key_exists('button1', $_POST)) {
  button1();
}
else if(array_key_exists('button2', $_POST)) {
  button2();
}

if(array_key_exists('situacao', $_POST)){}

function button1() {
header("Location: listAlarms.php");
}

function button2() {
header("Location: formAddAlarm.php");
} 

function situacao() {
  if ($_POST == "Ativado") {
    $_SESSION['situacao'] = "Desativado";
  } elseif ($_POST == "Desativado") {
    $_SESSION['situacao'] = "Ativado";
  }
  //Redirecionar o usuario
  header("Location: formUpAlarm.php");
}

