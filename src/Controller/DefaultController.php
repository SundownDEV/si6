<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Entity\Post;
use App\Repository\CompanyRepository;
use App\Repository\FicheRepository;
use App\Repository\PartnerRepository;
use App\Repository\PlaceRepository;
use App\Service\TwitterAPI;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Message;
use Symfony\Component\HttpFoundation\Response;
use App\Form\MessageType;
use App\Repository\PostRepository;

/**
 * Class DefaultController.
 *
 * @Route("/", name="default_")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(PostRepository $posts, PartnerRepository $partner, CompanyRepository $company, TwitterAPI $twitterAPI): Response
    {
        return $this->render('default/index.html.twig', [
            'posts' => $posts->findLatest(),
            'tweets' => $twitterAPI->getHomepageTweets($company),
            'partners' => $partner->findAll(),
        ]);
    }

    /**
     * @Route("/places", name="tops")
     */
    public function tops(Request $request, PlaceRepository $place): Response
    {
        if ($type = $request->query->get('type')) {
            $places = $place->findAllByType($type);
        } else {
            $places = $place->findAllByNote();
        }

        return $this->render('default/tops.html.twig', [
            'places' => $places
        ]);
    }

    /**
     * @Route("/fiches", name="fiches")
     */
    public function fiches(FicheRepository $fiche): Response
    {
        return $this->render('default/fiches.html.twig', [
            'cities' => $fiche->findAllCities()
        ]);
    }

    /**
     * @Route("/fiches/{city}", name="fiches_city")
     */
    public function fichesCity(FicheRepository $fiche, $city): Response
    {
        return $this->render('default/fiches_city.html.twig', [
            'city' => $city,
            'fiches' => $fiche->findBy(['city' => $city])
        ]);
    }

    /**
     * @Route("/fiche/{id}", name="fiches_show")
     */
    public function fichesShow(FicheRepository $fiche, $id): Response
    {
        return $this->render('default/fiches_show.html.twig', [
            'fiche' => $fiche->findBy(['id' => $id])
        ]);
    }

    /**
     * @Route("/mooks", name="mooks")
     */
    public function mooks(PostRepository $posts): Response
    {
        return $this->render('default/mooks.html.twig', [
            'posts' => $posts->findLatest()
        ]);
    }

    /**
     * @Route("/contact", name="contact", methods="GET|POST")
     */
    public function contact(Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé');

            return $this->redirectToRoute('default_contact');
        }

        return $this->render('default/contact/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }
}
