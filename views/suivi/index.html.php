<?php content_for('navbar'); ?>
    <?= partial('layouts/menu-fab.html.php', ['fabUrl' => '/suivi/create', 'fabTitle' => 'Nouveau suivi']) ?>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Tous les suivis</h3>
<?php end_content_for(); ?>

<div class="col s12" id="suivi-list">
    <table class="striped bordered">
        <thead>
            <tr>
                <th class="center-align">No utilisateur</th>
                <th class="center-align">Est suivi par</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($suivis as $key => $suivi) { ?>
                <tr>
                    <td class="center-align"><?= $suivi['SuitNoUtilr'] ?></td>
                    <td class="center-align"><?= $suivi['EstSuiviParNoUtilr'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
