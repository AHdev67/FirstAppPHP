<?php
    session_start();
    ob_start();
?>

<!-- CONTENT -->
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
            <div class="container mx-auto">
                <div class="container mt-3 pb-5">
                    <h1>Ajouter un produit</h1>
                </div>

                <div class="container px-5">
                    <form action="traitement.php?action=add" method="post">
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
                            <input type="submit" name="add" value="Ajouter le produit" class="btn btn-primary">
                        </div>
                    </form>

                    <?php 
                        if(isset($_SESSION['alerte'])){
                            echo $_SESSION['alerte'];
                            unset($_SESSION['alerte']);
                        }   
                    ?>

                </div>
            </div>
        </main>

<script>
    if (document.title != "Ajout produit") {
        document.title = "Ajout produit";
            }
</script>

<?php
    $content = ob_get_clean();
    require_once "template.php";
?>