<?php
/**
 * Created by PhpStorm.
 * User: sundowndev
 * Date: 22/05/18
 * Time: 13:24
 */

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Controller used to manage contents in the backend.
 *
 * @Route("/admin", name="admin_")
 * @Security("has_role('ROLE_ADMIN')")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('@admin/index.html.twig');
    }
}