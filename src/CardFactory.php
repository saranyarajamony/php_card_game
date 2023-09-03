<?php

namespace CardGame;

use CardGame\Interfaces\ICard;
use CardGame\Exceptions\TypeNotFound;

class CardFactory implements ICard
{
    const Namespace = "CardGame\\";
    protected string $cardType;

    /**
     * @param string $cardType
     */
    public function __construct($cardType)
    {
        $this->cardType = $cardType;
    }

    /**
     * Determines the cardBuilder type depending on the cardType attribute
     * @return CardBuilder
     * @throws Exception
     */
    public function create(): CardBuilder
    {
        if (is_null($this->cardType))
            throw new TypeNotFound("Card Type is missing");
        $className = self::Namespace . $this->cardType;
        if (!class_exists($className))
            throw new \LogicException("Unable to load class: $this->cardType");
        if (new $className instanceof CardBuilder) {
            return new $className();
        } else {
            throw new \LogicException("The class doesn't match the return type");
        }
    }
}
