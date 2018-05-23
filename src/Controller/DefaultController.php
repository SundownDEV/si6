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

use App\Service\TwitterAPI;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

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
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/test", name="index")
     */
    public function test()
    {
        $twitter = new TwitterAPI();

        $t = $twitter->getUserTweets('sundowndev');

        print_r($t[0]);
    }
}
