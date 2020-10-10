<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function test()
    {
        return new JsonResponse(['test' => 666]);
    }
}
