<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Image;
use App\Entity\Video;
use App\Form\AddTrickForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
final class NewTrickController extends AbstractController
{
    #[Route('/new/trick', name: 'app_new_trick')]
    public function index(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $trick = new Trick();
        $trick->setAuthor($this->getUser());
        $trick->setCreatedAt(new \DateTimeImmutable());
        $trick->setUpdatedAt(new \DateTimeImmutable());
        
        $form = $this->createForm(AddTrickForm::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $slug = $slugger->slug(strtolower($trick->getTitle()))->toString();
            
  
            $existingTrickTitle = $em->getRepository(Trick::class)->findOneBy(['title' => $trick->getTitle()]);
            $existingTrickSlug = $em->getRepository(Trick::class)->findOneBy(['slug' => $slug]);
            
            if ($existingTrickTitle || $existingTrickSlug) {
                $this->addFlash('error', 'Un trick avec ce nom existe déjà');
                return $this->redirectToRoute('app_new_trick');
            }
            
           
            $trick->setSlug($slug);
            
    
            $imageFiles = $form->get('images')->getData();
            if ($imageFiles) {
                $trickImagesDir = $this->getParameter('tricks_images_directory');
                
                foreach ($imageFiles as $imageFile) {
                    $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                    
                    try {
                        $imageFile->move($trickImagesDir, $newFilename);
                        
                        $image = new Image();
                        $image->setFilename($newFilename);
                        $image->setAltText($trick->getTitle());
                        $image->setTrick($trick);
                        $em->persist($image);
                    } catch (\Exception $e) {
                        $this->addFlash('error', 'Erreur lors du téléchargement d\'une image');
                    }
                }
            }
            
      
            $videoUrl = $form->get('videoUrl')->getData();
            if ($videoUrl) {
                $video = new Video();
                $video->setUrl($videoUrl);
                $video->setTrick($trick);
                $em->persist($video);
            }
            
            $em->persist($trick);
            $em->flush();
            
            $this->addFlash('success', 'Le trick a été ajouté avec succès!');
            return $this->redirectToRoute('app_trick_show', ['slug' => $trick->getSlug()]);
        }
        
        return $this->render('new_trick/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

