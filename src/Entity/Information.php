<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InformationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write", "delete", "update"}},
 *     collectionOperations={
 *         "get",
 *         "post"={
 *             "normalization_context"={
 *                 "groups"={"read"}
 *             }
 *         },
 *     }
 * )
 * @ORM\Entity(repositoryClass=InformationRepository::class)
 * @UniqueEntity(
 *     fields = "name",
 *     message = "Such nickname {{ value }} is already used",
 * )
 */
class Information
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     * @Assert\NotBlank(
     *     message = "The field must not be empty",
     * )
     * @Assert\Length(
     *     min = 3,
     *     max = 100,
     *     minMessage = "The field must be at least {{ limit }} characters long",
     *     maxMessage = "The field cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read", "write"})
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     * @Assert\NotBlank(
     *     message = "The field must not be empty",
     * )
     * @Assert\Regex(
     *     pattern = "/\d+$/",
     *     match = true,
     *     message  = "The field must be  an integer",
     * )
     */
    private $age;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGender(): ?bool
    {
        return $this->gender;
    }

    public function setGender(bool $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
}
