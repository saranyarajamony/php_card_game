<?php

declare(strict_types=1);

namespace Tests\Unit;

use CardGame\Game;
use PHPUnit\Framework\TestCase;
use Tests\Util\PHPUnitUtil;

class GameTest extends TestCase
{
    /**
     * @var Game
     */
    protected ?object $gameInstance;

    /**
     * @var $cardType
     */
    protected string $cardType;

    protected function setUp(): void
    {
        $this->cardType = 'FrenchCard';
        $this->gameInstance = new Game($this->cardType);
    }
    /**
     * @covers
     * 
     * Test to run / start the Game and check the result (player has only 5 cards in the hand and 
     * that too unique )
     */
    public function test_start()
    {
        $result = $this->gameInstance->start();
        self::assertCount(5, $result['cards_displayed']);
        self::assertCount(5, array_unique($result['cards_displayed']));
    }

    /**
     * Test to check the card catefory generated everytime the card is drawn
     *  @covers
     *  @dataProvider provideCardCategory
     */
    public function test_card_category(array $input, $output)
    {
        $foo = PHPUnitUtil::getPrivateMethod($this->gameInstance, 'check_cards_category', [$input]);
        self::assertSame($output, $foo);
    }

    public function provideCardCategory(): array
    {
        return [
            [
                [
                    '8H', '9H', '10H', 'JH', 'QH'
                ],
                'The result is a straight flush'
            ],
            [
                [
                    '2S', '9S', 'AS', '3S', 'QS'
                ],
                'The result is a flush'
            ],
            [
                [
                    '8H', '9C', 'AD', 'JC', 'QS'
                ],
                'The result is normal'
            ],
            [
                [
                    '3C', '4C', '5C', '6C', '7C'
                ],
                'The result is a straight flush'
            ],
            [
                [
                    '7D', 'JH', 'QS', 'JS', 'KD'
                ],
                'The result is normal'
            ]
        ];
    }

    /**
     * Tears down the object.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        $this->cardType = '';
        $this->gameInstance = null;
    }
}
