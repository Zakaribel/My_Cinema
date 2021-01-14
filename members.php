<?php

$nom = "";
$prenom = "";
$date_de_naissance = "";
$email = "";
$adresse = "";
$code_postal = "";
$ville = "";
$array_id = [];
$array_nom = [];
$array_prenom = [];
$array_date_de_naissance = [];
$array_email = [];
$array_adresse = [];
$array_code_postal = [];
$array_ville = [];

if (isset($_POST['find'])) {
    $host = 'localhost';
    $dbname = 'cinema';
    $username = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$dbname";


    $conn = new PDO($dsn, $username, $password);


    $keyword = $_POST['keyword'];
    $sqlquery = "SELECT * FROM fiche_personne WHERE nom  LIKE '$keyword' OR prenom LIKE'$keyword'";
    $res = $conn->prepare($sqlquery);
    $execute = $res->execute();


    if ($execute) {


        if ($res->rowCount() > 0) {
            
            foreach ($res as $row) {
                array_push($array_id,$row['id_perso']);
                array_push($array_nom, $row['nom']);
                array_push($array_prenom, $row['prenom']);
                array_push($array_email, $row['email']);
                array_push($array_date_de_naissance, $row['date_naissance']);
                array_push($array_adresse, $row['adresse']);
                array_push($array_code_postal, $row['cpostal']);
                array_push($array_ville, $row['ville']);
            }
        } else {
            $nom = "";
            $prenom = "";
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
            Quel membre recherchez-vous (nom,prénom) ?: <input type="text" name="keyword">
            <input type="submit" name="find" value="Chercher le membre">

            <hr />

            <table border="1" s>

                <tr>
                    <th> Nom : </th>
                    <th> Prénom : </th>
                    <th> Email :</th>
                    <th> Date de Naissance :</th>
                    <th> Adresse :</th>
                    <th> Code Postal :</th>
                    <th> Ville :</th>
                </tr>

                <?php

                
                for ($i = 0; $i < count($array_nom); $i++) {
                    echo "<tr>" .

                        '<td><a href="membership.php?id=' . $array_id[$i] .  '">' . $array_nom[$i] . ' </a></td>' .
                        '<td>' . $array_prenom[$i] . '</td>' .
                        '<td>' . $array_email[$i] . '</td>' .
                        '<td>' . $array_date_de_naissance[$i] . '</td>' .
                        '<td>' . $array_adresse[$i] . '</td>' .
                        '<td>' . $array_code_postal[$i] . '</td>' .
                        '<td>' . $array_ville[$i] . '</td>' .

                        "</tr>";
                }

                ?>

        </center>
    </form>
</body>

</html>