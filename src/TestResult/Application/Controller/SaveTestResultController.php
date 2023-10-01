<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Application\Controller;

use DDA58\MagicTestCase\Shared\Service\Renderer\RendererServiceInterface;
use DDA58\MagicTestCase\Test\Domain\ValueObject\TestId;
use DDA58\MagicTestCase\TestResult\Application\Dto\SaveTestResultDto;
use DDA58\MagicTestCase\TestResult\Application\UseCase\SaveTestResult\Exception\QuestionsStructureNotValidException;
use DDA58\MagicTestCase\TestResult\Application\UseCase\SaveTestResult\Exception\TestNotFoundException;
use DDA58\MagicTestCase\TestResult\Application\UseCase\SaveTestResult\SaveTestResultUseCaseInterface;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test/{testId<\d+>}/result', name: 'save_test_result', methods: 'POST')]
class SaveTestResultController extends AbstractController
{
    public function __construct(
        readonly private RendererServiceInterface $simpleRendererService,
        readonly private SaveTestResultUseCaseInterface $saveTestResultUseCase,
    ) {
    }

    public function __invoke(
        int $testId,
        Request $request,
    ): Response {
        //TODO Move to validator
        try {
            $testIdValueObject = new TestId($testId);
        } catch (InvalidArgumentException) {
            return new Response(
                $this->simpleRendererService->handle(
                    '@error/404.html.twig'
                ),
                Response::HTTP_NOT_FOUND
            );
        }

        $questions = $request->request->all('questions');
        //TODO Move to validator

        try {
            $testResult = $this->saveTestResultUseCase->handle(
                new SaveTestResultDto($testIdValueObject, $questions)
            );
        } catch (TestNotFoundException) {
            return new Response(
                $this->simpleRendererService->handle(
                    '@error/400.html.twig',
                    [
                        'message' => 'Test id is not valid',
                    ]
                ),
                Response::HTTP_BAD_REQUEST
            );
        } catch (QuestionsStructureNotValidException) {
            return new Response(
                $this->simpleRendererService->handle(
                    '@error/400.html.twig',
                    [
                        'message' => 'What are you doing with questions?',
                    ]
                ),
                Response::HTTP_BAD_REQUEST
            );
        }

        return $this->redirectToRoute(
            'show_test_result',
            ['id' => $testResult->getId()]
        );
    }
}
