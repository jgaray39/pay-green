<?php

namespace App\DataFixtures;

use App\Entity\Transaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TransactionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $transaction = new Transaction('fzrj-dzjldnez-ezdzekj', 123, 'PicsouBank');
        $manager->persist($transaction);

        $transaction = new Transaction('fheuhfer-frefer-frefre', 7687, 'AliBabaCompagny');
        $manager->persist($transaction);
        
        $transaction = new Transaction('saxnzk-poeiduze-sbajhvdsa', 5464, 'GoldMaster');
        $manager->persist($transaction);

        $manager->flush();
    }
}
