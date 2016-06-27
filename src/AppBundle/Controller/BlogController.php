<?php

 // src/AppBundle/Controller/BlogController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     *  @Route("/Blog/home")
     */
    // page all posts
    public function homeAction()
    {
        $posts = "Some Blog Post";

        $html = $this->container->get('templating')->render(
            'blog/home.html.twig',
            array('posts' => $posts)
        );
        return new Response(
            //  '<html><body>Post: '.$posts.'</body></html>'
            $html
        );

    }

    /**
     *  @Route("/api/Blog/home")
     */
    //api call to all posts
    public function apiHomeAction()
    {
        $posts = "Some API post";

        return new JsonResponse($posts);
    }
}

