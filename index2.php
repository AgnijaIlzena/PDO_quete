<?php

require_once 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$errors = [];
if (!empty($_POST)) {
    if (isset($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    } else {
        $firstname = null;
    }

    if (isset($_POST['lastname'])) {
        $lastname = $_POST['lastname'];
    } else {
        $lastname = null;
    }

    if (!$firstname || !$lastname) {
        $errors[] = 'The fields are required!';
    }

    if ( strlen($firstname) > 45 || strlen($lastname) > 45 ) {
        $errors[] = 'Not more than 45 caracters allowed';
    }

    if (!preg_match("/.*\S.*./", $firstname)|| !preg_match("/.*\S.*./", $lastname)) {
        $errors[] = 'Not allowed to use only white space';
    }

    if (!$errors) {
        $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
        $statement = $pdo->prepare($query);

        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

        $statement->execute([
            ':firstname' => trim($firstname),
            ':lastname' => trim($lastname),
        ]);

        header('Location: /index2.php'); die;
    }
}


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

    <?php
    foreach($errors as $error) {
        echo '<p style="color: red">' . $error . '</p>';
    }
    ?>

    <form action="" method="post">

        <label for="firstname" >FIRST NAME:</label>
        <input type="text" id="firstname" name="firstname" >

        <label for="lastname" >LAST NAME</label>
        <input type="text" id="lastname" name="lastname">

        <input type="submit" value="Send Your Data" name="submit">

    </form>

</body>
</html>
