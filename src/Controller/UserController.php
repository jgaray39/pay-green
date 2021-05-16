<?php

namespace App\Controller;

use App\Repository\UserApiRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/api/user", name="get_all_user", methods={"GET"})
     */
    public function getAllUser(UserApiRepository $userApiRepository, SerializerInterface $serializer): Response
    {
        $transactions = $userApiRepository->findAll();

        $jsonData = $serializer->serialize($transactions, 'json');

        return new JsonResponse($jsonData, 200);
    }

}
