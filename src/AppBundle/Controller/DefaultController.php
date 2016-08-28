<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="common")
     * @Template()
     */
    public function commonAction()
    {
        return new Response('<b>common home</b>.<p>You can try 127.0.0.1:8000, which will only have /a route with common /.' .
            ' OR localhost:8000 which will have both /a and /b routes with common /.</p><div>You can pass <i>client</i>' .
            ' on view context to decide how the view looks. You also can create twig functions like menu() which will' .
            ' render menu according to the features of current <i>client</i>');
    }

    /**
     * @Route("/a", name="a")
     * @Template()
     */
    public function aAction(Request $request)
    {
        return new Response('a action. This can use any view, which will not be available to other routes.');
    }

    /**
     * @Route("/b", name="b")
     * @Template()
     */
    public function bAction(Request $request)
    {
        return new Response('b action. This can use any view, which will not be available to other routes.');
    }
}
