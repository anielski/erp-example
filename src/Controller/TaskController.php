<?php

namespace App\Controller;

use App\Entity\Task;
use http\Env\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;


/**
 * The main map service class.
 * Class MainController
 * @Route("/task")
 * @package App\Controller
 * @author Aaam Nielski
 * @copyright Adam Nielski 2019
 */
class TaskController extends AbstractController {


    /**
     * Tasks list.
     * @Route("/list/{id<\d+>}", name="task_list", methods={"GET"})
     */
    public function list(Request $request, PaginatorInterface $paginator, $id) {
        $repository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $paginator->paginate($repository->findAllForProject( $id ), $request->query->getInt('page', 1), 10);

        // Render the twig view
        return $this->render('task/list.html.twig', ['tasks' => $tasks]);
    }

    /**
     * Show properties of task
     * @Route("/{id<\d+>}", name="task_show", methods={"GET"})
     */
    public function task( $id ) {
        $repository = $this->getDoctrine()->getRepository(Task::class);

        // Render the twig view
        return $this->render('task/task.html.twig', array('task' => $repository->find( $id )));
    }

    /**
     * @Route("/list_half", name="task_half_list", methods={"GET"})
     */
    public function listHalf(Request $request, PaginatorInterface $paginator) {
        $repository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $paginator->paginate($repository->findAllHalfTasks(), $request->query->getInt('page', 1), 10);

        // Render the twig view
        return $this->render('task/list_half.html.twig', ['tasks' => $tasks]);
    }

}
