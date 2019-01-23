<?php

namespace App\Controller\Admin;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Picture;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/admin/picture")
 */
class AdminPictureController extends AbstractController
{
    /**
     * @Route("/{id}", name="admin.picture.delete", methods="DELETE")
     */
    public function delete(Picture $picture, Request $request)
    {
        $propertyId = $picture->getProperty()->getId();
        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($picture);
            $em->flush();
            return new JsonResponse(['success' => 1]);
        }
        return new JsonResponse(['error' => 'Token invalid'], 400);
    }

}