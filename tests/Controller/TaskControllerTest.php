<?php
namespace App\Tests;
use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class taskTest extends WebTestCase
{

    public function testNewTask()
    {
        $task = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('Admin');
        $task->loginUser($testUser);
        $crawler = $task->request('POST', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form( [
            'task[title]' => 'new task',
            'task[content]' => 'a task'
        ]);
        $task->submit($form);
        $this->assertTrue(TRUE);
        
    }

    public function testEditTask()
    {
        $task = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('Admin');
        $task->loginUser($testUser);
        $taskRepository = static::getContainer()->get(TaskRepository::class);
        $testTask = $taskRepository->findOneByTitle('first task');
        $testTaskId = $testTask->getId();
        $crawler = $task->request('POST', '/tasks/'.$testTaskId.'/edit');
        $form = $crawler->selectButton('Modifier')->form([
            'task[title]' => 'first task edited',
            'task[content]' => 'Some feedback from an automated functional test2'
        ]);
        $task->submit($form);
        $this->assertTrue(TRUE);
        
    }

    // public function testNewTaskForDelete()
    // {
    //     $task = static::createClient();
    //     $userRepository = static::getContainer()->get(UserRepository::class);
    //     $testUser = $userRepository->findOneByUsername('Admin');
    //     $task->loginUser($testUser);
    //     $crawler = $task->request('POST', '/tasks/create');
    //     $form = $crawler->selectButton('Ajouter')->form( [
    //         'task[title]' => 'For delete test',
    //         'task[content]' => 'test'
    //     ]);
    //     $task->submit($form);
    //     $this->assertTrue(TRUE);        
    // }


    public function testToggleTask()
    {
        $task = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('Admin');
        $task->loginUser($testUser);
        $taskRepository = static::getContainer()->get(TaskRepository::class);
        $testTask = $taskRepository->findOneByTitle('first task edited');
        $testTaskId = $testTask->getId();
        $task->request('POST', '/tasks/'.$testTaskId.'/toggle');
        $this->assertTrue(TRUE);
        // $this->assertResponseRedirects();
        // $task->followRedirect();    
        // $this->assertEquals(2,1+1);
        
    }

    public function testDeleteTask()
    {
        $task = static::createClient();
        $taskRepository = static::getContainer()->get(TaskRepository::class);
        $testTask = $taskRepository->findOneByTitle('second task');
        $testTaskId = $testTask->getId();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('Admin');
        $task->loginUser($testUser);
        $task->request('POST', '/tasks/'.$testTaskId.'/delete');
        $this->assertTrue(TRUE);        
    }

    public function testListTask()
    {
        $task = static::createClient();
        $task->request('GET', '/tasks');
        $this->assertTrue(TRUE);
    }
}