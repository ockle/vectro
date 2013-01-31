<?php

namespace Vectro;

class ImageElement extends ElementAbstract
{
	/**
	 * Construct an <image> element.
	 * @param string $link   Link to the image to be included
	 * @param float  $width  Width of the rectangular region into which the content is placed
	 * @param float  $height Height of the rectangular region into which the content is placed
	 * @param float  $x      x-coordinate of the top left of the rectangular region
	 * @param float  $y      y-coordinate of the top left of the rectangular region
	 */
	public function __construct($link, $width, $height, $x = 0, $y = 0)
	{
		$this->xlink__href = (string) $link;
		$this->width = abs((float) $width);
		$this->height = abs((float) $height);
		$this->x = (float) $x;
		$this->y = (float) $y;
	}
}