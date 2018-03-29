<?php content_for('navbar'); ?>
    <?= partial('layouts/menu-fab.html.php', ['fabUrl' => '/groupe/create', 'fabTitle' => 'Nouveau groupe']) ?>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Tous les groupes</h3>
<?php end_content_for(); ?>

<div class="col s12" id="groupe-list">
    <table class="striped bordered">
        <thead>
            <tr>
                <th class="center-align">No</th>
                <th>Nom</th>
                <th>Description</th>
                <th class="center-align">Créé le</th>
                <th class="center-align">No Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($groupes as $key => $groupe) { ?>
                <tr>
                    <td class="center-align"><?= $groupe['No'] ?></td>
                    <td><?= $groupe['Nom'] ?></td>
                    <td><?= $groupe['Description'] ?></td>
                    <td class="center-align"><?= $groupe['DateCreation'] ?></td>
                    <td class="center-align"><?= $groupe['Administrateur'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
