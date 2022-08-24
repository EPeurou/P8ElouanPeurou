<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('Admin');
        $user->setPassword('$2y$04$UeL3PmXtAjZGn2dNfi1kNu6/3i/c02n6YV4PCuzzjESwL2jpTqRN2');
        $user->setEmail('admin@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setUsername('User');
        $user->setPassword('$2y$04$UeL3PmXtAjZGn2dNfi1kNu6/3i/c02n6YV4PCuzzjESwL2jpTqRN2');
        $user->setEmail('user@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setUsername('Anonyme');
        $user->setPassword('$2y$04$UeL3PmXtAjZGn2dNfi1kNu6/3i/c02n6YV4PCuzzjESwL2jpTqRN2');
        $user->setEmail('anon@gmail.com');
        $user->setRoles(['ROLE_ANON']);
        $manager->persist($user);
        $manager->flush();

        $testUser = $this->userRepository->findOneByUsername('Admin');
        $task = new Task();
        $task->setTitle('first task');
        $task->setContent('a simple task');
        $task->IsDone(0);
        $task->setUser($testUser);
        $manager->persist($task);
        $manager->flush();

        $task = new Task();
        $task->setTitle('second task');
        $task->setContent('a simple task');
        $task->IsDone(0);
        $task->setUser($testUser);
        $manager->persist($task);
        $manager->flush();

        $task = new Task();
        $task->setTitle('third task');
        $task->setContent('a simple task');
        $task->IsDone(0);
        $task->setUser($testUser);
        $manager->persist($task);
        $manager->flush();
    }
}
