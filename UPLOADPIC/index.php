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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO studenttab (name, picture) VALUES (%s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['picture'], "text"));

  mysql_select_db($database_students, $students);
  $Result1 = mysql_query($insertSQL, $students) or die(mysql_error());
}

mysql_select_db($database_students, $students);
$query_upload = "SELECT * FROM studenttab";
$upload = mysql_query($query_upload, $students) or die(mysql_error());
$row_upload = mysql_fetch_assoc($upload);
$totalRows_upload = mysql_num_rows($upload);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Upload</title>
</head>
<body>
    <h2>Upload Your Details</h2>
    <form name="form" action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br><br>
        
        <label for="picture">Upload Picture:</label>
        <input type="file" name="picture" id="picture" required>
        <br><br>
        
        <button type="submit" name="submit">Submit</button>
        <input type="hidden" name="MM_insert" value="form">
    </form>
</body>
</html>
<?php
mysql_free_result($upload);
?>
