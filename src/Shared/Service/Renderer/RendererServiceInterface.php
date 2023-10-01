<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Shared\Service\Renderer;

interface RendererServiceInterface
{
    public function handle(string $template, array $context = []): string;
}
