<?php 

/* --- Routes --- */
dispatch('/', 'ArticlePublicitaireOrchestrateur::index');
dispatch_get('/test/:name/:value', 'ArticlePublicitaireOrchestrateur::show');
dispatch_get('/form_test', 'ArticlePublicitaireOrchestrateur::showForm');
dispatch_post('/form_test', 'ArticlePublicitaireOrchestrateur::analyze');