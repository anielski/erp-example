<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 *
 */
class Customer {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;
    /**
     * @ORM\Column(type="string")
     */
    public $name;
    /**
     * @ORM\Column(type="string")
     */
    public $surname;
    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="customer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="customer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct() {
        $this->project = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string {
        return $this->surname;
    }

    public function setSurname(string $surname): self {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProject(): Collection {
        return $this->project;
    }

    public function addProject(Project $project): self {
        if (!$this->project->contains($project)) {
            $this->project[] = $project;
            $project->setCustomer($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self {
        if ($this->project->contains($project)) {
            $this->project->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getCustomer() === $this) {
                $project->setCustomer(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return (string)$this->name;
    }

}

?>