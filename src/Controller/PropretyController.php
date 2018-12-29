<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;


class PropretyController extends AbstractController
{

    /**
     * @Route("/biens",name="proprety.index")
     */
    public function index(PropertyRepository $repo, ObjectManager $manager, PaginatorInterface $paginator, Request $request)
    {        
        //on créer notre formulaire de recherche
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $property = $paginator->paginate(
            $repo->findAllVisibleQuery($search), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );
        return $this->render('property/index.html.twig', [
            'curent_menu' => 'propreties',
            'properties' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show(Property $property, $slug)
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
       // $property=$property->find($id);
        return $this->render('property/show.html.twig', [
            'curent_menu' => 'propreties',
            'property' => $property
        ]);
    }
}