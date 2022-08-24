<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractController
{
    /**
     * @Route("/tasks", name="task_list")
     */
    public function listAction(TaskRepository $taskRepository)
    {
        return $this->render('task/list.html.twig', ['tasks' => $taskRepository->findAll()]);
    }

    /**
     * @Route("/tasks/create", name="task_create")
     */
    public function createAction(Request $request, ManagerRegistry $doctrine)
    {
        $user = $this->getUser();
        if ($user != null){
            $task = new Task();
            $form = $this->createForm(TaskType::class, $task);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $task->setUser($user);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($task);
                $entityManager->flush();

                $this->addFlash('success', 'La tâche a bien été ajoutée.');

                return $this->redirectToRoute('task_list');
            }
        } else {
            return $this->redirectToRoute('login');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/tasks/{id}/edit", name="task_edit")
     */
    public function editAction(Task $task, Request $request, ManagerRegistry $doctrine)
    {
        $user = $this->getUser();
        if ($user != null){
            $form = $this->createForm(TaskType::class, $task); 

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($task);
                $entityManager->flush();

                $this->addFlash('success', 'La tâche a bien été modifiée.');

                return $this->redirectToRoute('task_list');
            }

            return $this->render('task/edit.html.twig', [
                'form' => $form->createView(),
                'task' => $task,
            ]);
        } else {
            return $this->redirectToRoute('login');
        }
    }

    /**
     * @Route("/tasks/{id}/toggle", name="task_toggle")
     */
    public function toggleTaskAction(Task $task, ManagerRegistry $doctrine)
    {
        $user = $this->getUser();
        if ($user != null){
            $task->toggle(!$task->isDone());
            $entityManager = $doctrine->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme faite.', $task->getTitle()));

            return $this->redirectToRoute('task_list');
        } else {
            return $this->redirectToRoute('login');
        }
    }

    /**
     * @Route("/tasks/{id}/delete", name="task_delete")
     */
    public function deleteTaskAction(Task $task, ManagerRegistry $doctrine)
    {
        $getTaskUser=$task->getUser();
        $getTaskUserRoles = $getTaskUser->getRoles();
        // dd($getTaskUserRoles);
        $user = $this->getUser();
        $getRoles[] = null;
        if($user != null){
            $getRoles=$user->getRoles();
        }
        // dd($getRoles[0]);
        if ($getRoles[0] == 'ROLE_ADMIN' && $user == $getTaskUser || $user == $getTaskUser || $getRoles[0] == 'ROLE_ADMIN' && $getTaskUserRoles[0] == 'ROLE_ANON'){
            // dd('ok');
            $entityManager = $doctrine->getManager();
            $entityManager->remove($task);
            $entityManager->flush();
            $this->addFlash('success', 'La tâche a bien été supprimée.');

            return $this->redirectToRoute('task_list');
        } else {
            return $this->redirectToRoute('task_list');
        }
    }
}
