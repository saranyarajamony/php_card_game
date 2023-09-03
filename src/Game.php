<?php
namespace CardGame;
use CardGame\Interfaces\IGame;
use CardGame\CardFactory;
use CardGame\Util\Helpers;
use CardGame\Deck;
use CardGame\Exceptions\NoInterfaceFound;
use CardGame\Interfaces\ICard;

class Game implements IGame
{
	/**
	 * cardtype selected
	 * EG: 'FrenchCard' , 'SpanishCard' ...
	 */
	protected string $cardType;

	/**
	 * @param string $cardType
	 */
	public function __construct($cardType)
	{
		$this->cardType = $cardType;
	}
	/**
	 * start the game 
	 *
	 * @return array
	 */
	public function start(): array
	{
	    // Instantiate Deck and call serve method to return the deck of cards
        $cardClass = new CardFactory($this->cardType);		
		if($cardClass instanceof ICard) 
			$deck = (new Deck($cardClass))->serveCards();		
		else
			throw new NoInterfaceFound("No interface found");	
	
		//Randomly choose the cards from the shuffled deck for the player
		$to_be_displayed = Helpers::getRandomElements($deck, 1 === random_int(0, 1));

		//sort the cards by comparing the items numerically
		array_multisort($to_be_displayed, SORT_NUMERIC, $to_be_displayed);

		//check if the served cards in a had is straight flush / flush / normal
		$message = $this->check_cards_category($to_be_displayed);

		//returns the result of cards and message to be displayed
		return ["cards_displayed" => $to_be_displayed, "message" => $message];
	}

	/** Has to define the process of restart the game */
	public function restart()
	{
	}

	/** Has to define the stop / exit the ongoing  game */
	public function stop()
	{
	}
    
	/**
	 * Check if the category of cards in hand belongs to normal / straight flush / flush pattern
	 * @param array $array
	 */
	private function check_cards_category(array $array)
	{
		$message = 'The result is normal';
		$m = ['A' => 1, 1=>10, 'J' => 11, 'Q' => 12, 'K' => 13];
		foreach ($array as $a) {
			$p = substr($a, -1);
			$flush[] = $p;			
			$straight[] = (($m[$a[0]]) ?? $a[0]); 
       		
		}
		if(count(array_unique($straight)) === 5) {		  
          sort($straight);
		  if($straight[0] == 1 && array_search(10, $straight)) {
			$straight[0] = 14;
			sort($straight);
		  }
		  $straightFlush = Helpers::checkIfConsecutive($straight);
		  if($straightFlush) {
			return 'The result is a straight flush';
		  }
		}
		if(count(array_unique($flush)) === 1) {
			return 'The result is a flush';
		}
		return $message;
		
	}
}
