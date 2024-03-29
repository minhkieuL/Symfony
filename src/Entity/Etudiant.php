<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant
{
	
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")

     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
	 *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit comporter au moins 2 caractères",
     *      maxMessage = "Le nom doit comporter au plus 50 caractères"
     *    )
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le prenom doit comporter au moins 2 caractères",
     *      maxMessage = "Le prenom doit comporter au plus 50 caractères"
     *    )
     * @Assert\NotBlank()
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "La ville doit comporter au moins 2 caractères",
     *      maxMessage = "La ville doit comporter au plus 50 caractères"
     *    )
     * @Assert\NotBlank()
     */
    private $ville;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "La rue doit comporter au moins 2 caractères",
     *      maxMessage = "La rue doit comporter au plus 50 caractères"
     *    )
     * @Assert\NotBlank()
     */
    private $rue;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $numrue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $copos;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le surnom doit comporter au moins 2 caractères",
     *      maxMessage = "Le surnom doit comporter au plus 50 caractères"
     *    )
     * @Assert\NotBlank()
     */
    private $surnom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maison", inversedBy="etudiants")
     */
    private $maison;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="etudiant")
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getNumrue(): ?string
    {
        return $this->numrue;
    }

    public function setNumrue(?string $numrue): self
    {
        $this->numrue = $numrue;

        return $this;
    }

    public function getCopos(): ?int
    {
        return $this->copos;
    }

    public function setCopos(?int $copos): self
    {
        $this->copos = $copos;

        return $this;
    }

    public function getSurnom(): ?string
    {
        return $this->surnom;
    }

    public function setSurnom(?string $surnom): self
    {
        $this->surnom = $surnom;

        return $this;
    }

    public function getMaison(): ?Maison
    {
        return $this->maison;
    }

    public function setMaison(?Maison $maison): self
    {
        $this->maison = $maison;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setEtudiant($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getEtudiant() === $this) {
                $note->setEtudiant(null);
            }
        }

        return $this;
    }

}
