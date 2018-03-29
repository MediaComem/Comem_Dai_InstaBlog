<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/groupe')?>">Tous les groupes</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouveau groupe</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/groupe/create') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <!-- Nom du groupe -->
                        <div class="input-field col s12">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="nom" id="nom" value="<?php if (isset($flash['inputs']['nom'])) echo $flash['inputs']['nom']; ?>"/>
                            <label for="nom">Nom</label>
                        </div>
                        <!-- Description du groupe -->
                        <div class="input-field col s12">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="description" id="description" value="<?php if (isset($flash['inputs']['description'])) echo $flash['inputs']['description']; ?>"/>
                            <label for="description">Description</label>
                        </div>
                        <!-- Date de création du groupe -->
                        <div class="input-field col s12 m6">
                            <!-- Doit être inférieure ou égale à aujourd'hui -->
                            <label class="active" for="dateCreation">Date de création</label>
                            <input type="date" name="dateCreation" id="dateCreation" required value="<?php if (isset($flash['inputs']['dateCreation'])) echo $flash['inputs']['dateCreation']; ?>">
                        </div>
                        <!-- ID de l'administrateur -->
                        <div class="input-field col s12 m6">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="administrateur" id="administrateur" value="<?php if (isset($flash['inputs']['administrateur'])) echo $flash['inputs']['administrateur']; ?>"/>
                            <label for="administrateur">Numéro de l'administrateur</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Membre 1</span>
                    <div class="row">
                        <!-- ID du membre -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input required type="number" min="1" step="1" name="membres[0][NoUtilr]" id="membres[0][NoUtilr]" value="<?php if (isset($flash['inputs']['membres'][0]['NoUtilr'])) echo $flash['inputs']['membres'][0]['NoUtilr']; ?>"/>
                            <label for="membres[0][NoUtilr]">Numéro utilisateur</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Membre 2 - <em>facultatif</em></span>
                    <div class="row">
                        <!-- ID du membre -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="membres[1][NoUtilr]" id="membres[1][NoUtilr]" value="<?php if (isset($flash['inputs']['membres'][1]['NoUtilr'])) echo $flash['inputs']['membres'][1]['NoUtilr']; ?>"/>
                            <label for="membres[1][NoUtilr]">Numéro utilisateur</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Membre 3 - <em>facultatif</em></span>
                    <div class="row">
                        <!-- ID du membre -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="membres[2][NoUtilr]" id="membres[2][NoUtilr]" value="<?php if (isset($flash['inputs']['membres'][2]['NoUtilr'])) echo $flash['inputs']['membres'][2]['NoUtilr']; ?>"/>
                            <label for="membres[2][NoUtilr]">Numéro utilisateur</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>