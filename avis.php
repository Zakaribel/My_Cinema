<?php

include 'film_connect.php';
include 'pdo_connect.php';

$sql = "SELECT * FROM `historique_membre` WHERE id_film =" . $_GET['film'] . " AND avis is not null";
$res = $conn->query($sql);
$URI = $_SERVER['REQUEST_URI'];

if(isset($_POST['add_review'])){
    $updateSQL = $conn->query('UPDATE historique_membre SET avis = "' . $_POST['avis'] . '" where id_membre = ' . $_GET['user'] . ' and id_film = ' . $_GET['film']);
    header('location:'.$URI);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>AVIS</title>
</head>

<body>



    <div class="container">
    <form method="POST">
        
        Ajoutez un avis à ce film : <input type="text" name="avis"> <input type="submit" name="add_review" value="Ajouter">
        
    </form>
    </div>




    <div class="container">

        <?php


        if($res->rowCount() > 0) {
            $res = $res->fetchAll();
            
            for ($i = 0; $i < count($res); $i++) {

                echo "<p>" .
    
                    $res[$i]['avis'];
    
                "</p>";
            }
        } else {
            echo "y'a rien fréro ^^";
        }

        ?>



    </div>



</body>

</html>