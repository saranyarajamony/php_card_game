<?php
namespace CardGame\Interfaces;

interface IGame
{
    /**
	 * calls the steps to initialize game and runs the steps after starting
	 */
	public function start();

	/**
	 * calls the steps to stop the game, undoing and switch back the game back to initial state
	 */
	public function restart();

	/**
	 * calls the steps to pause the ongoing game and switch back the game back to initial state
	 */
	public function stop();

	/** can have more method signatures like game settings, initialization, pause / resume game */
}

