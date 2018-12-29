<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/home",name="home")
     */
    public function index(PropertyRepository $repo, ObjectManager $manager, PaginatorInterface $paginator, Request $request)
    {

        $property = $paginator->paginate(
            $repo->findLatest(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );
        return $this->render('home/index.html.twig', [
            'curent_menu' => 'home',
            'biens' => $property,
            'titre' => 'Accueil'
        ]);
    }

}