<?php

namespace App\Entity;

use App\Repository\TeachersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeachersRepository::class)]
class Teachers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::JSON)]
    private array $qualification_ids = [];

    #[ORM\Column]
    private ?int $school_id = null;

    #[ORM\Column(type: Types::JSON)]
    private array $grade_ids = [];

    #[ORM\Column(type: Types::JSON)]
    private array $subject_ids = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getQualificationIds(): array
    {
        return $this->qualification_ids;
    }

    public function setQualificationIds(array $qualification_ids): static
    {
        $this->qualification_ids = $qualification_ids;

        return $this;
    }

    public function getSchoolId(): ?int
    {
        return $this->school_id;
    }

    public function setSchoolId(int $school_id): static
    {
        $this->school_id = $school_id;

        return $this;
    }

    public function getGradeIds(): array
    {
        return $this->grade_ids;
    }

    public function setGradeIds(array $grade_ids): static
    {
        $this->grade_ids = $grade_ids;

        return $this;
    }

    public function getSubjectIds(): array
    {
        return $this->subject_ids;
    }

    public function setSubjectIds(array $subject_ids): static
    {
        $this->subject_ids = $subject_ids;

        return $this;
    }
}
