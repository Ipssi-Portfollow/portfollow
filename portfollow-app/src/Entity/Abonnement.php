<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbonnementRepository::class)
 */
class Abonnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=user::class, inversedBy="followings")
     */
    private $following;

    /**
     * @ORM\Column(type="integer")
     */
    private $follower;


    public function __construct()
    {
        $this->following = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection|user[]
     */
    public function getFollowing(): Collection
    {
        return $this->following;
    }

    public function addFollowing(user $following): self
    {
        if (!$this->following->contains($following)) {
            $this->following[] = $following;
        }

        return $this;
    }

    public function removeFollowing(user $following): self
    {
        $this->following->removeElement($following);

        return $this;
    }

    public function getFollower(): ?int
    {
        return $this->follower;
    }

    public function setFollower(int $follower): self
    {
        $this->follower = $follower;

        return $this;
    }
}
