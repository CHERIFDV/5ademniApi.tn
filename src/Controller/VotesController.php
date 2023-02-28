<?php

namespace App\Controller;

use App\Entity\Votes;
use App\Form\VotesType;
use App\Repository\VotesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/votes")
 */
class VotesController extends AbstractController
{
    /**
     * @Route("/", name="app_votes_index", methods={"GET"})
     */
    public function index(VotesRepository $votesRepository): Response
    {
        return $this->render('votes/index.html.twig', [
            'votes' => $votesRepository->findAll(),
        ]);
    }

     /**
     * @Route("/getall", name="app_votes_getall", methods={"GET"})
     */
    public function getall(VotesRepository $votesRepository,SerializerInterface $serializer): JsonResponse
    {
       
      $votes=$votesRepository->findAll();
     
      $jsonBookList = $serializer->serialize($votes, 'json');
      return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true); 
        
    }





    /**
     * @Route("/new", name="app_votes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VotesRepository $votesRepository): Response
    {
        $vote = new Votes();
        $form = $this->createForm(VotesType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $votesRepository->add($vote, true);

            return $this->redirectToRoute('app_votes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('votes/new.html.twig', [
            'vote' => $vote,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_votes_show", methods={"GET"})
     */
    public function show(Votes $vote): Response
    {
        return $this->render('votes/show.html.twig', [
            'vote' => $vote,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_votes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Votes $vote, VotesRepository $votesRepository): Response
    {
        $form = $this->createForm(VotesType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $votesRepository->add($vote, true);

            return $this->redirectToRoute('app_votes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('votes/edit.html.twig', [
            'vote' => $vote,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_votes_delete", methods={"POST"})
     */
    public function delete(Request $request, Votes $vote, VotesRepository $votesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vote->getId(), $request->request->get('_token'))) {
            $votesRepository->remove($vote, true);
        }

        return $this->redirectToRoute('app_votes_index', [], Response::HTTP_SEE_OTHER);
    }
}
