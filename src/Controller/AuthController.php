<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthController extends AbstractController
{
#[Route("/api/token", name:"app_generate_token", methods:["POST"])]
    public function generateToken(JWTTokenManagerInterface $jwtManager, EntityManagerInterface $entityManager): JsonResponse
    {
        $request = Request::createFromGlobals();
    $requestBody = json_decode($request->getContent());
        $user = $entityManager->getRepository(User::class)->findOneBy(['email'=>$requestBody->email, 'password'=>$requestBody->password]);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], 404);
        }
        $token = $jwtManager->create($user);

        return new JsonResponse(['token' => $token]);


    }
}