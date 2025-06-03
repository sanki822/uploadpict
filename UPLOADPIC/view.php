<?php require_once('Connections/students.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_students, $students);
$query_studentrs = "SELECT * FROM studenttab";
$studentrs = mysql_query($query_studentrs, $students) or die(mysql_error());
$row_studentrs = mysql_fetch_assoc($studentrs);
$totalRows_studentrs = mysql_num_rows($studentrs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<span style="font-weight: normal; font-size: 24px;" width="1015" border="1" align="center" cellpadding="0" cellspacing="0"></span>
<table width="875" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="278" align="center" bgcolor="#000000" style="font-weight: bold; color: #FFF;">id</td>
    <td width="348" align="center" bgcolor="#000000" style="font-weight: bold; color: #FFF;">name</td>
    <td width="241" align="center" bgcolor="#000000" style="font-weight: bold; color: #FFF;">picture</td>
  </tr>
  <?php do { ?>
  <tr>
    <td align="center"><?php echo $row_studentrs['id']; ?></td>
    <td align="center"><?php echo $row_studentrs['name']; ?></td>
    <td align="left"><?php echo $row_studentrs['picture']; ?></td>
  </tr>
  <?php } while ($row_studentrs = mysql_fetch_assoc($studentrs)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($studentrs);
?>
