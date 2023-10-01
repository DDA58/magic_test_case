<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Application\UseCase\ShowTestResult;

use DDA58\MagicTestCase\TestResult\Application\Dto\ShowTestResultDto;
use DDA58\MagicTestCase\TestResult\Application\UseCase\ShowTestResult\Exception\TestResultNotFoundException;
use DDA58\MagicTestCase\TestResult\Domain\ValueObject\TestResultId;

interface ShowTestResultUseCaseInterface
{
    /**
     * @throws TestResultNotFoundException
     */
    public function handle(TestResultId $id): ShowTestResultDto;
}
