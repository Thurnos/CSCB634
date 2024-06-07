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

    #[ORM\Column(type: Types::ARRAY)]
    private array $qualification_ids = [];

    #[ORM\Column]
    private ?int $school_id = null;

    #[ORM\Column]
    private ?int $grade_id = null;

    #[ORM\Column]
    private ?int $subject_id = null;

    #[ORM\Column(length: 255)]
    private ?string $subjects_list = null;

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

    public function getGradeId(): ?int
    {
        return $this->grade_id;
    }

    public function setGradeId(int $grade_id): static
    {
        $this->grade_id = $grade_id;

        return $this;
    }

    public function getSubjectId(): ?int
    {
        return $this->subject_id;
    }

    public function setSubjectId(int $subject_id): static
    {
        $this->subject_id = $subject_id;

        return $this;
    }

    public function getSubjectsList(): ?string
    {
        return $this->subjects_list;
    }

    public function setSubjectsList(string $subjects_list): static
    {
        $this->subjects_list = $subjects_list;

        return $this;
    }
}
