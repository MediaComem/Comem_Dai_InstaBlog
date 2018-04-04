<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/media')?>">Tous les médias</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouveau média</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/media/create') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <!-- Url de stockage du média -->
                        <div class="input-field col s12">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="url" id="url" value="<?php if (isset($flash['values'][':url'])) echo $flash['values'][':url']; ?>"/>
                            <label for="url">URL</label>
                        </div>
                        <!--Choix de l'emplacement de stockage -->
                        <div class="col s12">
                            <p>
                                Stockage
                            </p>
                            <p>
                                <input name="stockage" type="radio" id="stockageInterne" value="interne" <?php if(!isset($flash['values'][':stockage']) or (isset($flash['values'][':stockage']) and $flash['values'][':stockage'] === "interne")) echo "checked"; ?>/>
                                <label for="stockageInterne">Interne</label>
                            </p>
                            <p>
                                <input name="stockage" type="radio" id="stockageExterne" value="externe" <?php if(isset($flash['values'][':stockage']) and $flash['values'][':stockage'] === "externe") echo "checked"; ?>/>
                                <label for="stockageExterne">Externe</label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>