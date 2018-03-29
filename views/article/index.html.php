<?php content_for('navbar'); ?>
    <?= partial('layouts/menu-fab.html.php', ['fabUrl' => '/article/create', 'fabTitle' => 'Nouvel article']) ?>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Tous les articles</h3>
<?php end_content_for(); ?>

<div class="col s12" id="article-list">
    <table class="striped bordered">
        <thead>
            <tr>
                <th class="center-align">No</th>
                <th>Titre</th>
                <th>Chapeau</th>
                <th>Contenu</th>
                <th class="center-align">Créé le</th>
                <th class="center-align">Publié le</th>
                <th class="center-align">Dépublié le</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($articles as $key => $article) { ?>
                <tr>
                    <td class="center-align"><?= $article['No'] ?></td>
                    <td><?= $article['Titre'] ?></td>
                    <td><?= $article['Chapeau'] ?></td>
                    <td><?= $article['Contenu'] ?></td>
                    <td class="center-align"><?= $article['DateCreation'] ?></td>
                    <td class="center-align"><?= $article['DatePublication'] ?></td>
                    <td class="center-align"><?= $article['DateFinPublication'] ? $article['DateFinPublication'] : '-' ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
