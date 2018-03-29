<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/messagedirect')?>">Tous les messages directs</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouveau message direct</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/messagedirect/create') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Émetteur</span>
                    <div class="input-field">
                        <input type="number" min="1" step="1" name="noUtilrEmetteur" id="noUtilrEmetteur" required value="<?php if (isset($flash['inputs']['noUtilrEmetteur'])) echo $flash['inputs']['noUtilrEmetteur']; ?>">
                        <label for="noUtilrEmetteur">Numéro utilisateur</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Récepteur</span>
                    <div class="input-field">
                        <input type="number" min="1" step="1" name="noUtilrRecepteur" id="noUtilrRecepteur" required value="<?php if (isset($flash['inputs']['noUtilrRecepteur'])) echo $flash['inputs']['noUtilrRecepteur']; ?>">
                        <label for="noUtilrRecepteur">Numéro utilisateur</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Message</span>
                    <div class="row">
                        <!-- Titre du message direct -->
                        <div class="input-field col s12">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="titre" id="titre" value="<?php if (isset($flash['inputs']['titre'])) echo $flash['inputs']['titre']; ?>"/>
                            <label for="titre">Titre</label>
                        </div>
                        <!-- Contenu du message direct -->
                        <div class="input-field col s12">
                            <textarea id="contenu" name="contenu" class="materialize-textarea"><?php if (isset($flash['inputs']['contenu'])) echo $flash['inputs']['contenu']; ?></textarea>
                            <label for="contenu">Contenu</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Répond à - <em>facultatif</em></span>
                    <div class="row">
                        <!-- ID du message direct -->
                        <div class="input-field col s12 m6">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="repondANo" id="repondANo" value="<?php if (isset($flash['inputs']['repondANo'])) echo $flash['inputs']['repondANo']; ?>"/>
                            <label for="repondANo">Numéro de message</label>
                        </div>
                        <!-- ID de l'auteur du message direct -->
                        <div class="input-field col s12 m6">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="repondANoUtilr" id="repondANoUtilr" value="<?php if (isset($flash['inputs']['repondANoUtilr'])) echo $flash['inputs']['repondANoUtilr']; ?>"/>
                            <label for="repondANoUtilr">Numéro de message</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>