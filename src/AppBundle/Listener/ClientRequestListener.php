<?php

namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ClientRequestListener
{
    const ROUTE_KEY = 'routes';

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $route = $request->attributes->get('_route');

        // check if allow
        if (!in_array($route, $this->getClientFeatures($request->getHttpHost())[self::ROUTE_KEY]))
        {
            throw new NotFoundHttpException();
        }
    }

    protected function getClientFeatures($host)
    {
        $routes = ['common'];

        switch ($host) {
            case '127.0.0.1:8000':
                $routes = array_merge($routes, ['a']);
                break;
            case 'localhost:8000':
                $routes = array_merge($routes, ['a', 'b']);
                break;
            default:
                break;
        }

        return [
            self::ROUTE_KEY => $routes
        ];
    }
}
