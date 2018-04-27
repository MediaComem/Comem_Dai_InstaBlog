<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/groupe')?>">Tous les groupes</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouveau groupe</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/groupe') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <!-- Nom du groupe -->
                        <div class="input-field col s12 m6">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="nom" id="nom" value="<?php if (isset($flash['values']['groupe'][':nom'])) echo $flash['values']['groupe'][':nom']; ?>"/>
                            <label for="nom">Nom</label>
                        </div>
                        <!-- ID de l'administrateur -->
                        <div class="input-field col s12 m6">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="administrateur" id="administrateur" value="<?php if (isset($flash['values']['groupe'][':administrateur'])) echo $flash['values']['groupe'][':administrateur']; ?>"/>
                            <label for="administrateur">Numéro de l'administrateur</label>
                        </div>
                        <!-- Description du groupe -->
                        <div class="input-field col s12">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="description" id="description" value="<?php if (isset($flash['values']['groupe'][':description'])) echo $flash['values']['groupe'][':description']; ?>"/>
                            <label for="description">Description</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Membres</span>
                    <div class="row">
                        <!-- ID du membre 1 -->
                        <div class="input-field col s12 m4">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input required type="number" min="1" step="1" name="membres[1][:noUtilr]" id="membre1" value="<?php if (isset($flash['values']['membres'][1][':noUtilr'])) echo $flash['values']['membres'][1][':noUtilr']; ?>"/>
                            <label for="membre1">Numéro utilisateur 1</label>
                        </div>
                        <!-- ID du membre 2 -->
                        <div class="input-field col s12 m4">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="membres[2][:noUtilr]" id="membre2" value="<?php if (isset($flash['values']['membres'][2][':noUtilr'])) echo $flash['values']['membres'][2][':noUtilr']; ?>"/>
                            <label for="membre2">Numéro utilisateur 2 - <em>facultatif</em></label>
                        </div>
                        <!-- ID du membre 3 -->
                        <div class="input-field col s12 m4">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="membres[3][:noUtilr]" id="membre3" value="<?php if (isset($flash['values']['membres'][3][':noUtilr'])) echo $flash['values']['membres'][3][':noUtilr']; ?>"/>
                            <label for="membre3">Numéro utilisateur 3 - <em>facultatif</em></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>