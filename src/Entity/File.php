<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="files")
 * @ORM\HasLifecycleCallbacks()
 */
class File
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column(name="url", type="text", nullable=false)
     */
    private string $url;

    /**
     * @var int
     * @ORM\Column(name="size", type="integer", nullable=false)
     */
    private int $size;

    /**
     * @var DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return File
     */
    public function setId(int $id): File
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return File
     */
    public function setName(string $name): File
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return File
     */
    public function setUrl(string $url): File
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return File
     */
    public function setSize(int $size): File
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return File
     */
    public function setCreatedAt(DateTime $createdAt): File
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new DateTime();
    }
}
