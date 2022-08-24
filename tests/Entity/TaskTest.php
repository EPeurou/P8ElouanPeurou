<?php
namespace App\Tests;
use App\Entity\Task;
use PHPUnit\Framework\TestCase;
use App\Repository\TaskRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EntityTaskTest extends WebTestCase
{
    // private ManagerRegistry $doctrine;
    // private EntityManagerInterface $entityManager;

    public function testTask()
    {
        $task = new Task();
        $task->setTitle('testEntity');
        $task->setContent('test');
        $task->IsDone(0);
        $task->setCreatedAt(new DateTime('now'));
        $this->assertTrue(TRUE);
        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $entityManager->persist($task);
        $entityManager->flush();
    }
    
}