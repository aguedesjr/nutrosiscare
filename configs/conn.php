<?php
# Arquivo de conexao com o banco de dados
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_conn = "localhost";
#$hostname_conn = "localhost:3306:/var/run/mysql/mysql.sock";
$database_conn = "nutrosiscare";
$username_conn = "nutrosiscare";
$password_conn = "NutR0S1sc4r3";
$conn = mysql_pconnect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db($database_conn);
?>
