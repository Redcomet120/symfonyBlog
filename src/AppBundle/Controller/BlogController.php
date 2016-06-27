<?php

 // src/AppBundle/Controller/BlogController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/*
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 */
use AppBundle\Entity\Post;
//use Symfony\Component\HttpFoundation\Request;



class BlogController extends Controller
{
    /**
     *  @Route("/Blog/home")
     */
    // page all posts
    //    public function homeAction(Request $request)
    public function homeAction()
    {
        $posts = showAction();

   //     $form = formAction();
  //      $form->handleRequest($request);
  //      if ($form->isSubmitted()){
  //          return $this-redirecttoRoute('/Blog/home');
  //      }

        $html = $this->container->get('templating')->render(
            'blog/home.html.twig',
            array('posts' => $posts
//                'form' => $form->createView()
            )
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
//        $posts = "Some API post";
        $posts = this->showAction();
        return new JsonResponse($posts);
    }
/*
    public function formAction()
    {

        $form = $this->createFormBuilder($post)
            ->add('author', TextType::class)
            ->add('content', TextType::class)
            ->add('submit', SubmitType::class, array('label' => 'Submit'))
            ->getForm();
        return($form);
    }
/*
    public function createAction()
    {
        $post = new Post();
        $post->setAuthor('Ted Mosby');
        $post->setContent('Well kids let me tell you the story of how I met your mother');

        $dbadd = $this->getDoctrine()->getManager();
        $dbadd->persist($post);
        $dbadd->flush();

        return new Response('Saved new Post:'.$post->getId());
    }
 */
    public function showAction()
    {

        $repo = $this->getDoctrine()
            ->getRepository('AppBundle:Post');
        $posts = $repo->findAll();

        return($posts);
    }
}

