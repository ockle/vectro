<?php

namespace Vectro;

class UseElement extends ElementAbstract
{
	/**
	 * Construct a <use> element.
	 * @param string $refId  ID of the element to be used
	 * @param float  $x      x-coordinate of the top left corner of the rectangle into which the referenced element is placed
	 * @param float  $y      y-coordinate of the top left corner of the rectangle into which the referenced element is placed
	 * @param float  $width  Width of the rectangle into which the referenced element is placed. If not defined then the width of the referenced element is used
	 * @param float  $height Height of the rectangle into which the referenced element is placed. If not defined then the height of the referenced element is used
	 */
	public function __construct($refId, $x = 0, $y = 0, $width = null, $height = null)
	{
		$this->xlink__href = (string) $refId;
		$this->x = (float) $x;
		$this->y = (float) $y;

		if (!is_null($width) && !is_null($height))
		{
			$this->width = abs((float) $width);
			$this->height = abs((float) $height);
		}
	}
}