<?php content_for('navbar'); ?>
    <?= partial('layouts/menu-fab.html.php', ['fabUrl' => '/post/create', 'fabTitle' => 'Nouveau post']) ?>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Tous les posts</h3>
<?php end_content_for(); ?>

<div class="col s12" id="post-list">
    <table class="striped bordered">
        <thead>
            <tr>
                <th class="center-align">No</th>
                <th class="center-align">Utilisateur</th>
                <th class="center-align">Créé le</th>
                <th class="center-align">Publié le</th>
                <th class="center-align">Type</th>
                <th>Texte</th>
                <th class="center-align">Pos. GPS</th>
                <th class="center-align">Groupe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $key => $post) { ?>
                <tr>
                    <td class="center-align"><?= $post['No'] ?></td>
                    <td class="center-align"><?= $post['NoUtilr'] ?></td>
                    <td class="center-align"><?= $post['DateCreation'] ?></td>
                    <td class="center-align"><?= $post['DatePublication'] ?></td>
                    <td class="center-align"><?= $post['Type'] ?></td>
                    <td class="post-texte"><?= $post['Texte'] ? $post['Texte'] : '-' ?></td>
                    <td class="center-align"><?= $post['NoPosGPS'] ? $post['NoPosGPS'] : '-' ?></td>
                    <td class="center-align"><?= $post['NoGrpe'] ? $post['NoGrpe'] : '-' ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
