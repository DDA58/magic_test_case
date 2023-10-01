<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\Mapper\TestWithShuffle;

use DDA58\MagicTestCase\Test\Application\Dto\QuestionDto;
use DDA58\MagicTestCase\Test\Application\Dto\QuestionOptionDto;
use DDA58\MagicTestCase\Test\Application\Dto\TestDto;
use DDA58\MagicTestCase\Test\Domain\Entity\QuestionEntity;
use DDA58\MagicTestCase\Test\Domain\Entity\QuestionOptionEntity;
use DDA58\MagicTestCase\Test\Domain\Entity\TestEntity;

readonly class TestWithShuffleMapper implements TestWithShuffleMapperInterface
{
    public function map(TestEntity $testEntity): TestDto
    {
        $questions = $testEntity->getQuestions()->toArray();

        shuffle($questions);

        return new TestDto(
            $testEntity->getId(),
            $testEntity->getName(),
            array_map(
                static function (QuestionEntity $question): QuestionDto {
                    $options = $question->getOptions()->toArray();

                    shuffle($options);

                    return new QuestionDto(
                        $question->getId(),
                        $question->getQuestion(),
                        array_map(
                            static fn(QuestionOptionEntity $questionOptionEntity): QuestionOptionDto =>
                                new QuestionOptionDto(
                                    $questionOptionEntity->getId(),
                                    $questionOptionEntity->getOption(),
                                    $questionOptionEntity->isCorrect()
                                ),
                            $options
                        )
                    );
                },
                $questions
            )
        );
    }
}
