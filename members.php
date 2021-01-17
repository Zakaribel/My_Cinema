<?php

include 'connexion/members_connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background-color:lavender;">
    <header> <a href="index.php" style="text-decoration: none;font-size:larger;color:black;font-weight:bolder;background-color:lightgray">Accueil</a> </header>


    <div style="text-align: center;">
        <form method="POST">

            <b>Quel membre recherchez-vous (nom,prénom) ?:</b> <input type="text" name="keyword">
            <input type="submit" name="find" value="Chercher le membre">

            <hr />

            <table style="width: 100%;">

                <tr style="height: 70px;">
                    <th style="background-color: #4CAF50;color: white;"> Nom : </th>
                    <th style="background-color: #4CAF50;color: white;"> Prénom : </th>
                    <th style="background-color: #4CAF50;color: white;"> Email :</th>
                    <th style="background-color: #4CAF50;color: white;"> Date de Naissance :</th>
                    <th style="background-color: #4CAF50;color: white;"> Adresse :</th>
                    <th style="background-color: #4CAF50;color: white;"> Code Postal :</th>
                    <th style="background-color: #4CAF50;color: white;"> Ville :</th>
                </tr>

                <?php


                for ($i = 0; $i < count($array_nom); $i++) {
                    echo "<tr>" .

                        '<td style="height:50px;border:2px solid black;"><a href="membership.php?id=' . $array_id[$i] .  '">' . $array_nom[$i] . ' </a></td>' .
                        '<td style="height:50px;border:2px solid black;">' . $array_prenom[$i] . '</td>' .
                        '<td style="height:50px;border:2px solid black;">' . $array_email[$i] . '</td>' .
                        '<td style="height:50px;border:2px solid black;">' . $array_date_de_naissance[$i] . '</td>' .
                        '<td style="height:50px;border:2px solid black;">' . $array_adresse[$i] . '</td>' .
                        '<td style="height:50px;border:2px solid black;">' . $array_code_postal[$i] . '</td>' .
                        '<td style="height:50px;border:2px solid black;">' . $array_ville[$i] . '</td>' .

                        "</tr>";
                }

                ?>


        </form>

    </div>
</body>

</html>