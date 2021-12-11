<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/expenses")
 */
class ExpenseController extends AbstractController
{
    /**
     * @Route ("/{id}")
     *
     * @return JsonResponse
     */
    public function test($id)
    {
        return $this->json(['id' => $id]);
    }
}
