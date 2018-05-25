<?php

namespace App\Controller\Admin;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Controller used to manage articles in the backend.
 *
 * @Route("/admin/partner", name="admin_partner_")
 * @Security("has_role('ROLE_ADMIN')")
 */
class PartnerController extends Controller
{
    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index(PartnerRepository $partnerRepository): Response
    {
        return $this->render('@admin/partner/index.html.twig', ['partners' => $partnerRepository->findAll()]);
    }

    /**
     * @Route("/new", name="new", methods="GET|POST")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $partner = new Partner();

        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Symfony\Component\HttpFoundation\File\UploadedFile $file
             */
            $file = $partner->getImage();
            $fileName = $fileUploader->upload($file);

            $partner->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            $this->addFlash('success', 'Partenaire ajouté avec succès');

            return $this->redirectToRoute('admin_partner_index');
        }

        return $this->render('@admin/partner/new.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods="GET")
     */
    public function show(Partner $partner): Response
    {
        return $this->render('@admin/partner/show.html.twig', ['partner' => $partner]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods="GET|POST")
     */
    public function edit(Request $request, Partner $partner, FileUploader $fileUploader): Response
    {
        $partner->setImage($partner->getImage());

        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Symfony\Component\HttpFoundation\File\UploadedFile $file
             */
            $file = $partner->getImage();
            $fileName = $fileUploader->upload($file);

            $partner->setImage($fileName);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_partner_edit', ['id' => $partner->getId()]);
        }

        return $this->render('@admin/partner/edit.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods="DELETE")
     */
    public function delete(Request $request, Partner $partner): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partner->getId(), $request->request->get('_token'))) {
            // Remove post image
            $filesystem->remove(['symlink', $fileUploader->getTargetDirectory().$partner->getImage()]);

            $em = $this->getDoctrine()->getManager();
            $em->remove($partner);
            $em->flush();
        }

        return $this->redirectToRoute('admin_partner_index');
    }
}
