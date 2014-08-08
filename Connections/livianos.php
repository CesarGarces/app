<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_livianos = "localhost";
$database_livianos = "livianos";
$username_livianos = "root";
$password_livianos = "";
$livianos = mysql_pconnect($hostname_livianos, $username_livianos, $password_livianos) or trigger_error(mysql_error(),E_USER_ERROR); 
?>