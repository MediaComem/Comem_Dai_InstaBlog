<?php content_for('contentTitle'); ?>
    <h3>Administration</h3>
<?php end_content_for(); ?>

<div id="admin">
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Utilisateurs', 'url' => '/utilisateur', 'icon' => 'person'])?>
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Médias', 'url' => '/media', 'icon' => 'photo_library'])?>
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Posts', 'url' => '/post', 'icon' => 'chat'])?>
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Messages directs', 'url' => '/messagedirect', 'icon' => 'forum'])?>
    <!-- TODO -->
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Articles', 'url' => '/article', 'icon' => 'description'])?>
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Groupes', 'url' => '/groupe', 'icon' => 'group'])?>
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Followers', 'url' => '/follower', 'icon' => 'person_add'])?>
    <?= partial('layouts/menu-panel.html.php', ['name' => 'Membres', 'url' => '/membre', 'icon' => 'group_add'])?>
</div>
