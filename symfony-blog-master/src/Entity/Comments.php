<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments", indexes={@ORM\Index(name="co_artRef", columns={"co_artRef"}), @ORM\Index(name="co_PostedBy", columns={"co_PostedBy"})})
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @var int
     *
     * @ORM\Column(name="co_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $coId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="co_postedAt", type="datetime", nullable=false)
     */
    private $coPostedat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="co_content", type="text", length=65535, nullable=true)
     */
    private $coContent;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="co_PostedBy", referencedColumnName="u_ID")
     * })
     */
    private $coPostedby;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="co_artRef", referencedColumnName="a_ID")
     * })
     */
    private $coArtref;

    public function getCoId(): ?int
    {
        return $this->coId;
    }

    public function getCoPostedat(): ?\DateTimeInterface
    {
        return $this->coPostedat;
    }

    public function setCoPostedat(\DateTimeInterface $coPostedat): self
    {
        $this->coPostedat = $coPostedat;

        return $this;
    }

    public function getCoContent(): ?string
    {
        return $this->coContent;
    }

    public function setCoContent(?string $coContent): self
    {
        $this->coContent = $coContent;

        return $this;
    }

    public function getCoPostedby(): ?Users
    {
        return $this->coPostedby;
    }

    public function setCoPostedby(?Users $coPostedby): self
    {
        $this->coPostedby = $coPostedby;

        return $this;
    }

    public function getCoArtref(): ?Article
    {
        return $this->coArtref;
    }

    public function setCoArtref(?Article $coArtref): self
    {
        $this->coArtref = $coArtref;

        return $this;
    }


}
