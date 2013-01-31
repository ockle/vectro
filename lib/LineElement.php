<?php

namespace Vectro;

class LineElement extends ElementAbstract
{
	/**
	 * Construct a <line> element.
	 * @param float $fromX x-coordinate of the start point of the line
	 * @param float $fromY y-coordinate of the start point of the line
	 * @param float $toX   x-coordinate of the end point of the line
	 * @param float $toY   y-coordinate of the end point of the line
	 */
	public function __construct($fromX, $fromY, $toX, $toY)
	{
		$this->x1 = (float) $fromX;
		$this->y1 = (float) $fromY;
		$this->x2 = (float) $toX;
		$this->y2 = (float) $toY;
	}
}