<?php content_for('navbar'); ?>
    <li><a href="<?=url_for('/article')?>">Tous les articles</a></li>
<?php end_content_for(); ?>

<?php content_for('contentTitle'); ?>
    <h3 class="col s12">Nouvel article</h3>
<?php end_content_for(); ?>

<form action="<?= url_for('/article/create') ?>" method="post" class="col s12">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <!-- Titre de l'article -->
                        <div class="input-field col s12">
                            <!-- Aucune restriction à faire pour ce champ -->
                            <input required type="text" name="titre" id="titre" value="<?php if (isset($flash['values']['article'][':titre'])) echo $flash['values']['article'][':titre']; ?>"/>
                            <label for="titre">Titre</label>
                        </div>
                        <!-- Chapeau de l'article -->
                        <div class="input-field col s12">
                            <textarea id="contenu" name="chapeau" class="materialize-textarea"><?php if (isset($flash['values']['article'][':chapeau'])) echo $flash['values']['article'][':chapeau']; ?></textarea>
                            <label for="chapeau">Chapeau</label>
                        </div>
                        <!-- Contenu de l'article -->
                        <div class="input-field col s12">
                            <textarea id="contenu" name="contenu" class="materialize-textarea"><?php if (isset($flash['values']['article'][':contenu'])) echo $flash['values']['article'][':contenu']; ?></textarea>
                            <label for="contenu">Contenu</label>
                        </div>
                        <!-- Date de publication de l'article -->
                        <div class="input-field col s12 m6">
                            <!-- Doit être inférieure ou égale à aujourd'hui -->
                            <label class="active" for="datePublication">Date de publication</label>
                            <input type="date" name="datePublication" id="datePublication" required value="<?php if (isset($flash['values']['article'][':datePublication'])) echo $flash['values']['article'][':datePublication']; ?>">
                        </div>
                        <!-- Date de publication de l'article -->
                        <div class="input-field col s12 m6">
                            <!-- Doit être inférieure ou égale à aujourd'hui -->
                            <label class="active" for="dateFinPublication">Date de fin de publication - <em>facultatif</em></label>
                            <input type="date" name="dateFinPublication" id="dateFinPublication" required value="<?php if (isset($flash['values']['article'][':dateFinPublication'])) echo $flash['values']['article'][':dateFinPublication']; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Historique</span>
                    <div class="row">
                        <!-- ID de l'utilisateur -->
                        <div class="input-field col s12 m6">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="historique[:noUtilr]" id="histoNoUtilr" value="<?php if (isset($flash['values']['historique'][':noUtilr'])) echo $flash['values']['historique'][':noUtilr']; ?>"/>
                            <label for="histoNoUtilr">Numéro utilisateur</label>
                        </div>
                        <!-- Statut de l'historique -->
                        <div class="input-field col s12 m6">
                            <select required class="browser-default" name="historique[:statut]">
                                <option value="brouillon" <?php if(!isset($flash['values']['historique'][':statut']) or (isset($flash['values']['historique'][':statut']) and $flash['values']['historique'][':statut'] === "brouillon")) echo "selected"; ?>>Brouillon</option>
                                <option value="publié" <?php if(isset($flash['values']['historique'][':statut']) and $flash['values']['historique'][':statut'] === "publié") echo "selected"; ?>>Publié</option>
                                <option value="révision" <?php if(isset($flash['values']['historique'][':statut']) and $flash['values']['historique'][':statut'] === "révision") echo "selected"; ?>>Révision</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Theme 1</span>
                    <div class="row">
                        <!-- ID du theme -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input required type="number" min="1" step="1" name="themes[0][:noTheme]" id="theme1" value="<?php if (isset($flash['values']['themes'][0][':noTheme'])) echo $flash['values']['themes'][0][':noTheme']; ?>"/>
                            <label for="theme1">Numéro thème</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Theme 2 - <em>facultatif</em></span>
                    <div class="row">
                        <!-- ID du theme -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="themes[1][:noTheme]" id="theme2" value="<?php if (isset($flash['values']['themes'][1][':noTheme'])) echo $flash['values']['themes'][1][':noTheme']; ?>"/>
                            <label for="theme2">Numéro thème</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title amber-text text-darken-4">Theme 3 - <em>facultatif</em></span>
                    <div class="row">
                        <!-- ID du theme -->
                        <div class="input-field col s12">
                            <!-- min="1" assure ne valide que des nombres positifs. step="1" ne valide que des nombres entiers -->
                            <input type="number" min="1" step="1" name="themes[2][:noTheme]" id="theme3" value="<?php if (isset($flash['values']['themes'][2][':noTheme'])) echo $flash['values']['themes'][2][':noTheme']; ?>"/>
                            <label for="theme3">Numéro thème</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>