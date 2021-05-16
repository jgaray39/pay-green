<?php

namespace App\Tests\Transaction;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateTransactionTest extends WebTestCase
{
    public function createWithoutToken(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $client->request('POST', '/api/transaction');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}