<?php

namespace App\Controller\Admin;

use App\Entity\Fiche;
use App\Form\FicheType;
use App\Repository\FicheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Service\FileUploader;

/**
 * Controller used to manage articles in the backend.
 *
 * @Route("/admin/fiche", name="admin_fiche_")
 * @Security("has_role('ROLE_ADMIN')")
 */
class FicheController extends Controller
{
    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index(FicheRepository $ficheRepository): Response
    {
        return $this->render('@admin/fiche/index.html.twig', ['fiches' => $ficheRepository->findAll()]);
    }

    /**
     * @Route("/new", name="new", methods="GET|POST")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $fiche = new Fiche();
        $form = $this->createForm(FicheType::class, $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Symfony\Component\HttpFoundation\File\UploadedFile $file
             */
            $file = $fiche->getImage();
            $fileName = $fileUploader->upload($file);

            $fiche->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            $em->flush();

            return $this->redirectToRoute('admin_fiche_index');
        }

        return $this->render('@admin/fiche/new.html.twig', [
            'fiche' => $fiche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods="GET")
     */
    public function show(Fiche $fiche): Response
    {
        return $this->render('@admin/fiche/show.html.twig', ['fiche' => $fiche]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods="GET|POST")
     */
    public function edit(Request $request, Fiche $fiche, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(FicheType::class, $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Symfony\Component\HttpFoundation\File\UploadedFile $file
             */
            $file = $fiche->getImage();
            $fileName = $fileUploader->upload($file);

            $fiche->setImage($fileName);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_fiche_edit', ['id' => $fiche->getId()]);
        }

        return $this->render('@admin/fiche/edit.html.twig', [
            'fiche' => $fiche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods="DELETE")
     */
    public function delete(Request $request, Fiche $fiche): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fiche->getId(), $request->request->get('_token'))) {
            // Remove post image
            $filesystem->remove(['symlink', $fileUploader->getTargetDirectory().$fiche->getImage()]);

            $em = $this->getDoctrine()->getManager();
            $em->remove($fiche);
            $em->flush();
        }

        return $this->redirectToRoute('admin_fiche_index');
    }
}
