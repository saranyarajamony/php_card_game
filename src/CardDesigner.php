<?php
namespace CardGame;

Class CardDesigner 
{
    /**
     * The card's value.
     *
     * @var array
     */
    protected $value;

    /**
     * The card's suit.
     *
     * @var array
     */
    protected $suit;

    /**
     * Create a new Card instance.
     *
     * @param string $value
     * @param string $suit
     */
    public function __construct($value, $suit)
    {
        $this->value = $value;
        $this->suit = $suit;
    }

    /**
     * Convert each card object to string
     *
     * @return string
     */
    public function toString()
    {
        return $this->value . $this->suit;
    }
}

