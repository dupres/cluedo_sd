<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_USER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Un compte existe déjà avec cette adresse e-mail.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message: 'Merci de saisir un nom d\'utilisateur.')]
    #[Assert\Length(min: 2, max: 50, minMessage: 'Le nom d\'utilisateur doit contenir au moins {{ limit }} caractères.', maxMessage: 'Le nom d\'utilisateur ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $username = null;

    #[ORM\Column(length: 50)]
    private ?string $language = null;

    #[ORM\Column(length: 180)]
    private ?string $password = null;
 
    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message: 'Merci de saisir une adresse e-mail.')]
    #[Assert\Email(message: 'L\'adresse e-mail n\'est pas valide.')]
    private ?string $email = null;

    /**
     * Rôles supplémentaires stockés en base (JSON). ROLE_USER est ajouté automatiquement.
     *
     * @var list<string>
     */
    #[ORM\Column]
    private array $roles = [];

    /* Constructeur */
    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->language = 'fr';
    }

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Identifiant utilisé par Symfony pour reconnaître l'utilisateur (ici l'e-mail).
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // Tout utilisateur connecté a au minimum ROLE_USER.
        $roles[] = 'ROLE_USER';

        return array_values(array_unique($roles));
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Méthode imposée par UserInterface, dépréciée depuis Symfony 7.3 et vide ici :
     * on ne stocke aucune donnée sensible temporaire sur l'objet.
     */
    #[\Deprecated]
    public function eraseCredentials(): void
    {
    }


}
