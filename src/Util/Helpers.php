<?php

namespace CardGame\Util;

use InvalidArgumentException;

/**
 * Define some helper functions which can be generic
 */
class Helpers
{

	/**
	 * Shuffle the total cards provided randomnly, based on howmanytimes and return back the shuffled array 
	 * If shuffle is false, then the array is returned as such
	 * @param array $a
	 * @param int $howmanytimes 
	 * @return array
	 */
	public static function shuffle_array($a, $howmanytimes = 5, $shuffle = false)
	{
		if (!is_array($a)) {
			throw new InvalidArgumentException('Expected type is array');
		}
		if ($shuffle) {
			return $a;
		}

		$result = $a;

		$i = 0;
		do {
			shuffle($result);
		} while ($i > $howmanytimes);

		return $result;
	}

	/**
	 * Get random elements from a passed array with a limit count of elements returned
	 * if the returned count is not equal to limit, call the method again (recursive method)
	 * if random_choose is false, rather than choosing the random elements, choose the elments to a limit starting from a random starting point 
	 * @param array $array
	 * @param int $limit
	 * 
	 * @return array
	 */
	public static function  getRandomElements(array $array, $choose_random = false, $limit = 5): array
	{
		$random = array();
		if ($choose_random) {
			foreach (array_rand($array, $limit) as $key) {
				$random[] = $array[$key];
			}
			if (count(array_unique($random)) === $limit) {
				return $random;
			} else {
				return self::getRandomElements($array);
			}
		} else {
			$starting_point = mt_rand(0, count($array) - $limit);
			return array_slice($array, $starting_point, $limit);
		}
	}

	/**
	 * Scan through each array element , compared of the current is 1 higher than previous
	 * Then returns true
	 * 
	 * @param array $sequence //expecting a sorted array
	 */
	public static function checkIfConsecutive($sequence): bool
	{
		$next = true;
		$previous = '';
		if (is_array($sequence) && count($sequence) > 1) {
			foreach ($sequence as $key => $currentItem) {
				if ($key > 0) {
					if (($currentItem - 1) != $previous) $next = false;
				}
				$previous = $currentItem;
			}

			return $next;
		} else
			return false;
	}
}
