<?php

namespace Vectro;

class CircleElement extends ElementAbstract
{
	/**
	 * Constuct a <circle> element.
	 * @param float $centerX x-coordinate of the center of the circle
	 * @param float $centerY y-coordinate of the center of the circle
	 * @param float $radius  Radius of the circle
	 */
	public function __construct($centerX, $centerY, $radius)
	{
		$this->cx = (float) $centerX;
		$this->cy = (float) $centerY;
		$this->r = abs((float) $radius);
	}
}