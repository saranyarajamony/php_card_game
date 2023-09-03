<?php
namespace CardGame;
use CardGame\CardDesigner;

/**
 * TODO - Another choice * Generalized class with switch statements
 */
class FrenchCard extends CardBuilder 
{
    public function __construct()
    {
        $this->availablesuits = array('S', 'H', 'D', 'C');
        $this->availablevalues = array('A','2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K');
    }
        
    /**
     * Builds the card with permutation and combinations of 
     * availablesuits and availablevalues
     * 
     * @return array
     */
    public function build(): array
    {
        $cards = [];
        //create normal combinations 
        foreach ($this->availablesuits as $suit) {
            foreach ($this->availablevalues as $value) {
                $cards[0][] = (new CardDesigner($value, $suit))->toString();
            }
        }
        //create flush combinations
        $random_suit_pick = $this->availablesuits[array_rand($this->availablesuits,1)];
        foreach ($this->availablevalues as $value) {
            $cards[1][] = (new CardDesigner($value, $random_suit_pick))->toString();
        }        

        return $cards;
    }

    
}

