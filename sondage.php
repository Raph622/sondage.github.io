<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sondage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $gender = $_POST["gender"];
        $answer = $_POST["answer"];
        $errors = array();


        if (empty($gender)) {
            $errors['gender'] = "Veuillez remplir ce champ.";
        }
        if (empty($answer)) {
            $errors['answer'] = "Veuillez remplir ce champ.";
        }

    if (empty($errors) && !empty($gender) && !empty($answer)) {
        $sql = "INSERT INTO avis (genre, reponse) VALUES (:gender, :answer)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':answer', $answer);
        $stmt->execute();
        echo "votre avis a été pris en compte , merci pour votre participation";

    }
    

       
    }
    
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sondage</title>
    <style>
       .container{
        width: 60rem;
        height: 30rem;
        background-color:white;
        margin-left: 16rem;
        margin-top: 06rem;
        border-radius: 30px;
        box-shadow:1px 1px 6px rgba(0, 0, 0, 0.305) ;
        display: flex;
       }
       .left-content{
        margin-left: 1rem;
        margin-top: 2rem;
       }

       .forms label{
        color: black;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-weight: bold;
        font-size: 1.2em;
       }
       .formu{
        margin-top: 1rem;
       }
       .form textarea{
        margin-top: 1rem;
        width: 30rem;
        height: 15rem;
       }
       .form input {
        width: 10rem;
        height: 1.8em;
        background-color: greenyellow;
        border: none;
        box-shadow:1px 1px 6px rgba(0, 0, 0, 0.305) ;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-weight: bold;
        
       }
       .form input:hover{
        background-color: rgb(25, 250, 25);
        box-shadow: none;
        cursor: pointer;
        color: white;
       }
       .right-content{
        width: 30rem;
        height: 30rem;
        background-image: url("ai-generated-8704440_1280.jpg");
        background-size: cover;
        margin-left: -1rem;
        border-top-right-radius: 30px;
        border-bottom-right-radius:30px ;
       }
      
       .right-content:hover{
        border-radius: 30px;
        scale:1.1;
       } 
    </style>
</head>
<body>
    <div class="container">
        <div class="left-content">
            <form action="" method="post">
                <div class="forms">
                    <label for=""> met (h) si tu est un homme et (f) une femme </label>
                    <div class="forms">
                        <input type="text" name="gender" id="" style="width:30rem; height:2em;">
                        <?php if(isset($errors['gender'])) echo "<p style='color:red;'>" . $errors['gender'] . "</p>"; ?>
                    </div>
                   <div class="formu">
                    <label for="" style="margin-top: 1rem;"> comme imagine-tu le sac parfait pour toi ? (hommes et femme)</label>
                    <div class="form">
                        <textarea name="answer" id=""></textarea>
                        <?php if(isset($errors['answer'])) echo "<p style='color:red;'>" . $errors['answer'] . "</p>"; ?>
                    </div>
                   </div>
                   <div class="form">
                    <input type="submit" value="Envoyer la reponse" name="send" >
                   </div>
                </div>
            </form>

        </div>
        <div class="right-content">

        </div>

    </div>
</body>
</html>