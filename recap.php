<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Recapitulatif des produits</title>
    </head>

    <body>
        <header>
            <!-- NAVBAR -->
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-5" aria-label="Third navbar example">
                <div class="container-fluid">
                    <span class="navbar-brand">Appli Web PHP</span>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExample03">
                        <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Produits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="recap.php">Panier</a>
                            </li>
                        </ul>
                        <span class="badge bg-secondary fs-6"> 
                            <?php 
                                $nbItems = array_key_last($_SESSION["products"]);
                                echo $nbItems+1, " produits dans le panier.";
                            ?>
                        </span>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div class="container mx-auto bg-light border">
                <div class="container mt-3 pb-5">
                    <h2>Votre panier contient : </h2>
                </div>

                <?php
                    //IF products array is not set (session not started) OR products array is empty, display message.
                    if(!isset($_SESSION["products"]) || empty($_SESSION["products"])){
                        echo "<p>Aucun produit en session ...</p>";
                    }
                    //ELSE display table containing array elements.
                    else{
                        echo "<table class='table'>",
                                "<thead>",
                                    "<tr>",
                                        "<th scope='col'>#</th>",
                                        "<th scope='col'>Nom</th>",
                                        "<th scope='col'>Prix</th>",
                                        "<th scope='col'>Quantité</th>",
                                        "<th scope='col'>Total</th>",
                                        "<th scope='col'></th>",
                                    "</tr>",
                                "</thead>",

                                "<tbody>";
                        //total price of all products
                        $totalGeneral = 0;

                        foreach($_SESSION["products"] as $index => $product){
                            $index = $index+1;
                            echo "<tr>",
                                    "<td>",$index,"</td>",
                                    "<td>".$product['name']."</td>",
                                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                    "<td>
                                        <a href='traitement.php?action=upqtt&id=$index' class='btn'>+</a> "
                                        .$product['qtt'].
                                        " <a href='traitement.php?action=downqtt&id=$index' class='btn'>-</a>
                                    </td>",
                                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                    "<td><a href='traitement.php?action=downqtt&id=$index' class='btn'>suppr</a></td>",
                                "</tr>";
                            $totalGeneral += $product['total'];
                        }
                        echo "<tr>",
                                "<td colspan=4>Total général : </td>",
                                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                                "<td><a href='traitement.php?action=downqtt&id=$index' class='btn'>Vider le panier</a></td>",
                            "</tr>",
                            "</tbody",
                            "</table>";
                    }
                ?>

            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>