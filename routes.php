<?php 

/* --- Routes --- */

/* --- Page d'accueil --- */
dispatch('/', function() {
  return render('home.html.php');
});

/* --- Utilisateurs --- */
dispatch_get('/utilisateur', 'UtilisateurCtrl::index');
dispatch_get('/utilisateur/create', 'UtilisateurCtrl::create');
dispatch_post('/utilisateur', 'UtilisateurCtrl::store');

/* --- Médias --- */
dispatch_get('/media', 'MediaCtrl::index');
dispatch_get('/media/create', 'MediaCtrl::create');
dispatch_post('/media', 'MediaCtrl::store');

/* --- Post --- */
dispatch_get('/post', 'PostCtrl::index');
dispatch_get('/post/create', 'PostCtrl::create');
dispatch_post('/post', 'PostCtrl::store');

/* --- Message direct --- */
dispatch_get('/messagedirect', 'MessageDirectCtrl::index');
dispatch_get('/messagedirect/create', 'MessageDirectCtrl::create');
dispatch_post('/messagedirect', 'MessageDirectCtrl::store');

/* --- Articles --- */
dispatch_get('/article', 'ArticleCtrl::index');
dispatch_get('/article/create', 'ArticleCtrl::create');
dispatch_post('/article', 'ArticleCtrl::store');

/* --- Groupe --- */
dispatch_get('/groupe', 'GroupeCtrl::index');
dispatch_get('/groupe/create', 'GroupeCtrl::create');
dispatch_post('/groupe', 'GroupeCtrl::store');

/* --- Suivis --- */
dispatch_get('/suivi', 'SuiviCtrl::index');
dispatch_get('/suivi/create', 'SuiviCtrl::create');
dispatch_post('/suivi', 'SuiviCtrl::store');

/* --- Membres --- */
dispatch_get('/membre', 'MembreCtrl::index');
dispatch_get('/membre/create', 'MembreCtrl::create');
dispatch_post('/membre', 'MembreCtrl::store');
