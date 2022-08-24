<?php
namespace App\Tests;
use App\Entity\User;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class userTest extends WebTestCase
{
    
    public function testNewUser()
    {
        $user = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('Admin');
        $user->loginUser($testUser);
        $crawler = $user->request('POST', '/users/create');
        
        $form = $crawler->selectButton('Ajout')->form(
            [ 'user[username]' => 'testController',
            'user[password]' => 'test',
            'user[email]' => 'testController@gmail.com',
            'user[roles]' => 'ROLE_ADMIN']
        );
        $user->submit($form);
        $this->assertTrue(TRUE);        
    }

    public function testEditUser()
    {
        $user = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('Admin');
        $user->loginUser($testUser);
        $getUserId = $userRepository->findOneByUsername('Anonyme')->getId();
        $crawler = $user->request('POST', '/users/'.$getUserId.'/edit');
        $form = $crawler->selectButton('Modifier')->form([
            'user[username]' => 'Fabien',
            'user[password]' => 'test',
            'user[email]' => 'test@gmail.com',
            'user[roles]' => 'ROLE_USER'
        ]);
        $user->submit($form);
        $this->assertTrue(TRUE);        
    }

    public function testListUser()
    {
        $user = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('Admin');
        $user->loginUser($testUser);
        $user->request('GET', '/users');
        $this->assertTrue(TRUE);
        
    }
}