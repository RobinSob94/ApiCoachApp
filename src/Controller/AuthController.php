<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthController extends AbstractController
{
#[Route("/user/current", name:"get_current_user", methods:["GET"])]
    public function getCurrentUser(): JsonResponse
    {
        $user = $this->getUser();
        $userId1 = $user->getId();
        $userId = $user->getUserIdentifier();
        return new JsonResponse(['user' => $userId, 'userId' => $userId1]);
    }
}