<?php

namespace Vectro;

class EllipseElement extends ElementAbstract
{
	/**
	 * Construct an <elipse> element.
	 * @param float $centerX x-coordinate of the center of the ellipse
	 * @param float $centerY y-coordinate of the center of the ellipse
	 * @param float $radiusX x-axis radius of the ellipse
	 * @param float $radiusY y-axis radius of the ellipse
	 */
	public function __construct($centerX, $centerY, $radiusX, $radiusY)
	{
		$this->cx = (float) $centerX;
		$this->cy = (float) $centerY;
		$this->rx = abs((float) $radiusX);
		$this->ry = abs((float) $radiusY);
	}
}