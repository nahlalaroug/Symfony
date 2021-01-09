<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="c_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cId;

    /**
     * @var string
     *
     * @ORM\Column(name="c_title", type="text", length=65535, nullable=false)
     */
    private $cTitle;

    public function getCId(): ?int
    {
        return $this->cId;
    }

    public function getCTitle(): ?string
    {
        return $this->cTitle;
    }

    public function setCTitle(string $cTitle): self
    {
        $this->cTitle = $cTitle;

        return $this;
    }


}
