<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Func;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $idBank;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $recipient;

    public function __construct(String $idBank, Int $amount, String $recipient)
    {
        $this->idBank = $idBank;
        $this->amount = $amount;
        $this->recipient = $recipient;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBank(): ?string
    {
        return $this->idBank;
    }

    public function setIdBank(string $idBank): self
    {
        $this->idBank = $idBank;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getRecipient(): ?string
    {
        return $this->recipient;
    }

    public function setRecipient(string $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function jsonSerialize(){
        return [
            'idBank' => $this->idBank,
            'amount' => $this->amount,
            'recipient' => $this->recipient
        ];
    }
}
