<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity(
 * fields={"uMail"},
 * message="L'email est déjà utilisé."
 * )
 */
class Users implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="u_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="u_name", type="string", length=255, nullable=true)
     */
    private $uName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="u_pp", type="string", length=255, nullable=true)
     */
    private $uPp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="u_desc", type="text", length=65535, nullable=true)
     */
    private $uDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="u_mail", type="string", length=320, nullable=false)
     * @Assert\Email()
     */
    private $uMail;

    /**
     * @var string
     *
     * @ORM\Column(name="u_pass", type="string", length=32, nullable=false, options={"fixed"=true})
     * @Assert\Length(min=4, minMessage="Votre mot de passe doit contenir 4 caractères")
     */
    private $uPass;

    /**
     * @Assert\EqualTo(propertyPath="uPass",  message="Les mots de passes sont différents")
     */
    public $confirm_uPass;

    public function getUId(): ?int
    {
        return $this->uId;
    }

    public function getUName(): ?string
    {
        return $this->uName;
    }

    public function getUsername(): ?string
    {
        return $this->uName;
    }

    public function setUName(?string $uName): self
    {
        $this->uName = $uName;

        return $this;
    }

    public function getUPp(): ?string
    {
        return $this->uPp;
    }

    public function setUPp(?string $uPp): self
    {
        $this->uPp = $uPp;

        return $this;
    }

    public function getUDesc(): ?string
    {
        return $this->uDesc;
    }

    public function setUDesc(?string $uDesc): self
    {
        $this->uDesc = $uDesc;

        return $this;
    }

    public function getUMail(): ?string
    {
        return $this->uMail;
    }

    public function setUMail(string $uMail): self
    {
        $this->uMail = $uMail;

        return $this;
    }

    public function getUPass(): ?string
    {
        return $this->uPass;
    }

    public function getPassword(): ?string
    {
        return $this->uPass;
    }

    public function setUPass(string $uPass): self
    {
        $this->uPass = $uPass;

        return $this;
    }

    public function eraseCredentials()
    {
    
    }

    public function getSalt()
    {

    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }


}
