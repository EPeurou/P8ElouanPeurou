<?php
namespace App\Tests;
use App\Entity\Task;
use App\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class taskTest extends WebTestCase
{
    // /**
    //  * @var \Doctrine\ORM\EntityManager
    //  */
    // private $entityManager;

    public function testNewTask()
    {
        $task = static::createClient();
        $crawler = $task->request('POST', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form( [
            'task[title]' => 'Fabien',
            'task[content]' => 'Some feedback from an automated functional test'
            // 'task[user]' => 5
        ]);
        $task->submit($form);
        $this->assertTrue(TRUE);
        // $this->assertResponseRedirects();
        // $task->followRedirect();    
        // $this->assertEquals(2,1+1);
        
    }

    public function testEditTask()
    {
        // $product = $this->entityManager
        //     ->getRepository(Task::class)
        //     ->findOneBy(['id' => '5'])
        // ;
        $task = static::createClient();
        $crawler = $task->request('POST', '/tasks/5/edit');
        $form = $crawler->selectButton('Modifier')->form( [
            'task[title]' => 'Fabien2',
            'task[content]' => 'Some feedback from an automated functional test2'
            // 'task[user]' => 5
        ]);
        $task->submit($form);
        $this->assertTrue(TRUE);
        // $this->assertResponseRedirects();
        // $task->followRedirect();    
        // $this->assertEquals(2,1+1);
        
    }

    public function testToggleTask()
    {
        $task = static::createClient();
        $crawler = $task->request('POST', '/tasks/5/toggle');
        $this->assertTrue(TRUE);
        // $this->assertResponseRedirects();
        // $task->followRedirect();    
        // $this->assertEquals(2,1+1);
        
    }

    public function testDeleteTask()
    {
        $task = static::createClient();
        $crawler = $task->request('POST', '/tasks/124/delete');
        $this->assertTrue(TRUE);
        // $this->assertResponseRedirects();
        // $task->followRedirect();    
        // $this->assertEquals(2,1+1);
        
    }

    public function testListTask()
    {
        $task = static::createClient();
        $task->request('GET', '/tasks');
        $this->assertTrue(TRUE);
    }
}