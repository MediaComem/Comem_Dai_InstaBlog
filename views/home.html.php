<?php content_for('contentTitle'); ?>
    <h3>Administration</h3>
<?php end_content_for(); ?>

<div id="admin">
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Utilisateurs', 'url' => '/users'])?>
</div>