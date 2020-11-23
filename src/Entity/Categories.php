<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Jobs::class, mappedBy="category")
     */
    private $jobs;

    /**
     * @ORM\ManyToMany(targetEntity=Affilies::class, mappedBy="categories")
     */
    private $affilies;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->affilies = new ArrayCollection();
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

    /**
     * @return Collection|Jobs[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Jobs $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setCategory($this);
        }

        return $this;
    }

    public function removeJob(Jobs $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getCategory() === $this) {
                $job->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Affilies[]
     */
    public function getAffilies(): Collection
    {
        return $this->affilies;
    }

    public function addAffily(Affilies $affily): self
    {
        if (!$this->affilies->contains($affily)) {
            $this->affilies[] = $affily;
            $affily->addCategory($this);
        }

        return $this;
    }

    public function removeAffily(Affilies $affily): self
    {
        if ($this->affilies->removeElement($affily)) {
            $affily->removeCategory($this);
        }

        return $this;
    }
}
