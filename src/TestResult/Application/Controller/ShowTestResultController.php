<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Application\Controller;

use DDA58\MagicTestCase\Shared\Service\Renderer\RendererServiceInterface;
use DDA58\MagicTestCase\TestResult\Application\UseCase\ShowTestResult\Exception\TestResultNotFoundException;
use DDA58\MagicTestCase\TestResult\Application\UseCase\ShowTestResult\ShowTestResultUseCaseInterface;
use DDA58\MagicTestCase\TestResult\Domain\ValueObject\TestResultId;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/result/{id}', name: 'show_test_result', methods: 'GET')]
class ShowTestResultController extends AbstractController
{
    public function __construct(
        readonly private RendererServiceInterface $simpleRendererService,
        readonly private ShowTestResultUseCaseInterface $showTestResultUseCase,
    ) {
    }

    public function __invoke(
        string $id
    ): Response {
        try {
            $testResultId = new TestResultId($id);
        } catch (InvalidArgumentException) {
            return new Response(
                $this->simpleRendererService->handle(
                    '@error/404.html.twig'
                ),
                Response::HTTP_NOT_FOUND
            );
        }

        try {
            $testResult = $this->showTestResultUseCase->handle($testResultId);
        } catch (TestResultNotFoundException) {
            return new Response(
                $this->simpleRendererService->handle(
                    '@error/404.html.twig'
                ),
                Response::HTTP_NOT_FOUND
            );
        }

        return new Response(
            $this->simpleRendererService->handle(
                '@test_result/show.html.twig',
                [
                    'testResult' => $testResult,
                ]
            ),
        );
    }
}
