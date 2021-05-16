<?php
declare(strict_types=1);

namespace App\Security;

use Exception;
use App\Entity\UserApi;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class UserApiLoginChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {

        if (!$user instanceof UserApi) {
            return;
        }

        //On verifie si l'utilisateur est actif, retourne une erreur 401
        if(!$user->getEnabled()){
            throw new CustomUserMessageAccountStatusException('Votre compte utilisateur est bloqué');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof UserApi) {
            return;
        }
    }
}