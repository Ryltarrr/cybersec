<?php

namespace App\Controller;

use App\Entity\Model;
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
     * @Route("/model", name="model", methods={"GET"})
     */
    public function index(ModelRepository $modelRepo): JsonResponse
    {
        $models = $modelRepo->findAll();
        return $this->json($models);
    }

    /**
     * @Route("/model", name="create_model", methods={"POST"})
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

        $model = new Model();
        $model->setName($name);
        $model->setDescription($description);
        $model->setPrice($price);
        $model->setRange($range);

        $errors = $validator->validate($model);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $entityManager->persist($model);
        $entityManager->flush();

        return $this->json($model->getId());
    }

    /**
     * @Route("/model", name="update_model", methods={"PUT"})
     */
    public function updateModel(
        Request $request,
        EntityManagerInterface $entityManager,
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

        $entityManager->persist($model);
        $entityManager->flush();

        return $this->json($model->getId());
    }

    /**
     * @Route("/model/{id}", name="delete_model", methods={"DELETE"})
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
