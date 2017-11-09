<?php
$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');
$app->get('/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->get('/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->post('/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');

$app->get('/Pc/list', 'App\Pc\Controller\IndexController::listAction')->bind('Pc.list');
$app->get('/Pc/edit/{id}', 'App\Pc\Controller\IndexController::editAction')->bind('Pc.edit');
$app->get('/Pc/new', 'App\Pc\Controller\IndexController::newAction')->bind('Pc.new');
$app->post('/Pc/delete/{id}', 'App\Pc\Controller\IndexController::deleteAction')->bind('Pc.delete');
$app->post('/Pc/save', 'App\Pc\Controller\IndexController::saveAction')->bind('Pc.save');

$app->get('/association/list', 'App\Association\Controller\IndexController::listAction')->bind('association.list');
$app->get('/association/edit/{id}', 'App\Association\Controller\IndexController::editAction')->bind('association.edit');
$app->get('/association/new', 'App\Association\Controller\IndexController::newAction')->bind('association.new');
$app->post('/association/delete/{id}', 'App\Association\Controller\IndexController::deleteAction')->bind('association.delete');
$app->post('/association/save', 'App\Association\Controller\IndexController::saveAction')->bind('association.save');