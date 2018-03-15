<?= print_r($flash) ?>
<form action="<?= url_for('form_test'); ?>" method="post">
  <input type="text" name="name" id="name" value="<?php if (isset($flash["inputs"]["name"])) echo $flash["inputs"]["name"] ?>">
  <input type="password" name="pass" id="pass" value="<?php if (isset($flash["inputs"]["pass"])) echo $flash["inputs"]["pass"] ?>">
  <input type="checkbox" name="remember" id="remember" <?php if (isset($flash["inputs"]["remember"]) && $flash["inputs"]["remember"] === "on") echo "checked" ?>>
  <input type="date" name="date" id="date">
  <input type="submit" value="Envoyer">
</form>
<?php if (isset($flash["errors"])) {
  foreach ($flash["errors"] as $error) { ?>
    <p><?= $error ?></p>
  <?php }
} ?>
<?php if (isset($flash["success"])) { ?>
    <p><?= $flash["success"] ?></p>
<?php } ?>