<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Competences;

class CompetencesController extends AbstractController
{
    /**
     * @Route("/competences", name="competences")
     */
    public function index()
    {
        return $this->render('competences/index.html.twig', [
            'controller_name' => 'CompetencesController',
        ]);
    }
public function ajouterCompetences(){
		
	// récupère le manager d'entités
        $entityManager = $this->getDoctrine()->getManager();

        // instanciation d'un objet Competences
        $competences = new Competences();
        $competences->setCode('POT');
        $competences->setLibelle('Potiens');
		$competences->setNbEtudiantsMax('12');

        // Indique à Doctrine de persister l'objet
        $entityManager->persist($competences);

        // Exécue l'instruction sql permettant de persister lobjet, ici un INSERT INTO
        $entityManager->flush();

        // renvoie vers la vue de consultation de l'étudiant en passant l'objet competences en paramètre
       return $this->render('competences/consulter.html.twig', [
            'competences' => $competences,]);
		
	}

public function consulterCompetences($id){
		
		$competences = $this->getDoctrine()
        ->getRepository(Competences::class)
        ->find($id);

		if (!$competences) {
			throw $this->createNotFoundException(
            'Aucun competences trouvé avec le numéro '.$id
			);
		}

		//return new Response('Competences : '.$competences->getNom());
		return $this->render('competences/consulter.html.twig', [
            'competences' => $competences,]);
	}

public function listerCompetences(){
		$repository = $this->getDoctrine()->getRepository(Competences::class);
		$competencess = $repository->findAll();
		return $this->render('competences/lister.html.twig', [
            'pCompetencess' => $competencess,]);	
		
	}
	
}
