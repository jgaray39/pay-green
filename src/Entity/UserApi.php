<?php

namespace App\Entity;

use App\Repository\UserApiRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserApiRepository::class)
 */
class UserApi implements UserInterface, JsonSerializable
{
    public function __construct(){
        $this->salt = "bciazhcvheravharhczckhvefjy";
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "Mauvais format pour cet email : '{{ value }}' ."
     * )
     */
    private $username;

    /**
     * password encodé
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salt;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    public function getRoles()
    {
            return $this->roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string|null The encoded password if any
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt(){
        return $this->salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername(){
        return $this->username;
    }

    public function eraseCredentials(){
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;
        return $this;
    }

    public function isEnabled(): bool{
        return $this->enabled;
    }

    public function setRoles(array $roles): self
    {
        if(!in_array($this->roles,$roles)){
            $this->roles = $roles;
        }
        return $this;
    }

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'username' => $this->username,
            'enabled' => $this->enabled
        ];
    }
}
