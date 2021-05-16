<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Repository\TransactionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TransactionController extends AbstractController
{
    /**
     * @Route("/api/transaction", name="get_all_transaction", methods={"GET"})
     */
    public function getAllTransaction(TransactionRepository $transactionRepository, SerializerInterface $serializer): Response
    {
        $transactions = $transactionRepository->findAll();

        $jsonData = $serializer->serialize($transactions, 'json');

        return new JsonResponse($jsonData, 200);
    }

    /**
     * @Route("/api/transaction", name="create_transaction", methods={"POST"})
     */
    public function createTransaction(ValidatorInterface $validator, Request $request, TransactionRepository $transactionRepository, SerializerInterface $serializer): Response
    {
        
        //on crée un nouvel objet avec les données recues
        $transaction = new Transaction(
            $request->request->get('idBank'),
            intval($request->request->get('amount')),
            $request->request->get('recipient')
        );

        //on verifie les données
        $errors = $validator->validate($transaction, null, ['Default']);

        // Si des erreurs sont trouvé, il retourne les erreurs avec le code HTTP 400 = bad request
        if (\count($errors) > 0) {
            return new JsonResponse($errors, 400);
        }

        $transactionRepository->save($transaction);

        return new JsonResponse($transaction->getId(), 201);
    }

}
