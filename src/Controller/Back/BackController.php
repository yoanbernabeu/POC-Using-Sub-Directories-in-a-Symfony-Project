<?php

namespace App\Controller\Back;

use App\Entity\Back\Back;
use App\Form\Back\BackType;
use App\Repository\Back\BackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/back")
 */
class BackController extends AbstractController
{
    /**
     * @Route("/", name="back_back_index", methods={"GET"})
     */
    public function index(BackRepository $backRepository): Response
    {
        return $this->render('back/back/index.html.twig', [
            'backs' => $backRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="back_back_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $back = new Back();
        $form = $this->createForm(BackType::class, $back);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($back);
            $entityManager->flush();

            return $this->redirectToRoute('back_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/back/new.html.twig', [
            'back' => $back,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="back_back_show", methods={"GET"})
     */
    public function show(Back $back): Response
    {
        return $this->render('back/back/show.html.twig', [
            'back' => $back,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="back_back_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Back $back): Response
    {
        $form = $this->createForm(BackType::class, $back);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/back/edit.html.twig', [
            'back' => $back,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="back_back_delete", methods={"POST"})
     */
    public function delete(Request $request, Back $back): Response
    {
        if ($this->isCsrfTokenValid('delete'.$back->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($back);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
