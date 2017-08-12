<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Photo controller.
 *
 */
class PhotoController extends Controller
{
    /**
     * Lists all photo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $photos = $em->getRepository('BlogBundle:Photo')->findAll();

        return $this->render('photo/index.html.twig', array(
            'photos' => $photos,
        ));
    }

    /**
     * Creates a new photo entity.
     *
     */
    public function newAction(Request $request)
    {
// 	    $postid = $request->get('postid');
	    
        $photo = new Photo();
        $form = $this->createForm('BlogBundle\Form\PhotoType', $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			
			$post = $this->getDoctrine()
		        ->getRepository('BlogBundle:Post')
		        ->findOneById($postid);//this is bad and we will fix 
	        $photo->setPost($post);
			
	        $file = $photo->getFile();	        
	        
	        $fileName = md5(uniqid()).'.'.$file->guessExtension();
	        
	        $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            );
            
            $dir = $this->getParameter('brochures_directory');
            $thumbDir = $this->getParameter('thumbs_dir');
            $medbDir = $this->getParameter('medThumbs_dir');                        
            
            $gimage = new \GMagick($dir.'/'.$fileName);
            $gimage->scaleimage(1000,0);
            
            $exif = exif_read_data($dir.'/'.$fileName);
            
            
			/* Find orientation of exif in image */             
            if (!empty($exif['Orientation'])) {
				switch ($exif['Orientation']) {
		            case 3:
						$gimage->rotateimage('black', 180.0);
		                break;
		
		            case 6:
						$gimage->rotateimage('black', -90.0);
		                break;
		
		            case 8:
						$gimage->rotateimage('black', 90.0);
		                break;
				}
			}
			

			$gimage->profileimage('*', NULL);
			$gimage->writeimage($dir.'/'.$fileName);            
			$gimage->scaleimage(300,0);
			$gimage->writeimage($medbDir.'/'.$fileName);			
			$gimage->scaleimage(100,0);
			$gimage->writeimage($thumbDir.'/'.$fileName);            			
            $photo->setFile($fileName);
			$dateAdded = new \DateTime();
	        $photo->setDateAdded($dateAdded);
	        
            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();

            return $this->redirectToRoute('photo_show', array('id' => $photo->getId()));
        }

        return $this->render('photo/new.html.twig', array(
            'photo' => $photo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a photo entity.
     *
     */
    public function showAction(Photo $photo)
    {
        $deleteForm = $this->createDeleteForm($photo);

        return $this->render('photo/show.html.twig', array(
            'photo' => $photo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing photo entity.
     *
     */
    public function editAction(Request $request, Photo $photo)
    {
        $deleteForm = $this->createDeleteForm($photo);
        $editForm = $this->createForm('BlogBundle\Form\PhotoType', $photo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('photo_edit', array('id' => $photo->getId()));
        }

        return $this->render('photo/edit.html.twig', array(
            'photo' => $photo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a photo entity.
     *
     */
    public function deleteAction(Request $request, Photo $photo)
    {
        $form = $this->createDeleteForm($photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($photo);
            $em->flush();
        }

        return $this->redirectToRoute('photo_index');
    }

    /**
     * Creates a form to delete a photo entity.
     *
     * @param Photo $photo The photo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Photo $photo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('photo_delete', array('id' => $photo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
