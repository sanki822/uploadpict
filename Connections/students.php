<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_students = "localhost";
$database_students = "students";
$username_students = "root";
$password_students = "";
$students = mysql_pconnect($hostname_students, $username_students, $password_students) or trigger_error(mysql_error(),E_USER_ERROR); 
?>