<?php

// src/AppBundle/Controller/SubmitController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SubmitController extends Controller
{
    /**
     *  @Route("/form", name="form")
     */
    public function formAction(Request $request)
    {
        $post = new Post();
        $post->setContent('Write a blog post');
        $post->setAuthor('Your name here');

        $form = $this->createFormBuilder($post)
            ->add('content', TextType::class)
            ->add('author', TextType::class)
            ->add('submit', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $db = $this->getDoctrine()
                    ->getManager();
            $db->persist($post);
            $db->flush();

            return $this->redirectToRoute('post');
        }
        return $this->render('blog/Form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

