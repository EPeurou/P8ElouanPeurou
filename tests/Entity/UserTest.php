<?php
namespace App\Tests;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EntityUserTest extends WebTestCase
{
    // private ManagerRegistry $doctrine;
    // private EntityManagerInterface $entityManager;

    public function testUser()
    {
        $user = new User();
        $user->setUsername('testEntity');
        $user->setPassword('$2y$04$UeL3PmXtAjZGn2dNfi1kNu6/3i/c02n6YV4PCuzzjESwL2jpTqRN2');
        $user->setEmail('testEntity@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $this->assertTrue(TRUE);
        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $entityManager->persist($user);
        $entityManager->flush();
    }
    
}