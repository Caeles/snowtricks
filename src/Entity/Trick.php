<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
#[ORM\Table(name: "trick")]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;
    
    #[ORM\Column(length: 255)]
    private ?string $slug = null;
    
    #[ORM\Column(type: "text")]
    private ?string $description = null;
    
    #[ORM\Column(name: "createdAt", type: "datetime")]
    private ?\DateTimeInterface $createdAt = null;
    
    #[ORM\Column(name: "updatedAt", type: "datetime")]
    private ?\DateTimeInterface $updatedAt = null;
    
    #[ORM\ManyToOne(targetEntity: "App\Entity\User", inversedBy: "tricks")]
    #[ORM\JoinColumn(name: "author_id", referencedColumnName: "id")]
    private ?User $author = null;
    
    #[ORM\ManyToOne(targetEntity: "App\Entity\Category", inversedBy: "tricks")]
    #[ORM\JoinColumn(name: "category_id", referencedColumnName: "id")]
    private ?Category $category = null;
    
    #[ORM\OneToMany(mappedBy: "trick", targetEntity: "App\Entity\Image", orphanRemoval: true)]
    private Collection $images;
    
    #[ORM\OneToMany(mappedBy: "trick", targetEntity: "App\Entity\Video", orphanRemoval: true)]
    private Collection $videos;
    
    #[ORM\OneToMany(mappedBy: "trick", targetEntity: "App\Entity\Comment", orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setTrick($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            if ($image->getTrick() === $this) {
                $image->setTrick(null);
            }
        }

        return $this;
    }
    
   
    public function getImageFilename(): ?string
    {
        if ($this->images->isEmpty()) {
            return null;
        }
        
        return $this->images->first()->getFilename();
    }
    
    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setTrick($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            if ($video->getTrick() === $this) {
                $video->setTrick(null);
            }
        }

        return $this;
    }
    
    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setTrick($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
           
            if ($comment->getTrick() === $this) {
                $comment->setTrick(null);
            }
        }

        return $this;
    }
    
   
}
