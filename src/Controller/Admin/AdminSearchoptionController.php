<?php

namespace App\Controller\Admin;

use App\Entity\Searchoption;
use App\Form\SearchoptionType;
use App\Repository\SearchoptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/option")
 */
class AdminSearchoptionController extends AbstractController
{
    /**
     * @Route("/", name="admin.option.index", methods="GET")
     */
    public function index(SearchoptionRepository $searchoptionRepository) : Response
    {
        return $this->render('admin/searchoption/index.html.twig', ['searchoptions' => $searchoptionRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin.searchoption.new", methods="GET|POST")
     */
    public function new(Request $request) : Response
    {
        $searchoption = new Searchoption();
        $form = $this->createForm(SearchoptionType::class, $searchoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($searchoption);
            $em->flush();

            return $this->redirectToRoute('admin.option.index');
        }

        return $this->render('admin/searchoption/new.html.twig', [
            'searchoption' => $searchoption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="searchoption_show", methods="GET")
     */
    public function show(Searchoption $searchoption) : Response
    {
        return $this->render('admin/searchoption/show.html.twig', ['searchoption' => $searchoption]);
    }

    /**
     * @Route("/{id}/edit", name="admin.searchoption.edit", methods="GET|POST")
     */
    public function edit(Request $request, Searchoption $searchoption) : Response
    {
        $form = $this->createForm(SearchoptionType::class, $searchoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.option.index', ['id' => $searchoption->getId()]);
        }

        return $this->render('admin/searchoption/edit.html.twig', [
            'searchoption' => $searchoption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.searchoption.delete", methods="DELETE")
     */
    public function delete(Request $request, Searchoption $option) : Response
    {
        if ($this->isCsrfTokenValid('admin/delete' . $option->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($option);
            $em->flush();
        }

        return $this->redirectToRoute('admin.option.index');
    }
}
