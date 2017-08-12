<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
	    
	    $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('BlogBundle:Post')->findBy(array(),array('id'=>'DESC'));
//         $role = $this->get('security.context');
		
        
        return $this->render('BlogBundle:Default:index.html.twig',
        	array(
            	'posts' => $posts,
            	)
        );
    }
}
