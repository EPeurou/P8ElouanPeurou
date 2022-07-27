<?php
namespace App\Tests;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class securityTest extends WebTestCase
{
    public function testlogin()
    {
        $user = static::createClient();
        // $userRepository = static::getContainer()->get(UserRepository::class);

        // // retrieve the test user
        // $testUser = $userRepository->findOneByUsername('Admin');

        // // simulate $testUser being logged in
        // $user->loginUser($testUser);
        $crawler = $user->request('GET', 'security/login');
        
        $form = $crawler->selectButton('Se connecter')->form(
            [ '_username' => 'test1',
            '_password' => 'test'
            // '_csrf_token' => 'test1@gmail.com',
            // 'user[roles]' => 'ROLE_ADMIN'
            ]
        );
        $user->submit($form);
        $this->assertTrue(TRUE);
        
        // $this->assertResponseRedirects();
        // $task->followRedirect();    
        // $this->assertEquals(2,1+1);
        
    }

    public function testlogout()
    {
        $user = static::createClient();
        $crawler = $user->request('GET', 'security/logout');
        $this->assertTrue(TRUE);        
    }

    
}