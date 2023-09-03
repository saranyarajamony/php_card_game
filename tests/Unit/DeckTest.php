<?php

declare(strict_types=1);

namespace Tests\Unit;

use CardGame\CardFactory;
use CardGame\Deck;
use CardGame\Util\Helpers;
use PHPUnit\Framework\TestCase;
use Tests\Util\PHPUnitUtil;

class DeckTest extends TestCase
{
    /**
     * @var Deck
     */
    protected ?object $deckInstance;

    /**
     * @var $cardType
     */
    protected string $cardType;

    protected function setUp(): void
    {
        $this->cardType = 'FrenchCard';
        $cardClass = new CardFactory($this->cardType);
        $this->deckInstance = new Deck($cardClass);
    }
    /**
     * @covers
     * 
     * Test to check if create combinations perform and give two sets of cards category
     */
    public function test_serveCards()
    {
        $cards_served = $this->deckInstance->serveCards();
        self::assertIsArray($cards_served);
    }

    /**
     * @covers
     * 
     * Test to check if the passed array is shuffled and returned completely
     * that too unique combinations)
     */
    public function test_shuffle()
    {
        $foo = PHPUnitUtil::getPrivateMethod($this->deckInstance, 'getDecks', []);
        self::assertCount(2, $foo);
        self::assertCount(52, $foo[0]);
        self::assertCount(13, $foo[1]);

        $result = Helpers::shuffle_array($foo[0], 5, 1 === random_int(0, 1));
        self::assertCount(count($foo[0]), $result);
    }

    /**
     * Test to check the card catefory generated everytime the card is drawn
     * @covers
     * @dataProvider classNameProvider
     * @expectedException Exception
     */
    public function test_factory_exception($input, $output)
    {

        $this->expectException("Exception");
        $this->expectExceptionMessage($output);

        $cardClass = new CardFactory($input);
        $this->deckInstance = new Deck($cardClass);
        $this->assertSame(0, 1);
    }

    public function classNameProvider(): array
    {
        return [
            [
                'SpanishCard',
                "Unable to load class: SpanishCard"
            ],
            [
                'TestFactory',
                "The class doesn't match the return type"
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
        $this->deckInstance = null;
    }
}
