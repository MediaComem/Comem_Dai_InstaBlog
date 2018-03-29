<!DOCTYPE html>
<html>
    <head>
        <title>InstaBlog</title>

        <!-- BOOTSTRAP -->

        <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"/> -->

        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- APP CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/app.css"/>

        <!-- MATERIALIZE -->
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/materialize.min.css"/>

    </head>
    <body>
        <!-- Compiled and minified JavaScript -->
        <script src="assets/js/jquery-2.2.1.min.js"></script>
        <script src="assets/js/materialize.min.js"></script>

        <!-- Markup -->
        <header class="navbar-fixed">
            <nav class="teal">
                <div class="nav-wrapper container">
                    <a class="brand-logo" href="<?= url_for('/')?>">InstaBlog</a>
                    <ul class="right">
                        <?php if (isset($navbar)) echo $navbar; ?>
                    </ul>
                </div>
            </nav>
        </header>
        <main class="container">

            <?php if (isset($contentTitle)) echo $contentTitle; ?>

            <!-- will be used to show any messages -->
            <?php if (isset($flash['success'])) {?>
                <div class="card-panel success"><?= $flash['success']?></div>
            <?php } ?>
            <?php if (isset($flash['info'])) {?>
                <div class="card-panel info"><?= $flash['info']?></div>
            <?php } ?>
            <?php if (isset($flash['warning'])) {?>
                <div class="card-panel warning"><?= $flash['warning']?></div>
            <?php } ?>
            <?php if (isset($flash['error'])) {?>
                <div class="card-panel error"><?= $flash['error']?></div>
            <?php } ?>

            <?php if (isset($errors) and count($errors) > 0) { ?>
                <div class="card-panel error">
                    <?php foreach($errors as $key => $error) { ?>
                        <ul>
                            <li><?= $error?></li>
                        </ul>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="row">
                <?= $content?>
            </div>

        </main>
        <footer class="page-footer teal lighten-1">
            <div class="footer-copyright">
                <div class="container">
                    Media Engineering | 2017 - 2018 | De la données à l'information
                    <span class="right">
                        <a href="mailto:gabor.maksay@heig-vd.ch" class="amber-text text-lighten-3">Maksay Gabor</a> & <a href="mailto:mathias.oberson@heig-vd.ch" class="amber-text text-lighten-3">Mathias Oberson</a>
                    </span>
                </div>
            </div>
        </footer>
    </body>
</html>