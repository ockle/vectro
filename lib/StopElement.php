<?php

namespace Vectro;

class StopElement extends ElementAbstract
{
	/**
	 * Construct a <stop> element.
	 * @param float   $offset     Value of the offset from the start of the gradient
	 * @param string  $color      Color of the gradient stop
	 * @param float   $opacity    Opacity of the gradient stop
	 * @param boolean $percentage If true, $offset and $opacity should be in the range 0-100, else in the rangle 0-1
	 */
	public function __construct($offset, $color, $opacity = 100, $percentage = true)
	{
		$this->offset = $offset . ($percentage ? '%' : '');
		$this->stop_color = $color;
		$this->stop_opacity = $opacity . ($percentage ? '%' : '');
	}
}