<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Application\UseCase\SaveTestResult;

use DDA58\MagicTestCase\TestResult\Application\Dto\SaveTestResultDto;
use DDA58\MagicTestCase\TestResult\Application\UseCase\SaveTestResult\Exception\QuestionsStructureNotValidException;
use DDA58\MagicTestCase\TestResult\Application\UseCase\SaveTestResult\Exception\TestNotFoundException;
use DDA58\MagicTestCase\TestResult\Domain\Entity\TestResultEntity;

interface SaveTestResultUseCaseInterface
{
    /**
     * @throws TestNotFoundException
     * @throws QuestionsStructureNotValidException
     */
    public function handle(SaveTestResultDto $saveTestResultDto): TestResultEntity;
}
