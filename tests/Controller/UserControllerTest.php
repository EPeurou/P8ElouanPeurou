<?php
namespace App\Tests;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class userTest extends WebTestCase
{
    public function testNewUser()
    {
        $user = static::createClient();
        // $user->followsRedirect();
        $crawler = $user->request('POST', '/users/create');
        
        $form = $crawler->selectButton('Ajout')->count();
        // dd($user->getResponse()->getContent());
        dd("countuserbtn= ".$form);
        // ->form(
            //[ 'user[username]' => 'Fabien',
            // 'user[password]' => 'test',
            // 'user[email]' => 'test@gmail.com',
            // 'user[roles]' => 'ROLES_USER']
        // );
        // $form['username']->setValue('large herbivore');
        // $form['password']->setValue('test');
        // $form['email']->setValue('large@gmail.com');
        // $form['roles']->select(1);
        // $user->submit($form);
        
        // $this->assertResponseRedirects();
        // $task->followRedirect();    
        // $this->assertEquals(2,1+1);
        
    }

    // public function testEditUser()
    // {
    //     $user = static::createClient();
    //     $crawler = $user->request('POST', '/tasks/5/edit');
    //     $form = $crawler->selectButton('Modifier')->form([
    //         'user[username]' => 'Fabien',
    //         'user[password]' => 'test',
    //         'user[email]' => 'test@gmail.com',
    //         'user[roles]' => 'ROLES_USER'
    //     ]);
    //     $user->submit($form);
    //     // $this->assertResponseRedirects();
    //     // $task->followRedirect();    
    //     // $this->assertEquals(2,1+1);
        
    // }

    // public function testToggleTask()
    // {
    //     $task = static::createClient();
    //     $crawler = $task->request('POST', '/tasks/5/toggle');
        
    //     // $this->assertResponseRedirects();
    //     // $task->followRedirect();    
    //     // $this->assertEquals(2,1+1);
        
    // }

    // public function testDeleteTask()
    // {
    //     $task = static::createClient();
    //     $crawler = $task->request('POST', '/tasks/8/delete');
        
    //     // $this->assertResponseRedirects();
    //     // $task->followRedirect();    
    //     // $this->assertEquals(2,1+1);
        
    // }

    public function testListUser()
    {
        $task = static::createClient();
        $task->request('GET', '/users');
        
    }
}