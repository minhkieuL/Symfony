<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Etudiant;
use App\Entity\Maison;
use App\Form\EtudiantType;
use App\Form\EtudiantModifierType;
use Symfony\Component\HttpFoundation\Request;

class EtudiantController extends AbstractController
{
    /*
     * @Route("/etudiant", name="etudiant")
     */
    public function index()
    {
     	/* Cette simple instruction permet d'envoyer des informations au navigateur sans passer par une vue.
        return new Response('<html><body>Salut Les SIO</body></html>');
        */

         // initialise une variable qui sera exploitée dans la vue
         $annee = '2019';
         return $this->render('etudiant/accueil.html.twig', ['pAnnee' => $annee,
        ]);				         
    }
public function ajouterEtudiant(Request $request){
        $etudiant = new etudiant();
	$form = $this->createForm(EtudiantType::class, $etudiant);
	$form->handleRequest($request);

	if ($form->isSubmitted() && $form->isValid()) {

            $etudiant = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();
   
	    return $this->render('etudiant/consulter.html.twig', ['etudiant' => $etudiant,]);
	}
	else
        {
            return $this->render('etudiant/ajouter.html.twig', array('form' => $form->createView(),));
	}
}


public function consulterEtudiant($id){
		
		$etudiant = $this->getDoctrine()
        ->getRepository(Etudiant::class)
        ->find($id);

		if (!$etudiant) {
			throw $this->createNotFoundException(
            'Aucun etudiant trouvé avec le numéro '.$id
			);
		}

		//return new Response('Etudiant : '.$etudiant->getNom());
		return $this->render('etudiant/consulter.html.twig', [
            'etudiant' => $etudiant,]);
	}

/**
	* @Route("/etudiant/{id}", name="etudiant_show")
	*/
public function show(Etudiant $unEtudiant){
		
		return $this->render('etudiant/consulter.html.twig', [
            'etudiant' => $unEtudiant,]);
	}


public function listerEtudiant(){
		$repository = $this->getDoctrine()->getRepository(Etudiant::class);
		$etudiants = $repository->findAll();
		return $this->render('etudiant/lister.html.twig', [
            'pEtudiants' => $etudiants,]);	
		
	}
/**
	* @Route("/etudiant/listerParVille/{ville}", name="listerEtudiantsParVille")
	*/
	public function listerParVille($ville){
		
		$etudiants = $this->getDoctrine()
        ->getRepository(Etudiant::class)
        ->findByVille($ville);
		
		return $this->render('etudiant/lister.html.twig', [
            'pEtudiants' => $etudiants,]);	
		
	}
/**
* @Route("/etudiant/listerParMaison/{idMaison}", name="listerEtudiantsParMaison")
*/
public function listerParMaison($idMaison){
		
		$maison = $this->getDoctrine()
        ->getRepository(Maison::class)
        ->findOneByCode($idMaison);
		
		$etudiants = $this->getDoctrine()
        ->getRepository(Etudiant::class)
        ->findByMaison($maison);
		
		return $this->render('etudiant/lister.html.twig', [
            'pEtudiants' => $etudiants,]);	
		
	}
/**
	* @Route("/etudiant/consulterParNomPrenom/{nom}/{prenom}", name="consulterEtudiantParNomPrenom")
	*/
	public function consulterParNomPrenom($nom,$prenom){
		$repository = $this->getDoctrine()->getRepository(Etudiant::class);
		$etudiant = $repository->findOneBy(
			['nom' => $nom,'prenom' => $prenom ]
		);
		
		return $this->render('etudiant/consulter.html.twig', [
            'etudiant' => $etudiant,]);
        
	}

public function modifierEtudiant($id, Request $request){

    //récupération de l'étudiant dont l'id est passé en paramètre
    $etudiant = $this->getDoctrine()
        ->getRepository(Etudiant::class)
        ->find($id);

	if (!$etudiant) {
	    throw $this->createNotFoundException('Aucun etudiant trouvé avec le numéro '.$id);
	}
	else
	{
            $form = $this->createForm(EtudiantModifierType::class, $etudiant);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                 $etudiant = $form->getData();
                 $entityManager = $this->getDoctrine()->getManager();
                 $entityManager->persist($etudiant);
                 $entityManager->flush();
                 return $this->render('etudiant/consulter.html.twig', ['etudiant' => $etudiant,]);
           }
           else{
                return $this->render('etudiant/ajouter.html.twig', array('form' => $form->createView(),));
           }
        }
 }
 
 /**
	* @Route("/etudiant/consulterEtudiantsDateNaissSuperieur/{dateNaiss}", name="consulterEtudiantsDateNaissSuperieur")
	*/
	public function consulterEtudiantsDateNaissSuperieur($dateNaiss){
		$etudiants = $this->getDoctrine()
		->getRepository(Etudiant::class)
		->consulterEtudiantParDateNaissSup($dateNaiss);
		
		return $this->render('etudiant/lister.html.twig', [
            'pEtudiants' => $etudiants,]);	

	}
	
}