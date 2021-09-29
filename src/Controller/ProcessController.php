<?php

namespace App\Controller;

use App\Entity\Process;
use App\Repository\ProcessRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProcessController extends AbstractController
{
    /**
     * @Route("/process", name="process", methods={"GET"})
     */
    public function index(ProcessRepository $processRepo): JsonResponse
    {
        $processes = $processRepo->findAll();
        return $this->json($processes);
    }

    /**
     * @Route("/process", name="create_process", methods={"POST"})
     */
    public function createProcess(
        Request $request,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager
    ) {
        $body = $request->toArray();

        $name = $body["name"];
        $description = $body["description"];
        $steps = $body["steps"];

        $process = new Process();
        $process->setName($name);
        $process->setDescription($description);
        $process->setSteps($steps);

        $errors = $validator->validate($process);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $entityManager->persist($process);
        $entityManager->flush();

        return $this->json($process, 200, [], ["groups" => "show_ingredient"]);
    }

    /**
     * @Route("/process", name="update_process", methods={"PUT"})
     */
    public function updateProcess(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        ProcessRepository $processRepo
    ): JsonResponse {
        $body = $request->toArray();
        $id = $body["id"];

        $process = $processRepo->find($id);

        if (!$process) {
            $this->createNotFoundException("Wrong id");
        }

        $name = $body["name"];
        $description = $body["description"];
        $steps = $body["steps"];

        if ($name) {
            $process->setName($name);
        }

        if ($description) {
            $process->setDescription($description);
        }

        if ($steps) {
            $process->setSteps($steps);
        }

        $errors = $validator->validate($process);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $entityManager->persist($process);
        $entityManager->flush();

        return $this->json($process, 200, [], ["groups" => "show_ingredient"]);
    }

    /**
     * @Route("/process/{id}", name="delete_process", methods={"DELETE"})
     */
    public function deleteProcess(
        int $id,
        ProcessRepository $processRepo,
        EntityManagerInterface $entityManager
    ) {
        $process = $processRepo->find($id);

        if (!$process) {
            $this->createNotFoundException("Wrong id");
        }

        $entityManager->remove($process);
        $entityManager->flush();

        return $this->json($id);
    }
}
