<?php

namespace App\Controller;

use App\Entity\Poll;
use App\Form\PollType;
use App\Repository\PollRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PollController extends AbstractController
{
    #[Route('/poll/new', name: 'poll_new')]
    public function new(Request $request, PollRepository $repository, SluggerInterface $slugger): Response
    {
        $poll = new Poll();
        $form = $this->createForm(PollType::class, $poll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $poll->setSlug(strtolower($slugger->slug(uniqid('poll_'))));
            $repository->save($poll, true);

            return $this->redirectToRoute('poll_show', ['slug' => $poll->getSlug()]);
        }

        return $this->render('poll/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/poll/{slug}', name: 'poll_show')]
    public function show(Poll $poll): Response
    {
        return $this->render('poll/show.html.twig', [
            'poll' => $poll,
        ]);
    }
}
