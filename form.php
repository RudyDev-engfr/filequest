<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //Ma requête pour vérifier que mon formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            //Sécurisation
            $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
            //extensions autorisées
            $extensionsAllowed = ['jpg','jpeg','png','gif','webp'];
            //taille maximum
            $maxFileSize = 1000000;
            

            // si l'extension est autorisée
            if( (!in_array($extension, $extensionsAllowed))) {
                $errors[] = 'Veuillez sélectionner une image d\'un des formats autorisées : JPG, JPEG, PNG, GIF, WEBP';

            if(file_exists($_FILES['picture']['tmp_name']) && filesize($_FILES['picture']['tmp_name']) > $maxFileSize){
                $errors[] = "Votre fichier doit peser moins de 1Mo !";
            }
            }
            
            //gestion de l'upload
            
            // Ma variable pour annoncer mon chemin vers le dossier où je vais stocker les uploads
            $uploadDirectory = '/testme/uploads/';

            //Comment je vais nommer mon fichier
            $uploadFile = $uploadDirectory . basename($_FILES['picture']['name']);

            //On place le fichier où il faut
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile);
        }
    
    
    
    ?>
    <form method="post" enctype="multipart/form-data">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname">
        <label for="lastname">Lastname</label>
        <input type="text" name="lastname">
        <label for="picture">Picture</label>
        <input type="file" name="picture">
        <label for="age">Age</label>
        <input type="number" name="age">
        <input type="submit" name="submit" value="ok">
    </form>

    <?php

    if(empty($errors)){
        echo $_POST['firstname'] . "<br>";
        echo $_POST['lastname'] . "<br>";
        echo $_POST['age'] . " ans" . "<br>";
    }
    ?>
</body>
</html>