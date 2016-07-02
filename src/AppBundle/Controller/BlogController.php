<?php

// src/AppBundle/Controller/BlogController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BlogController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function viewAction(Request $request)
    {
        //get all the posts from DB
        $blogs = $this->getDoctrine()
                    ->getRepository('AppBundle:Post')
                    ->findAll()
        ;

        //setup the form
        $post = new Post();
        $post->setContent('Write a blog post');
        $post->setAuthor('Your name here');
        $form = $this->createFormBuilder($post)
            ->add('content', TextType::class)
            ->add('author', TextType::class)
            ->add('submit', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        //handle response
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $db = $this->getDoctrine()
                    ->getManager();
            $db->persist($post);
            $db->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('blog/blog.html.twig',
            array('posts'   => $blogs,
                'form'  =>$form->createView()
        ));

        return new Response($html);
    }

}
