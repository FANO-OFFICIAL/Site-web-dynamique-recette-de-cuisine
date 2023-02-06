<?php session_start(); ?>
<?php
    include_once('config/mysql.php');
    include_once('variables.php'); 
?>
<?php

$postData = $_POST;

if (isset($postData['email']) &&  isset($postData['password'])) {
    foreach ($users as $user) {
        if (
            $user['email'] === $postData['email'] &&
            $user['password'] === $postData['password']
        ) {
            $loggedUser = [
                'email' => $user['email'],
            ];

            /**
             * Cookie qui expire dans un an
             */
             $arr_cookie_options = array (
                'expires' => time() + 365*24*3600, 
                'secure' => true,     
                'httponly' => true
                );
            setcookie(
                'LOGGED_USER',
                $loggedUser['email'],
                $arr_cookie_options
            );

            $_SESSION['LOGGED_USER'] = $loggedUser['email'];
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $postData['email'],
                $postData['password']
            );
        }
    }
}

// Si le cookie ou la session sont présentes
if (isset($_COOKIE['LOGGED_USER']) || isset($_SESSION['LOGGED_USER'])) {
    $loggedUser = [
        'email' => $_COOKIE['LOGGED_USER'] ?? $_SESSION['LOGGED_USER'],
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <!-- Navigation -->
    <?php include_once('header.php'); ?>

    <!-- Formulaire de connexion -->
    <?php include_once('login.php'); ?>
        <h1>Site de Recettes !</h1>

        <!-- Plus facile à lire -->
        <?php foreach(get_recipes($recipes, $limit) as $recipe) : ?>
            <article>
                <h3><a href="./recipes/read.php?id=<?php echo($recipe['recipe_id']); ?>"><?php echo($recipe['title']); ?></a></h3>
                <div><?php echo($recipe['recipe']); ?></div>
                <i><?php echo(display_author($recipe['author'], $users)); ?></i>
                <?php if(isset($loggedUser) && $recipe['author'] === $loggedUser['email']): ?>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item"><a class="link-warning" href="./recipes/update.php?id=<?php echo($recipe['recipe_id']); ?>">Editer l'article</a></li>
                        <li class="list-group-item"><a class="link-danger" href="./recipes/delete.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer l'article</a></li>
                        
                    </ul>
                <?php endif; ?>
            </article>
            
        <?php endforeach ?>
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>