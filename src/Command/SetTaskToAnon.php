<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;

class SetTaskToAnon extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }
    protected static $defaultName = 'app:settasktoanon';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->entityManager;
        $repoTasks = $em->getRepository("App:Task");
        $repoUsers = $em->getRepository("App:User");
        $tasks = $repoTasks->findBy(['user'=>null]);
        $user = $repoUsers->findOneBy(['username'=>'Anonyme']);
        if($tasks!=null){
            foreach ($tasks as $task){
                $task->setUser($user);
                $em->persist($task);
            }
            
            $em->flush();
            $output->writeln([
                '',
                '============',
            ]);
            $output->writeln('Toutes les tâches sans utilisateur vont être associées à l\'utilisateur anonyme.');
            $output->writeln('<bg=green;options=bold>Succès!</>');
        } else {
            $output->writeln('<bg=yellow;options=bold>Toutes les tâches ont un utilisateur.</>');
        }
        return Command::SUCCESS;
    }
}