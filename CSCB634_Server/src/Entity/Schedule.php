<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $school_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $student_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $teacher_id = null;

    #[ORM\Column(nullable: true)]
    private ?array $monday = null;

    #[ORM\Column(nullable: true)]
    private ?array $tuesday = null;

    #[ORM\Column(nullable: true)]
    private ?array $wednesday = null;

    #[ORM\Column(nullable: true)]
    private ?array $thursday = null;

    #[ORM\Column(nullable: true)]
    private ?array $friday = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStudentId(): ?int
    {
        return $this->student_id;
    }

    public function setStudentId(?int $student_id): static
    {
        $this->student_id = $student_id;

        return $this;
    }

    public function getTeacherId(): ?int
    {
        return $this->teacher_id;
    }

    public function setTeacherId(?int $teacher_id): static
    {
        $this->teacher_id = $teacher_id;

        return $this;
    }

    public function getMonday(): ?array
    {
        return $this->monday;
    }

    public function setMonday(?array $monday): static
    {
        $this->monday = $monday;

        return $this;
    }

    public function getTuesday(): ?array
    {
        return $this->tuesday;
    }

    public function setTuesday(?array $tuesday): static
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getWednesday(): ?array
    {
        return $this->wednesday;
    }

    public function setWednesday(?array $wednesday): static
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getThursday(): ?array
    {
        return $this->thursday;
    }

    public function setThursday(?array $thursday): static
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getFriday(): ?array
    {
        return $this->friday;
    }

    public function setFriday(?array $friday): static
    {
        $this->friday = $friday;

        return $this;
    }
}
