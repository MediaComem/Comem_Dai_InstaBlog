<?php content_for('navbar'); ?>
    <?= partial('layouts/menu-fab.html.php', ['fabUrl' => '/media/create', 'fabTitle' => 'Nouveau média']) ?>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Tous les médias</h3>
<?php end_content_for(); ?>

<div class="col s12" id="media-list">
    <table class="striped bordered">
        <thead>
            <tr>
                <th class="center-align">No</th>
                <th class="center-align">Date de création</th>
                <th>Stockage</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($medias as $key => $media) { ?>
                <tr>
                    <td class="center-align"><?= $media['No'] ?></td>
                    <td class="center-align"><?= $media['DateCreation'] ?></td>
                    <td><?= $media['Stockage'] ?></td>
                    <td class="media-url"><span class="truncate"><?= $media['Url'] ?></span></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
