<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Request\CreateExpenseRequestDTO;
use App\DTO\Request\UpdateExpenseRequestDTO;
use App\DTOFactory\Response\ExpenseDetailsResponseDTOFactory;
use App\DTOFactory\Response\ExpenseResponseDTOFactory;
use App\Entity\Expense;
use App\Repository\ExpenseRepository;
use App\Repository\ExpenseTypeRepository;
use App\Service\ExpenseCreator;
use App\Service\ExpenseUpdater;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;

#[Route(path: '/expenses')]
class ExpenseController extends AbstractController
{
    use ValidationTrait;

    private ExpenseRepository $expenseRepository;
    private ExpenseTypeRepository $expenseTypeRepository;
    private ExpenseResponseDTOFactory $expenseResponseDTOFactory;
    private ExpenseDetailsResponseDTOFactory $expenseDetailsResponseDTOFactory;
    private ExpenseCreator $expenseCreator;
    private ExpenseUpdater $expenseUpdater;
    private ManagerRegistry $managerRegistry;

    public function __construct(
        ExpenseRepository $expenseRepository,
        ExpenseTypeRepository $expenseTypeRepository,
        ExpenseResponseDTOFactory $expenseResponseDTOFactory,
        ExpenseDetailsResponseDTOFactory $expenseDetailsResponseDTOFactory,
        ExpenseCreator $expenseCreator,
        ExpenseUpdater $expenseUpdater,
        ManagerRegistry $managerRegistry
    ) {
        $this->expenseRepository = $expenseRepository;
        $this->expenseTypeRepository = $expenseTypeRepository;
        $this->expenseResponseDTOFactory = $expenseResponseDTOFactory;
        $this->expenseDetailsResponseDTOFactory = $expenseDetailsResponseDTOFactory;
        $this->expenseCreator = $expenseCreator;
        $this->expenseUpdater = $expenseUpdater;
        $this->managerRegistry = $managerRegistry;
    }

    #[Route(path: '', methods: ['GET'])]
    public function getAllExpensesAction(): Response
    {
        return $this->json(
            $this->expenseResponseDTOFactory->createDTOs($this->expenseRepository->findAll()),
            Response::HTTP_OK
        );
    }

    #[Route(path: '/{expense}', requirements: ['expense' => "\d+"], methods: ['GET'])]
    #[Entity(data: 'expense', expr: "repository.find(expense)", class: Expense::class)]
    public function getExpenseDetailsAction(?Expense $expense): Response
    {
        if (!$expense) {
            return $this->createGenericErrorView('Invalid expense Id.');
        }

        return $this->json($this->expenseDetailsResponseDTOFactory->createDTO($expense), Response::HTTP_OK);
    }

    #[Route(path: '', methods: ['POST'])]
    #[ParamConverter(
        data: "createExpenseRequestDTO",
        class: CreateExpenseRequestDTO::class,
        converter: "fos_rest.request_body"
    )]
    public function createExpenseAction(
        CreateExpenseRequestDTO $createExpenseRequestDTO,
        ConstraintViolationListInterface $validationErrors
    ): Response {
        if ($validationErrors->count()) {
            return $this->createValidationErrorView($validationErrors);
        }

        $expenseType = $this->expenseTypeRepository->find($createExpenseRequestDTO->getTypeId());

        if (!$expenseType) {
            return $this->createGenericErrorView('Invalid expense type.');
        }

        return $this->json(
            $this->expenseDetailsResponseDTOFactory->createDTO(
                $this->expenseCreator->create($createExpenseRequestDTO, $expenseType)
            ),
            Response::HTTP_CREATED
        );
    }

    #[Route(path: '/{expense}',methods: ['PUT'])]
    #[Entity(data: 'expense', expr: "repository.find(expense)", class: Expense::class)]
    #[ParamConverter(
        data: "updateExpenseRequestDTO",
        class: UpdateExpenseRequestDTO::class,
        converter: "fos_rest.request_body"
    )]
    public function updateExpenseAction(
        ?Expense $expense,
        UpdateExpenseRequestDTO $updateExpenseRequestDTO,
        ConstraintViolationListInterface $validationErrors
    ): Response {
        if (!$expense) {
            return $this->createGenericErrorView('Invalid expense Id.');
        }

        if ($validationErrors->count()) {
            return $this->createValidationErrorView($validationErrors);
        }

        $expenseType = $this->expenseTypeRepository->find($updateExpenseRequestDTO->getTypeId());

        if (!$expenseType) {
            return $this->createGenericErrorView('Invalid expense type.');
        }

        return $this->json(
            $this->expenseDetailsResponseDTOFactory->createDTO(
                $this->expenseUpdater->update($updateExpenseRequestDTO, $expense, $expenseType)
            ),
            Response::HTTP_OK
        );
    }

    #[Route(path: '/{expense}', methods: ['DELETE'])]
    #[Entity(data: 'expense', expr: "repository.find(expense)", class: Expense::class)]
    public function deleteExpenseAction(?Expense $expense): Response
    {
        if (!$expense) {
            return $this->createGenericErrorView('Invalid expense Id.');
        }
        $entityManager = $this->managerRegistry->getManager();
        $entityManager->remove($expense);
        $entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
