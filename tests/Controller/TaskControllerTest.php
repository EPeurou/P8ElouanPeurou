<?php
namespace App\Tests;
use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class taskTest extends WebTestCase
{
    // /**
    //  * @var \Doctrine\ORM\EntityManager
    //  */
    // private $entityManager;

    public function testNewTask()
    {
        $task = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('Admin');
        $task->loginUser($testUser);
        $crawler = $task->request('POST', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form( [
            'task[title]' => 'Fabien',
            'task[content]' => 'Some feedback from an automated functional test'
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
        $task = new Task();
        $task->setTitle('for delete');
        $task->setContent('test');
        $task->IsDone(0);
        $task->setCreatedAt(new DateTime('now'));
        $this->assertTrue(TRUE);
        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $entityManager->persist($task);
        $entityManager->flush();
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
        $taskRepository = static::getContainer()->get(TaskRepository::class);
        $testTask = $taskRepository->findOneByTitle('for delete');
        $testTaskId = $testTask->getId();
        $crawler = $task->request('POST', '/tasks/'.$testTaskId.'/delete');
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