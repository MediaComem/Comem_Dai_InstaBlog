<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/suivi')?>">Tous les suivis</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouveau suivi</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/suivi/create') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Utilisateur suivi</span>
                    <div class="row">
                        <!-- ID du membre -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input required type="number" min="1" step="1" name="estSuiviParNoUtilr" id="estSuiviParNoUtilr" value="<?php if (isset($flash['inputs']['estSuiviParNoUtilr'])) echo $flash['inputs']['estSuiviParNoUtilr']; ?>"/>
                            <label for="estSuiviParNoUtilr">Numéro utilisateur</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Utilisateur suiveur</span>
                    <div class="row">
                        <!-- ID du membre -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="suitNoUtilr" id="suitNoUtilr" value="<?php if (isset($flash['inputs']['suitNoUtilr'])) echo $flash['inputs']['suitNoUtilr']; ?>"/>
                            <label for="suitNoUtilr">Numéro utilisateur</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>