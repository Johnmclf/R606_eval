<?php

$host = getenv("DB_HOST") ?: "db";
$db = getenv("DB_NAME") ?: "myapp_db";
$user = getenv("DB_USER") ?: "root";
$pass = getenv("DB_PASS") ?: "rootpassword";
$charset = getenv("DB_CHARSET") ?: "utf8mb4";

try {
    // On tente de se connecter à la base de données, si la connexion échoue, une exception est levée et on affiche un message d'erreur
    $p = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
    $p->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $p->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur lors de la connexion à la BDD : ' . $e->getMessage();
    exit();
}

try {
    // On tente de récupérer les données, si la table n'existe pas, une exception est levée et on passera à la création de la table et l'insertion des données
    $d = $p->query("SELECT id,text FROM db_table")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Création de la table et insertion des données
    $p->prepare('CREATE TABLE IF NOT EXISTS db_table (id INT PRIMARY KEY AUTO_INCREMENT, text VARCHAR(100) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4')->execute();
    $p->prepare('INSERT INTO db_table (text) VALUES (:text)')->execute([':text' => 'azerty']);
    $p->prepare('INSERT INTO db_table (text) VALUES (:text)')->execute([':text' => 'abcdef']);
    $p->prepare('INSERT INTO db_table (text) VALUES (:text)')->execute([':text' => 'xyz']);
    $p->prepare('INSERT INTO db_table (text) VALUES (:text)')->execute([':text' => '123456789']);
    $d = $p->query('SELECT id,text FROM db_table')->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>R6.06 Maintenance applicative</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>R6.06 Maintenance applicative</h1>
    <h2 class="crimson">Evaluation</h2>
    <p class="crimson" >Modifiez ce projet à l'aide des outils vus ensemble pour améliorer la maintenabilité de ce projet et déployez le sur le serveur mis à votre disposition</p><p class="crimson">Vous êtes libre de modifier ce que vous souhaitez sur le projet, chaque amélioration (ou début d'amélioration) sera prise en compte dans la notation</p>
    <p class="p_rappel ">Pensez à inviter cdiiv sur votre projet Github</p>
</header>

<table>
    <thead class="bold">
        <tr>
            <td class="td_table">Id</td>
            <td class="td_table">Text</td>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; while (true) { if(!key_exists($i, $d)) break;?>
            <tr>
                <td class="td_table"><?= $d[$i]['id'] ?></td>
                <td class="td_table"><?= $d[$i]['text'] ?></td>
            </tr>
        <?php $i++; } ?>
    </tbody>
</table>
</body>
</html>
