<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/membre')?>">Tous les membres</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouveau membre</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/membre/create') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Groupe</span>
                    <div class="row">
                        <!-- ID du membre -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input required type="number" min="1" step="1" name="noGrpe" id="noGrpe" value="<?php if (isset($flash['values'][':noGrpe'])) echo $flash['values'][':noGrpe']; ?>"/>
                            <label for="noGrpe">Numéro groupe</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Utilisateur</span>
                    <div class="row">
                        <!-- ID du membre -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="noUtilr" id="noUtilr" value="<?php if (isset($flash['values'][':noUtilr'])) echo $flash['values'][':noUtilr']; ?>"/>
                            <label for="noUtilr">Numéro utilisateur</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>