<?php

namespace App\Controller;

use App\Entity\Share;
use App\Form\ShareType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ShareController extends AbstractController
{


    /**
     * @Route("/account/add_share", name="add_share")
     */
    public function add_share(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $share = new Share;
        $fileName = null;

        $form = $this->createForm(ShareType::class, $share);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $share->setUser($this->getUser());
            $file = $form['file']->getData();
            $illustration = $form['illustration']->getData();
            
            if($file)
            {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $SafeFileName = $slugger->slug($originalFilename);
                $fileName = $SafeFileName.'-'.uniqid().'.'.$file->guessExtension();

                if (null!== $fileName)
                {
                    $share->setFile($fileName);
                }
                
                try {
                    $file->move($this->getParameter('upload_directory'), $fileName);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    return null; // for example
                }
            }

            if($illustration)
            {
                $originalIllustrationName = pathinfo($illustration->getClientOriginalName(), PATHINFO_FILENAME);
                $SafeIllustrationName = $slugger->slug($originalIllustrationName);
                $illustrationName = $SafeIllustrationName.'-'.uniqid().'.'.$illustration->guessExtension();
                if (null!== $illustrationName)
                {
                    $share->setIllustration($fileName);
                }
                try {
                    $illustration->move($this->getParameter('upload_directory'), $fileName);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    return null; // for example
                }

            }

            $em->persist($share);
            $em->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('account/add_share.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
