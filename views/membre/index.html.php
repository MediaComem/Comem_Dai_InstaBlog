<?php content_for('navbar'); ?>
    <?= partial('layouts/menu-fab.html.php', ['fabUrl' => '/membre/create', 'fabTitle' => 'Nouveau membre']) ?>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Tous les membres</h3>
<?php end_content_for(); ?>

<div class="col s12" id="membre-list">
    <table class="striped bordered">
        <thead>
            <tr>
                <th class="center-align">No groupe</th>
                <th class="center-align">No utilisateur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($membres as $key => $membre) { ?>
                <tr>
                    <td class="center-align"><?= $membre['NoGrpe'] ?></td>
                    <td class="center-align"><?= $membre['NoUtilr'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
