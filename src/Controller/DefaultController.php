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
    public function index(PostRepository $posts, CompanyRepository $company, TwitterAPI $twitterAPI): Response
    {
        $companies = $company->findAll();
        $tweets = [];

        foreach ($companies as $company) {
            if (count($tweets) < 3 && !is_null($tweet = $twitterAPI->getUserLastTweet($company->getTwitter()))) {
                $tweets[] = $tweet;
            }
        }

        return $this->render('default/index.html.twig', [
            'posts' => $posts->findLatest(),
            'tweets' => $tweets,
        ]);
    }

    /**
     * @Route("/places", name="tops")
     */
    public function tops(PostRepository $posts): Response
    {
        return $this->render('default/tops.html.twig', [
            'posts' => $posts->findLatest()
        ]);
    }

    /**
     * @Route("/fiches", name="fiches")
     */
    public function fiches(PostRepository $posts): Response
    {
        return $this->render('default/fiches.html.twig', [
            'posts' => $posts->findLatest()
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

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        $twitter = new TwitterAPI();

        $t = $twitter->getUserTweets('sundowndev');

        print_r($t[0]);
    }
}
