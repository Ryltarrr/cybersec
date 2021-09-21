<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IngredientController extends AbstractController
{
    private $entityManager;
    private $ingredientRepository;

    public function __construct(EntityManagerInterface $entityManager, IngredientRepository $ingredientRepository)
    {
        $this->entityManager = $entityManager;
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * @Route("/ingredient", name="ingredient", methods={"GET"})
     */
    public function index(): JsonResponse
    {
        $ingredients = $this->ingredientRepository->findAll();
        return $this->json($ingredients);
    }

    /**
     * @Route("/ingredient", name="create_ingredient", methods={"POST"})
     */
    public function createIngredient(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $body = $request->toArray();

        $name = $body["name"];
        $description = $body["description"];

        if (empty($name) || empty($description)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $ingredient = new Ingredient();
        $ingredient->setName($name);
        $ingredient->setDescription($description);

        $errors = $validator->validate($ingredient);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $this->entityManager->persist($ingredient);
        $this->entityManager->flush();

        return $this->json($ingredient->getId());
    }

    /**
     * @Route("/ingredient", name="update_ingredient", methods={"PUT"})
     */
    public function updateIngredient(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $body = $request->toArray();
        $id = $body["id"];

        $ingredient = $this->ingredientRepository->find($id);

        if (!$ingredient) {
            throw new NotFoundHttpException("Wrong id");
        }

        $name = $body["name"];
        $description = $body["description"];

        if ($name) {
            $ingredient->setName($name);
        }

        if ($description) {
            $ingredient->setDescription($description);
        }

        $this->entityManager->persist($ingredient);
        $this->entityManager->flush();

        return $this->json($ingredient->getId());
    }


    /**
     * @Route("/ingredient/{id}", name="delete_ingredient", methods={"DELETE"})
     */
    public function deleteIngredient(int $id)
    {
        $ingredient = $this->ingredientRepository->find($id);

        if (!$ingredient) {
            throw new NotFoundHttpException("Wrong id");
        }

        $this->entityManager->remove($ingredient);
        $this->entityManager->flush();

        return $this->json($id);
    }
}