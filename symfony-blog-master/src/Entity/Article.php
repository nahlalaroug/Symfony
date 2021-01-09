<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="a_category", columns={"a_category"}), @ORM\Index(name="a_poster", columns={"a_poster"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="a_ID", type="integer", nullable=false)
     * @ORM\Id
     * @Groups("post:read")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="a_date", type="datetime", nullable=false)
     * @Groups("post:read")
     */
    private $aDate;

    /**
     * @var string
     *
     * @ORM\Column(name="a_content", type="text", length=0, nullable=false)
     * @Groups("post:read")
     */
    private $aContent;

    /**
     * @var int
     *
     * @ORM\Column(name="a_likesCpt", type="integer", nullable=false, options={"unsigned"=true})
     * @Groups("post:read")
     */
    private $aLikescpt = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="a_cmtCpt", type="integer", nullable=false, options={"unsigned"=true})
     * @Groups("post:read")
     */
    private $aCmtcpt = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="a_title", type="text", length=65535, nullable=false)
     * @Groups("post:read")
     */
    private $aTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_pic", type="string", length=320, nullable=true)
     * @Groups("post:read")
     */
    private $aPic;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a_poster", referencedColumnName="u_ID")
     * })
     * @Groups("post:read")
     */
    private $aPoster;

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="a_category", referencedColumnName="c_ID")
     * })
     * @Groups("post:read")
     */
    private $aCategory;

    public function getAId(): ?int
    {
        return $this->aId;
    }

    public function getADate(): ?\DateTimeInterface
    {
        return $this->aDate;
    }

    public function getADateString(): string
    {
      return date_format($this->aDate, "Y-m-d\TH:i:s\Z");
    }

    public function setADate(\DateTimeInterface $aDate): self
    {
        $this->aDate = $aDate;

        return $this;
    }

    public function getAContent(): ?string
    {
        return $this->aContent;
    }

    public function setAContent(string $aContent): self
    {
        $this->aContent = $aContent;

        return $this;
    }

    public function getALikescpt(): ?int
    {
        return $this->aLikescpt;
    }

    public function setALikescpt(int $aLikescpt): self
    {
        $this->aLikescpt = $aLikescpt;

        return $this;
    }

    public function getACmtcpt(): ?int
    {
        return $this->aCmtcpt;
    }

    public function setACmtcpt(int $aCmtcpt): self
    {
        $this->aCmtcpt = $aCmtcpt;

        return $this;
    }

    public function getATitle(): ?string
    {
        return $this->aTitle;
    }

    public function setATitle(string $aTitle): self
    {
        $this->aTitle = $aTitle;

        return $this;
    }

    public function getAPic(): ?string
    {
        return $this->aPic;
    }

    public function setAPic(?string $aPic): self
    {
        $this->aPic = $aPic;

        return $this;
    }

    public function getAPoster(): ?Users
    {
        return $this->aPoster;
    }

    public function  getAPosterName(): string
    {
      return $this->aPoster->getUName();
    }

    public function setAPoster(?Users $aPoster): self
    {
        $this->aPoster = $aPoster;

        return $this;
    }

    public function getACategory(): ?Categories
    {
        return $this->aCategory;
    }

    public function getACategoryString(): string
    {
      return $this->aCategory->getCTitle();
    }

    public function setACategory(?Categories $aCategory): self
    {
        $this->aCategory = $aCategory;

        return $this;
    }


}
