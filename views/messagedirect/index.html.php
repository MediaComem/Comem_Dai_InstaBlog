<?php content_for('navbar'); ?>
    <?= partial('layouts/menu-fab.html.php', ['fabUrl' => '/messagedirect/create', 'fabTitle' => 'Nouveau message direct']) ?>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3>Tous les messages directs</h3>
<?php end_content_for(); ?>

<div class="col s12" id="post-list">
    <table class="striped bordered">
        <thead>
            <tr>
                <th class="center-align">No</th>
                <th class="center-align">Émetteur</th>
                <th class="center-align">Récepteur</th>
                <th>Titre</th>
                <th>Contenu</th>
                <th class="center-align">Répond au message</th>
                <th class="center-align">écrit par</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($messagesDirects as $key => $messageDirect) { ?>
                <tr>
                    <td class="center-align"><?= $messageDirect['No'] ?></td>
                    <td class="center-align"><?= $messageDirect['NoUtilrEmetteur'] ?></td>
                    <td class="center-align"><?= $messageDirect['NoUtilrRecepteur'] ?></td>
                    <td><?= $messageDirect['Titre'] ?></td>
                    <td><?= $messageDirect['Contenu'] ?></td>
                    <td class="center-align"><?= $messageDirect['RepondANo'] ? $messageDirect['RepondANo'] : '-' ?></td>
                    <td class="center-align"><?= $messageDirect['RepondANoUtilr'] ? $messageDirect['RepondANoUtilr'] : '-' ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
