<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\UserController;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ApiResource(
    operations:
    [
        new Post(uriTemplate:'/users',
            controller: UserController::class,
            name:'create_user'),
        new Get(uriTemplate:'/users/{id}',
            controller: UserController::class,
            name:'get_user'),
        new GetCollection(uriTemplate:'/users',
            controller: UserController::class,
            name:'get_users'),
        new Put(uriTemplate:'/users/{id}',
            controller: UserController::class,
            name:'put_user'),
        new Patch(uriTemplate:'/users/{id}',
            controller: UserController::class,
            name:'update_user'),
        new Delete(uriTemplate:'/users/{id}',
            controller: UserController::class,
            name:'delete_user')
    ])]


class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $email = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\Column]
    private ?string $password = null;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
