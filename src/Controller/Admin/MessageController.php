<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Controller used to manage articles in the backend.
 *
 * @Route("/admin/message", name="admin_message_")
 * @Security("has_role('ROLE_ADMIN')")
 */
class MessageController extends Controller
{
    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index(MessageRepository $messageRepository): Response
    {
        return $this->render('@admin/message/index.html.twig', [
            'messages' => $messageRepository->findAllById()
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods="GET")
     */
    public function show(Message $message): Response
    {
        return $this->render('@admin/message/show.html.twig', ['message' => $message]);
    }

    /**
     * @Route("/{id}", name="delete", methods="DELETE")
     */
    public function delete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush();
        }

        return $this->redirectToRoute('admin_message_index');
    }
}
