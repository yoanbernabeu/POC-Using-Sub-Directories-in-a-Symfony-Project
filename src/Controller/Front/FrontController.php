<?php

namespace App\Controller\Front;

use App\Entity\Front\Front;
use App\Form\Front\FrontType;
use App\Repository\Front\FrontRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/front/front")
 */
class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front_front_index", methods={"GET"})
     */
    public function index(FrontRepository $frontRepository): Response
    {
        return $this->render('front/front/index.html.twig', [
            'fronts' => $frontRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="front_front_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $front = new Front();
        $form = $this->createForm(FrontType::class, $front);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($front);
            $entityManager->flush();

            return $this->redirectToRoute('front_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/front/new.html.twig', [
            'front' => $front,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="front_front_show", methods={"GET"})
     */
    public function show(Front $front): Response
    {
        return $this->render('front/front/show.html.twig', [
            'front' => $front,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="front_front_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Front $front): Response
    {
        $form = $this->createForm(FrontType::class, $front);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('front_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/front/edit.html.twig', [
            'front' => $front,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="front_front_delete", methods={"POST"})
     */
    public function delete(Request $request, Front $front): Response
    {
        if ($this->isCsrfTokenValid('delete'.$front->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($front);
            $entityManager->flush();
        }

        return $this->redirectToRoute('front_front_index', [], Response::HTTP_SEE_OTHER);
    }
}
