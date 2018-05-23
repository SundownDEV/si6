<?php
/**
 * Created by PhpStorm.
 * User: sundowndev
 * Date: 23/05/18
 * Time: 13:46
 */

namespace App\Controller;
use App\Service\TwitterAPI;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
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

        $t = $twitter->getUserTweets("sundowndev");

        print_r($t[0]);
    }
}