<?php

namespace App\Controller;

use http\Env\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class MainController
 * @package App\Controller
 * @author Aaam Nielski
 * @copyright Adam Nielski 2019
 */
class MainController extends AbstractController {

    /**
     * Default action.
     * @Route("/", name="start_page")
     */
    public function index(Request $request) {
        return $this->render('main/index.html.twig', ['controller_name' => 'MainController',]);
    }

}
