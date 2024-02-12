<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthController extends AbstractController
{
    /**
     * @Route("/api/token", name="app_generate_token", methods={"POST"})
     */

    public function generateToken(JWTTokenManagerInterface $jwtManager): JsonResponse
    {
        $user = $this->getUser(); //A personnaliser en fonction de notre système d'auth

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], 404);
        }

        $token = $jwtManager->create($user);

        return new JsonResponse(['token' => $token]);
    }
}