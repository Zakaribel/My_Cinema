<?php include 'pdo_connect.php';


$array_id = [];
$array_nom = [];
$array_prenom = [];
$array_date_de_naissance = [];
$array_email = [];
$array_adresse = [];
$array_code_postal = [];
$array_ville = [];

if (isset($_POST['find'])) {



    $keyword = $_POST['keyword'];
    $sqlquery = "SELECT * FROM fiche_personne WHERE nom  LIKE '$keyword' OR prenom LIKE'$keyword'";
    $res = $conn->prepare($sqlquery);





    if ($res->execute() && $res->rowCount() > 0) {

        foreach ($res as $row) {
            array_push($array_id, $row['id_perso']);
            array_push($array_nom, $row['nom']);
            array_push($array_prenom, $row['prenom']);
            array_push($array_email, $row['email']);
            array_push($array_date_de_naissance, $row['date_naissance']);
            array_push($array_adresse, $row['adresse']);
            array_push($array_code_postal, $row['cpostal']);
            array_push($array_ville, $row['ville']);
        }
    } else {

        echo "Désolé nous n'avons trouvé aucun résultat pour cette recherche";
    }
}
