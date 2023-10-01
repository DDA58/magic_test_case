<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Shared\Service\Renderer;

use Twig\Environment;

readonly class SimpleRendererService implements RendererServiceInterface
{
    public function __construct(
        private Environment $twig,
    ) {
    }

    public function handle(string $template, array $context = []): string
    {
        return $this->twig->render($template, $context);
    }
}
