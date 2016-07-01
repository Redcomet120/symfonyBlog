<?php

// src/AppBundle/Controller/DisplayController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Post;

class DisplayController extends Controller
{
    /**
     * @Route("/post")
     */
    public function viewAction()
    {
        $posts = $this->getDoctrine()
                    ->getRepository('AppBundle:Post')
                    ->findAll()
        ;

        $html = $this->render('blog/home.html.twig',
            array('posts'   => $posts
        ));
        return new Response($html);
    }

}

