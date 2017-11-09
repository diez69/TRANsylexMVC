<?php

namespace App\Association\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAction(Request $request, Application $app)
    {
        $Association = $app['repository.Association']->getAll();

        return $app['twig']->render('Association.list.html.twig', array('Association' => $Association));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.Association']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('Association.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $association = $app['repository.Association']->getById($parameters['id']);

        return $app['twig']->render('Association.form.html.twig', array('Association' => $association));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $association = $app['repository.Association']->update($parameters);
        } else {
            $association = $app['repository.Association']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('association.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('Association.form.html.twig');
    }
}
