<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Maison;

class MaisonController extends AbstractController
{
    /**
     * @Route("/maison", name="maison")
     */
    public function index()
    {
        return $this->render('maison/index.html.twig', [
            'controller_name' => 'MaisonController',
        ]);
    }
public function ajouterMaison(){
		
	// récupère le manager d'entités
        $entityManager = $this->getDoctrine()->getManager();

        // instanciation d'un objet Maison
        $maison = new Maison();
        $maison->setCode('SPT');
        $maison->setlibelle('Griffondor');

        // Indique à Doctrine de persister l'objet
        $entityManager->persist($maison);

        // Exécue l'instruction sql permettant de persister lobjet, ici un INSERT INTO
        $entityManager->flush();

        // renvoie vers la vue de consultation de l'étudiant en passant l'objet maison en paramètre
       return $this->render('maison/consulter.html.twig', [
            'maison' => $maison,]);
		
	}

public function listerMaison(){
		$repository = $this->getDoctrine()->getRepository(Maison::class);
		$maisons = $repository->findAll();
		return $this->render('maison/lister.html.twig', [
            'pMaisons' => $maisons,]);	
		
	}

	public function consulterMaison($code){
		$repository = $this->getDoctrine()->getRepository(Maison::class);
		
		$maison = $repository->findOneByCode($code);
		return $this->render('maison/consulter.html.twig', [
            'pMaison' => $maison,]);			
	}	
}
