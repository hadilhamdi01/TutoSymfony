<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;


class ContactDTO
{
    #[Assert\NotBlank]
    #[Assert\length(min: 3, max: 200)]
    public string $name = '';

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email = '';

    #[Assert\NotBlank]
    #[Assert\length(min: 3, max: 200)]
    public string $message = '';

}
