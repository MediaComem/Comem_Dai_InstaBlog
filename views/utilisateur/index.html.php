<?php content_for('navbar'); ?>
    <?= partial('layouts/menu-fab.html.php', ['fabUrl' => '/utilisateur/create', 'fabTitle' => 'Nouvel utilisateur']) ?>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Tous les utilisateurs</h3>
<?php end_content_for(); ?>

<div class="col s12">
    <table class="striped bordered">
        <thead>
            <tr>
                <th class="center-align">No</th>
                <th>Pseudo</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th class="center-align">Date de naissance</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th class="center-align">Sexe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $key => $user) { ?>
                <tr>
                    <td class="center-align"><?= $user['No'] ?></td>
                    <td><?= $user['Pseudo'] ?></td>
                    <td><?= $user['Nom'] ?></td>
                    <td><?= $user['Prenom'] ?></td>
                    <td class="center-align"><?= $user['DateNaissance'] ?></td>
                    <td><?= $user['Email'] ?></td>
                    <td><?= $user['Telephone'] ? $user['Telephone'] : '-' ?></td>
                    <td class="center-align"><?= $user['Sexe'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
