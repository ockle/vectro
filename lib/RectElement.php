<?php

namespace Vectro;

class RectElement extends ElementAbstract
{
	/**
	 * Construct a <rect> element.
	 * @param float  $x             x-coordinate of the top left point of the rectangle
	 * @param float  $y             y-coordinate of the top left point of the rectangle
	 * @param float  $width         Width of the rectangle
	 * @param float  $height        Height of the rectangle
	 * @param float  $cornerRadiusX Radius along the x-axis of the rounding of the corner
	 * @param float  $cornerRadiusY Radius along the y-axis of the rounding of the corner
	 */
	public function __construct($x, $y, $width, $height, $cornerRadiusX = 0, $cornerRadiusY = 0)
	{
		$this->x = (float) $x;
		$this->y = (float) $y;
		$this->width = abs((float) $width);
		$this->height = abs((float) $height);
		$this->rx = abs((float) $cornerRadiusX);
		$this->ry = abs((float) $cornerRadiusY);
	}
}