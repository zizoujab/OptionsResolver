<?php

namespace App\Controller;

use App\Entity\Cat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CatController extends AbstractController
{
    #[Route('/cats', name: 'create_cat')]
    public function index(Request $request): JsonResponse
    {
        $cat = new Cat($request->toArray());

        return $this->json($cat);
    }
}
