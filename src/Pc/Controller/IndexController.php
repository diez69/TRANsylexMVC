<?php

namespace App\Pc\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAction(Request $request, Application $app)
    {
        $Pc = $app['repository.Pc']->getAll();

        return $app['twig']->render('Pc.list.html.twig', array('Pc' => $Pc));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.Pc']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('Pc.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $Pc = $app['repository.Pc']->getById($parameters['id']);

        return $app['twig']->render('Pc.form.html.twig', array('Pc' => $Pc));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $Pc = $app['repository.Pc']->update($parameters);
        } else {
            $Pc = $app['repository.Pc']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('Pc.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('Pc.form.html.twig');
    }
}
