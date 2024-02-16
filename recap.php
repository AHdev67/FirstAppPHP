<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b28c0a82b5.js" crossorigin="anonymous"></script>
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
                        <a href="recap.php" class="btn btn-primary position-relative">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php 
                                    echo isset($_SESSION['products']) ? count($_SESSION['products']) : 0;
                                ?>
                            </span>
                        </a>
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
                        if(isset($_SESSION['alerte'])){
                            echo $_SESSION['alerte'];
                            unset($_SESSION['alerte']);
                        }   
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

                        if(isset($_SESSION['alerte'])){
                            echo "<tr><td colspan=4>".$_SESSION['alerte']."<td></tr>";
                            unset($_SESSION['alerte']);
                        }   

                        foreach($_SESSION["products"] as $index => $product){
                            echo "<tr>",
                                    "<td>",$index+1,"</td>",
                                    "<td>".$product['name']."</td>",
                                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                    "<td>
                                        <a href='traitement.php?action=upqtt&id=$index' class='btn'>
                                            <i class='fa-solid fa-plus'></i>
                                        </a> "
                                        .$product['qtt'].
                                        " <a href='traitement.php?action=downqtt&id=$index' class='btn'>
                                            <i class='fa-solid fa-minus'></i>
                                        </a>
                                    </td>",
                                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                    "<td><a href='traitement.php?action=delete&id=$index' class='btn'>
                                        <i class='fa-solid fa-trash'></i>
                                    </a></td>",
                                "</tr>";
                            $totalGeneral += $product['total'];
                        }

                        echo "<tr>",
                                "<td colspan=4>Total général : </td>",
                                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                                "<td><a href='traitement.php?action=clear&id=$index' class='btn btn-primary btn-sm'>
                                    Vider le panier
                                </a></td>",
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