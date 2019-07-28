<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * Return Hello World
     * @return Response
     */
    public function index(): Response
    {
        return new Response(
            json_encode(['data' => 'hello world']),
            Response::HTTP_OK
        );
    }

}
