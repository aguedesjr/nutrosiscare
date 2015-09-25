<?
session_start();
if (!isset($_SESSION["autenticado"])){
  header("location:index.php");
  exit;
}
?>
