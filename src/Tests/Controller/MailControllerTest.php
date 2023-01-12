<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MailControllerTest extends WebTestCase
{
    use MailerAssertionsTrait;

    public function testMailIsSentAndContentIsOk()
    {
        $client = $this->createClient();
        $client->request('GET', '/mail/send');
        $this->assertResponseIsSuccessful();

        $this->assertEmailCount(1);

        $email = $this->getMailerMessage();

        $this->assertEmailHtmlBodyContains($email, 'Welcome');
        $this->assertEmailTextBodyContains($email, 'Welcome');
    }
}
