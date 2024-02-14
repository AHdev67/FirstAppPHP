<?php

session_start();

if (isset($_POST['submit'])){
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
    }
    
    header("Location:index.php?success=1");
    exit();
}


switch ($_GET["action"]) {

    case 'upqtt':
        //var_dump($_GET['id']);die();
        //si il y a un produit en session avec le meme id alors je fait qtt ++*
        $product['qtt'] += 1;
        break;

    case 'downqtt':
        $product['qtt'] -= 1;
        break;
}

header("Location:recap.php");
exit();