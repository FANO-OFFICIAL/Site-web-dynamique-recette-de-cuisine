

<?php if(!isset($loggedUser)): ?>
<p>Pour vous connecter :</p>
<ul>
    <li>User : mickael.andrieu@exemple.com et Mp : S3cr3t</li>
    <li>User : mathieu.nebra@exemple.com et Mp : MiamMiam</li>
    <li>User : laurene.castor@exemple.com et Mp : laCasto28</li>
</ul>
<form action="index.php" method="post">
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo($errorMessage); ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
        <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
<?php else: ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo($loggedUser['email']); ?> ! <a class="" href="<?php echo($rootUrl). 'logout.php'; ?>">Se déconnecter</a>
    </div>
<?php endif; ?>