<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\Controller;

use DDA58\MagicTestCase\Shared\Service\Renderer\RendererServiceInterface;
use DDA58\MagicTestCase\Test\Application\UseCase\ShowTest\ShowTestUseCaseInterface;
use DDA58\MagicTestCase\Test\Domain\ValueObject\TestId;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test/{id<\d+>}', name: 'show_test', methods: 'GET')]
class ShowTestController extends AbstractController
{
    public function __construct(
        readonly private RendererServiceInterface $simpleRendererService,
        readonly private ShowTestUseCaseInterface $findTestUseCase,
    ) {
    }

    public function __invoke(
        int $id,
    ): Response {
        try {
            $testId = new TestId($id);
        } catch (InvalidArgumentException) {
            return new Response(
                $this->simpleRendererService->handle(
                    '@error/404.html.twig'
                ),
                Response::HTTP_NOT_FOUND
            );
        }

        $test = $this->findTestUseCase->handle($testId);

        if ($test === null) {
            return new Response(
                $this->simpleRendererService->handle(
                    '@error/404.html.twig'
                ),
                Response::HTTP_NOT_FOUND
            );
        }

        return new Response(
            $this->simpleRendererService->handle(
                '@test/show.html.twig',
                [
                    'test' => $test,
                ]
            )
        );
    }
}
