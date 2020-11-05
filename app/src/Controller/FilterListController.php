<?php

namespace App\Controller;

use App\Entity\FilterList;
use App\Form\FilterListType;
use App\Repository\FilterListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/filter")
 */
class FilterListController extends AbstractController
{
    /**
     * @Route("/", name="filter_list_index", methods={"GET"})
     */
    public function index(FilterListRepository $filterListRepository): Response
    {
        return $this->render('filter_list/index.html.twig', [
            'filter_lists' => $filterListRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="filter_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $filterList = new FilterList();
        $form = $this->createForm(FilterListType::class, $filterList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($filterList);
            $entityManager->flush();

            return $this->redirectToRoute('filter_list_index');
        }

        return $this->render('filter_list/new.html.twig', [
            'filter_list' => $filterList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filter_list_show", methods={"GET"})
     */
    public function show(FilterList $filterList): Response
    {
        return $this->render('filter_list/show.html.twig', [
            'filter_list' => $filterList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="filter_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FilterList $filterList): Response
    {
        $form = $this->createForm(FilterListType::class, $filterList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('filter_list_index');
        }

        return $this->render('filter_list/edit.html.twig', [
            'filter_list' => $filterList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filter_list_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FilterList $filterList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filterList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($filterList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('filter_list_index');
    }
}
