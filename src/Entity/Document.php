<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameAuto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $job;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateLimit;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateIssue;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $softDelete;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cumulativeHour;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $amount;

    /**
     * @ORM\ManyToMany(targetEntity=Folder::class, mappedBy="documents")
     */
    private $folders;

    /**
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="documentLinked")
     */
    private $document;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="document")
     */
    private $documentLinked;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="documents")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class)
     */
    private $companyAddress;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="documents")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class)
     */
    private $personAddress;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity=File::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $file;

    public function __construct()
    {
        $this->folders = new ArrayCollection();
        $this->documentLinked = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNameAuto(): ?string
    {
        return $this->nameAuto;
    }

    public function setNameAuto(?string $nameAuto): self
    {
        $this->nameAuto = $nameAuto;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getDateLimit(): ?\DateTimeInterface
    {
        return $this->dateLimit;
    }

    public function setDateLimit(?\DateTimeInterface $dateLimit): self
    {
        $this->dateLimit = $dateLimit;

        return $this;
    }

    public function getDateIssue(): ?\DateTimeInterface
    {
        return $this->dateIssue;
    }

    public function setDateIssue(?\DateTimeInterface $dateIssue): self
    {
        $this->dateIssue = $dateIssue;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getSoftDelete(): ?bool
    {
        return $this->softDelete;
    }

    public function setSoftDelete(?bool $softDelete): self
    {
        $this->softDelete = $softDelete;

        return $this;
    }

    public function getCumulativeHour(): ?float
    {
        return $this->cumulativeHour;
    }

    public function setCumulativeHour(?float $cumulativeHour): self
    {
        $this->cumulativeHour = $cumulativeHour;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return Collection|Folder[]
     */
    public function getFolders(): Collection
    {
        return $this->folders;
    }

    public function addFolder(Folder $folder): self
    {
        if (!$this->folders->contains($folder)) {
            $this->folders[] = $folder;
            $folder->addDocument($this);
        }

        return $this;
    }

    public function removeFolder(Folder $folder): self
    {
        if ($this->folders->removeElement($folder)) {
            $folder->removeDocument($this);
        }

        return $this;
    }

    public function getDocument(): ?self
    {
        return $this->document;
    }

    public function setDocument(?self $document): self
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getDocumentLinked(): Collection
    {
        return $this->documentLinked;
    }

    public function addDocumentLinked(self $documentLinked): self
    {
        if (!$this->documentLinked->contains($documentLinked)) {
            $this->documentLinked[] = $documentLinked;
            $documentLinked->setDocument($this);
        }

        return $this;
    }

    public function removeDocumentLinked(self $documentLinked): self
    {
        if ($this->documentLinked->removeElement($documentLinked)) {
            // set the owning side to null (unless already changed)
            if ($documentLinked->getDocument() === $this) {
                $documentLinked->setDocument(null);
            }
        }

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCompanyAddress(): ?Address
    {
        return $this->companyAddress;
    }

    public function setCompanyAddress(?Address $companyAddress): self
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getPersonAddress(): ?Address
    {
        return $this->personAddress;
    }

    public function setPersonAddress(?Address $personAddress): self
    {
        $this->personAddress = $personAddress;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(File $file): self
    {
        $this->file = $file;

        return $this;
    }
}
