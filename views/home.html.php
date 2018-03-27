<?php content_for('contentTitle'); ?>
    <h3>Administration</h3>
<?php end_content_for(); ?>

<div id="admin">
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Utilisateurs', 'url' => '/utilisateur', 'icon' => 'account_box'])?>
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Média', 'url' => '/media', 'icon' => 'photo_library'])?>
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Post', 'url' => '/post', 'icon' => 'description'])?>
</div>
