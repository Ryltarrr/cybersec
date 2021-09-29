<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Model;
use App\Entity\ModelIngredient;
use App\Entity\Process;
use App\Repository\ModelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ModelController extends AbstractController
{
    /**
     * @Route("/api/model", name="model", methods={"GET"})
     */
    public function index(ModelRepository $modelRepo): JsonResponse
    {
        $models = $modelRepo->findAll();
        return $this->json($models, 200, [], ["groups" => "show_model"]);
    }

    /**
     * @Route("/api/model", name="create_model", methods={"POST"})
     */
    public function createModel(
        Request $request,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager
    ) {
        $body = $request->toArray();

        $name = $body["name"];
        $description = $body["description"];
        $price = $body["price"];
        $range = $body["range"];
        $processId = $body["processId"];
        $ingredients = $body["ingredients"];

        $process = $entityManager
            ->getRepository(Process::class)
            ->find($processId);

        $model = new Model();
        $model->setName($name);
        $model->setDescription($description);
        $model->setPrice($price);
        $model->setRange($range);
        $model->setProcess($process);

        foreach ($ingredients as $value) {
            $ingredient = $entityManager
                ->getRepository(Ingredient::class)
                ->find($value["id"]);
            if ($ingredient) {
                $modelIngredient = new ModelIngredient();
                $modelIngredient->setIngredient($ingredient);
                $modelIngredient->setGrammage($value["grammage"]);
                $modelIngredient->setModel($model);

                $entityManager->persist($modelIngredient);
            }
        }

        $errors = $validator->validate($model);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $entityManager->persist($model);
        $entityManager->flush();

        return $this->json($model, 200, [], ["groups" => "show_ingredient"]);
    }

    /**
     * @Route("/api/model", name="update_model", methods={"PUT"})
     */
    public function updateModel(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        ModelRepository $modelRepo
    ): JsonResponse {
        $body = $request->toArray();
        $id = $body["id"];

        $model = $modelRepo->find($id);

        if (!$model) {
            $this->createNotFoundException("Wrong id");
        }

        $name = $body["name"];
        $description = $body["description"];
        $price = $body["price"];
        $range = $body["range"];
        $processId = $body["processId"];

        $process = $entityManager
            ->getRepository(Process::class)
            ->find($processId);

        if ($name) {
            $model->setName($name);
        }

        if ($description) {
            $model->setDescription($description);
        }

        if ($price) {
            $model->setPrice($price);
        }

        if ($range) {
            $model->setRange($range);
        }

        if ($process) {
            $model->setProcess($process);
        }

        $errors = $validator->validate($model);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $entityManager->persist($model);
        $entityManager->flush();

        return $this->json($model, 200, [], ["groups" => "show_ingredient"]);
    }

    /**
     * @Route("/api/model/{id}", name="delete_model", methods={"DELETE"})
     */
    public function deleteModel(
        int $id,
        ModelRepository $modelRepo,
        EntityManagerInterface $entityManager
    ) {
        $model = $modelRepo->find($id);

        if (!$model) {
            $this->createNotFoundException("Wrong id");
        }

        $entityManager->remove($model);
        $entityManager->flush();

        return $this->json($id);
    }
}
