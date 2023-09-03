<?php
namespace CardGame;

abstract class CardBuilder 
{
     /**
     * The available values.
     *
     * @var array
     */
    protected $availablevalues;

    /**
     * The available suits.
     *
     * @var array
     */
    protected $availablesuits;
    
    /**
     * Define this method on a way how the card can be created using suits and values.
     */
    abstract function build();
   
    
}

