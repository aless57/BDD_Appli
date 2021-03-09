<?php

$db = new PDO('mysql:host=localhost;dbname=gamesdb','root','');

if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

$sql = 'SELECT COUNT(*) AS nb_jeux FROM `game`;';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetch();
$nbJeux = (int) $result['nb_jeux'];

$parPage = 500;
$pages = ceil($nbJeux / $parPage);

$premier = ($currentPage * $parPage) - $parPage;

$sql = 'SELECT * FROM `game` ORDER BY `id` ASC LIMIT :premier, :parpage;';
$query = $db->prepare($sql);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$query->execute();
$jeux = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination TD1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<main class="container">
    <div class="row">
        <section class="col-12">
            <h1>Liste des jeux</h1>
            <table class="table">
                <thead>
                <th>ID</th>
                <th>Titre</th>
                <th>DECK</th>
                </thead>
                <tbody>
                <?php
                foreach($jeux as $jeu){
                    ?>
                    <tr>
                        <td><?= $jeu['id'] ?></td>
                        <td><?= $jeu['name'] ?></td>
                        <td><?= $jeu['deck'] ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                    </li>
                    <?php for($page = 1; $page <= $pages; $page++): ?>
                        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                            <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>
</main>
</body>
</html>