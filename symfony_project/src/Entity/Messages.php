<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'messages', targetEntity: User::class)]
    private Collection $User;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?Chat $Chat = null;

    public function __construct()
    {
        $this->User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(User $user): self
    {
        if (!$this->User->contains($user)) {
            $this->User->add($user);
            $user->setMessages($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->User->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getMessages() === $this) {
                $user->setMessages(null);
            }
        }

        return $this;
    }

    public function setUser(?User $user): self
    {
        $this->User = $user;

        return $this;
    }

    public function getChat(): ?Chat
    {
        return $this->Chat;
    }

    public function setChat(?Chat $Chat): self
    {
        $this->Chat = $Chat;

        return $this;
    }
}
