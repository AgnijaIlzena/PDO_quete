<?php

require_once 'connec.php';


$pdo = new \PDO(DSN, USER, PASS);

/* here below: I indicate variables coming out from my form in create.php file , and I insert values from form via POST method. When client is typing in
on browser, data is typing to DB through INSERT INTO query and PDO exec command. */

$title = $_POST['title'];
// $firstname = trim($_POST['firstname']);
$content = $_POST['content'];
$author = $_POST['author'];

$query = "INSERT INTO story (title, content, author) VALUES ('$title', '$content', '$author')";
$pdo->exec($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form action="create.php" method="post">

    <label for="title" >TITLE:</label>
    <input type="text" id="title" name="title" >

    <label for="content" >CONTENT</label>
    <input type="text" id="content" name="content">

    <label for="author" >AUTHOR:</label>
    <input type="text" id="author" name="author">

    <input type="submit" value="Send Your Data">

</form>

</body>
</html>



