<?php

session_start();

if( isset($_GET['action'])){

    switch ($_GET['action']) {

        //ADDING NEW PRODUCT
        case "add":
            if(isset($_POST['add'])) {
                //excludes special characters and thus prevents html code injection.
                $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING);
                //guarentees that the input is a decimal number, and allows both . AND , to express the decimal.
                $price = filter_input(INPUT_POST,"price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                //guarentees that the input is an integer different than 0.
                $qtt = filter_input(INPUT_POST,"qtt", FILTER_VALIDATE_INT);

                //IF all form elements have been filled correctly upon submit, fill product array.
                if($name && $price && $qtt){
                    $product = [
                        "name"=> $name,
                        "price"=> $price,
                        "qtt"=> $qtt,
                        "total"=> $price*$qtt
                    ];
                    //fill products array with product arrays (i know) to display the total list of saved products.
                    $_SESSION['products'][] = $product;
                    $_SESSION['alerte'] = "Produit ajouté !";
                }
                else{
                    $_SESSION['alerte'] = "Erreur, aucun produit n'as été ajouté.";
                }
            }
            header("Location:index.php?success=1");
            break;

        //INCREASE QUANTITY BY ONE
        case 'upqtt':
            if($_GET['action'] == "upqtt") {
               
                $index = isset($_GET['id']) ? $_GET['id'] : null;
                if(isset($_SESSION['products'][$index]['qtt'])) {
                    //incrémentation
                    $_SESSION['products'][$index]['qtt']++;
                    //MaJ prix
                    $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
                }
            }
            header("Location:recap.php");
            break;

        //DECREASE QUANTITY BY ONE
        case 'downqtt':
            if($_GET['action'] == "downqtt") {

                $index = isset($_GET['id']) ? $_GET['id'] : null;
                if(isset($_SESSION['products'][$index]['qtt']) && $_SESSION['products'][$index]['qtt'] >= 1) {
                    //désincrémentation
                    $_SESSION['products'][$index]['qtt']--;
                    //MaJ prix
                    $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
                }
            }
            header("Location:recap.php");
            break;

        //DELETE ITEM FROM CART
        case 'delete' :
            if($_GET['action'] == "delete") {

                $index = $_GET['id'];

                if(isset($_SESSION['products'][$index])) {
                    unset($_SESSION['products'][$index]);
                }
            }
            header("Location:recap.php");
            break;

        //CLEAR CART
        case 'clear':
            if($_GET['action'] == "clear") {

                unset($_SESSION['products']);
            }
            header("Location:recap.php");
            break;
    }   
}