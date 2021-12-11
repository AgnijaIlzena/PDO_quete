<?php


// Connect to DB

require_once 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

// Add a new values in DB via form. Prepared (secured) request used.

$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $pdo->prepare($query);

$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->execute();

// Retrieve All from the table by using  html list .

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

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

    <ul>



<?php
          foreach($friends as $friend) {
              echo $friend['firstname'] . ' ' . $friend['lastname'] . '<br>';
          }
?>

    </ul>

    <form action="index2.php" method="post">

        <label for="firstname" >FIRST NAME:</label>
        <input type="text" id="firstname" name="firstname" >

        <label for="lastname" >LAST NAME</label>
        <input type="text" id="lastname" name="lastname">

        <input type="submit" value="Send Your Data">

    </form>

</body>
</html>