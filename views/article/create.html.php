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
                            <input required type="text" name="titre" id="titre" value="<?php if (isset($flash['inputs']['titre'])) echo $flash['inputs']['titre']; ?>"/>
                            <label for="titre">Titre</label>
                        </div>
                        <!-- Contenu de l'article -->
                        <div class="input-field col s12">
                            <textarea id="contenu" name="chapeau" class="materialize-textarea"><?php if (isset($flash['inputs']['chapeau'])) echo $flash['inputs']['chapeau']; ?></textarea>
                            <label for="chapeau">Chapeau</label>
                        </div>
                        <!-- Contenu de l'article -->
                        <div class="input-field col s12">
                            <textarea id="contenu" name="contenu" class="materialize-textarea"><?php if (isset($flash['inputs']['contenu'])) echo $flash['inputs']['contenu']; ?></textarea>
                            <label for="contenu">Contenu</label>
                        </div>
                        <!-- Date de création de l'article -->
                        <div class="input-field col s12 m4">
                            <!-- Doit être inférieure ou égale à aujourd'hui -->
                            <label class="active" for="dateCreation">Date de création</label>
                            <input type="date" name="dateCreation" id="dateCreation" required value="<?php if (isset($flash['inputs']['dateCreation'])) echo $flash['inputs']['dateCreation']; ?>">
                        </div>
                        <!-- Date de publication de l'article -->
                        <div class="input-field col s12 m4">
                            <!-- Doit être inférieure ou égale à aujourd'hui -->
                            <label class="active" for="datePublication">Date de publication</label>
                            <input type="date" name="datePublication" id="datePublication" required value="<?php if (isset($flash['inputs']['datePublication'])) echo $flash['inputs']['datePublication']; ?>">
                        </div>
                        <!-- Date de publication de l'article -->
                        <div class="input-field col s12 m4">
                            <!-- Doit être inférieure ou égale à aujourd'hui -->
                            <label class="active" for="dateFinPublication">Date de fin de publication - <em>facultatif</em></label>
                            <input type="date" name="dateFinPublication" id="dateFinPublication" required value="<?php if (isset($flash['inputs']['dateFinPublication'])) echo $flash['inputs']['dateFinPublication']; ?>">
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
                            <input type="number" min="1" step="1" name="historique[NoUtilr]" id="historique[NoUtilr]" value="<?php if (isset($flash['inputs']['historique']['NoUtilr'])) echo $flash['inputs']['historique']['NoUtilr']; ?>"/>
                            <label for="historique[NoUtilr]">Numéro utilisateur</label>
                        </div>
                        <!-- Date de l'historique -->
                        <div class="input-field col s12 m6">
                            <!-- Doit être inférieure ou égale à aujourd'hui -->
                            <label class="active" for="historique[Date]">Date</label>
                            <input type="date" name="historique[Date]" id="historique[Date]" required value="<?php if (isset($flash['inputs']['historique']['Date'])) echo $flash['inputs']['historique']['Date']; ?>">
                        </div>
                        <!-- Heure de l'historique -->
                        <div class="input-field col s12 m6">
                            <label class="active" for="historique[Heure]">Heure</label>
                            <input type="time" name="historique[Heure]" id="historique[Heure]" required value="<?php if (isset($flash['inputs']['historique']['Heure'])) echo $flash['inputs']['historique']['Heure']; ?>">
                        </div>
                        <!-- Statut de l'historique -->
                        <div class="input-field col s12 m6">
                            <select required class="browser-default" name="historique[Statut]">
                                <option value="" disabled <?php if(!isset($flash['inputs']['historique']['Statut'])) echo "selected"; ?>>Statut</option>
                                <option value="brouillon" <?php if(isset($flash['inputs']['historique']['Statut']) and $flash['inputs']['historique']['Statut'] === "brouillon") echo "selected"; ?>>Brouillon</option>
                                <option value="publié" <?php if(isset($flash['inputs']['historique']['Statut']) and $flash['inputs']['historique']['Statut'] === "publié") echo "selected"; ?>>Publié</option>
                                <option value="révision" <?php if(isset($flash['inputs']['historique']['Statut']) and $flash['inputs']['historique']['Statut'] === "révision") echo "selected"; ?>>Révision</option>
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
                            <input required type="number" min="1" step="1" name="themes[0][NoTheme]" id="themes[0][NoTheme]" value="<?php if (isset($flash['inputs']['themes'][0]['NoTheme'])) echo $flash['inputs']['themes'][0]['NoTheme']; ?>"/>
                            <label for="themes[0][NoTheme]">Numéro utilisateur</label>
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
                            <input type="number" min="1" step="1" name="themes[1][NoTheme]" id="themes[1][NoTheme]" value="<?php if (isset($flash['inputs']['themes'][1]['NoTheme'])) echo $flash['inputs']['themes'][1]['NoTheme']; ?>"/>
                            <label for="themes[1][NoTheme]">Numéro utilisateur</label>
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
                            <input type="number" min="1" step="1" name="themes[2][NoTheme]" id="themes[2][NoTheme]" value="<?php if (isset($flash['inputs']['themes'][2]['NoTheme'])) echo $flash['inputs']['themes'][2]['NoTheme']; ?>"/>
                            <label for="themes[2][NoTheme]">Numéro utilisateur</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light amber darken-4">Mémoriser</button>
</form>