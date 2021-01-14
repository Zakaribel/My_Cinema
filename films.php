<?php


$titre = "";
$genre = "";
$distributeur = "";

$array_titre = [];
$array_genre = [];
$array_distributeur = [];


if (isset($_POST['find'])) {
    $host = 'localhost';
    $dbname = 'cinema';
    $username = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$dbname";


    $conn = new PDO($dsn, $username, $password);


    $titre = $_POST['titre'];
    $genre = $_POST['genre'];
    $distributeur = $_POST['distributeur'];

    
    $sqlquery = "SELECT film.titre, g.nom, d.nom

    FROM film  INNER JOIN genre AS g  INNER JOIN distrib as d 
    
    ON film.id_genre = g.id_genre AND film.id_distrib = d.id_distrib

    WHERE film.titre LIKE '%$titre%'
    AND g.nom LIKE '%$genre%'
    AND d.nom LIKE '%$distributeur%' ";


    $res = $conn->prepare($sqlquery);
    $execute = $res->execute(array("film.titre" => $titre, "g.nom" => $genre, "d.nom" => $distributeur));

    if ($execute) {

        if ($res->rowCount() > 0) {
            foreach ($res as $row) {

                array_push($array_titre, $row[0]);
                array_push($array_genre, $row[1]);
                array_push($array_distributeur, $row[2]);

            }
        } else {
            $titre = "";
            $genre = "";
            $distributeur = "";

            echo "Désolé nous n'avons trouvé aucun résultat pour cette recherche";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <center>
            Entrez le titre du film : <input type="text" name="titre"><br><br>
            Entre le genre du film : <input type="text" name="genre"><br><br>
            Entre le distributeur du film : <input type="text" name="distributeur"><br><br>
            
            <input type="submit" name="find" value="Rechercher">

            <hr />

            <table border="1" s>
    
          <tr>
          <th> Titre : </th>
          <th> Genre : </th>
          <th> Distributeur :</th>
          </tr>        
                
    <?php 


    for($i = 0; $i <count($array_titre); $i++){

        echo "<tr>".  

        '<td>'. $array_titre[$i]. '</td>'.
        '<td>'. $array_genre[$i]. '</td>'.
        '<td>'. $array_distributeur[$i]. '</td>'.
          
         "</tr>";

    }

    ?>





            </table>
        </center>
    </form>
</body>

</html>