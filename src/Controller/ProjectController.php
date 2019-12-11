<?php

namespace App\Controller;

use App\Entity\Project;
use http\Env\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;


/**
 * Class MainController
 * @Route("/project")
 * @package App\Controller
 * @author Aaam Nielski
 * @copyright Adam Nielski 2019
 */
class ProjectController extends AbstractController {


    /**
     * @Route("/list", name="project_list", methods={"GET"})
     */
    public function list(Request $request, PaginatorInterface $paginator) {
        $repository = $this->getDoctrine()->getRepository(Project::class);
        $projects = $paginator->paginate($repository->findAll(), $request->query->getInt('page', 1), 10);

        // Render the twig view
        return $this->render('project/list.html.twig', ['projects' => $projects]);
    }

    /**
     * @Route("/list_high", name="project_high_list", methods={"GET"})
     */
    public function listHigh(Request $request, PaginatorInterface $paginator) {
        $repository = $this->getDoctrine()->getRepository(Project::class);
        $projects = $paginator->paginate($repository->findAllHighTasks(), $request->query->getInt('page', 1), 10);

        // Render the twig view
        return $this->render('project/list_high.html.twig', ['projects' => $projects]);
    }

}
