<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    /**
     * @Route("/note", name="note")
     */
    public function index()
    {
        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }
	public function modifierNote($id){
		
		//récupération de l'étudiant dont l'id est passé en paramètre
		$note = $this->getDoctrine()
        ->getRepository(Note::class)
        ->find($id);

		if (!$note) {
			throw $this->createNotFoundException(
            'Aucun note trouvé avec le numéro '.$id
			);
		}
		else
		{


		// récupération de l'étudiant des griffondor à partir du code de l'étudiant
		$etudiant = $this->getDoctrine()
        ->getRepository(Etudiant::class)
        ->findOneByCode('GFD');

		if (!$etudiant) {
			throw $this->createNotFoundException(
            'Aucune etudiant trouvé avec ce nom'
			);
		}
		else
		{

		//Affectation de la etudiant à l'étudiant
		$note->setEtudiant($etudiant);

		// persistence de l'objet modifié
                $entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($note);
		$entityManager->flush();



		//return new Response('Note : '.$note->getNom());
		return $this->render('note/consulter.html.twig', [
            'note' => $note,]);
        }
        }
	}
}
