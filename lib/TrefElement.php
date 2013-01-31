<?php

namespace Vectro;

class TrefElement extends TspanElement
{
	/**
	 * Construct a <tref> element.
	 * @param string  $refId    Unique ID of the element
	 * @param float   $x        A list of values specifying the x-coordinates (or if $relative is true, then the value along the x-axis from the current point) of each character in $text
	 * @param float   $y        A list of values specifying the y-coordinates (or if $relative is true, then the value along the x-axis from the current point) of each character in $text
	 * @param boolean $relative Whether or not the values in $x and $y are absolute coordinates or relative values
	 */
	public function __construct($refId, $x = null, $y = null, $relative = false)
	{
		$this->xlink__href = (string) $refId;

		if (!is_null($x))
		{
			$this->setListOfValues($x, ($relative) ? 'dx' : 'x');
		}

		if (!is_null($y))
		{
			$this->setListOfValues($y, ($relative) ? 'dy' : 'y');
		}
	}
}