<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Ajout produit</title>
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
                                <a class="nav-link active" aria-current="page" href="index.php">Produits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="recap.php">Panier</a>
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
            <div class="container mx-auto">
                <div class="container mt-3 pb-5">
                    <h1>Ajouter un produit</h1>
                </div>

                <div class="container px-5">
                    <form action="traitement.php" method="post">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du produit : </label>
                            <input type="text" class="form-control" id="nom" name="name" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix du produit : </label>
                            <input type="number" step="any" class="form-control" id="prix" name="price">
                        </div>

                        <div class="mb-5">
                            <label for="quantite" class="form-label">Quantité d'articles : </label>
                            <input type="number" value="1" class="form-control" id="quantite" name="qtt">
                        </div>
                       
                        <div class="mb-4">
                            <input type="submit" name="submit" value="Ajouter le produit">
                            <?php
                                if (isset($_GET['success']) && $_GET['success'] == 1){
                                    echo "<div class='alert alert-primary' role='alert'>Produit ajouté !</div>";
                                }
                                // else {
                                //     echo "<div class='alert alert-danger' role='alert'>Erreur, aucun produit ajouté ...</div>";
                                // }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

</html>