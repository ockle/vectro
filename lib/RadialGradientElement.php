<?php

namespace Vectro;

class RadialGradientElement extends GradientElementAbstract
{
	/**
	 * Construct a <radialGradient> element.
	 * @param string $id      Unique ID of the element
	 * @param float  $centerX x-coordinate of the center point of the circle containing the gradient, as a portion of the width of the element applying the gradient. Should be in the range 0-1
	 * @param float  $centerY y-coordinate of the center point of the circle containing the gradient, as a portion of the width of the element applying the gradient. Should be in the range 0-1
	 * @param float  $radius  Radius of the circle containing the gradient, as a portion of the width of the element applying the gradient. Should be in the range 0-1
	 * @param float  $focalX  x-coordinate of the focus point of the gradient i.e. where a <stop> with offset 0 will be. If not defined then it will be the same as $centerX
	 * @param float  $focalY  y-coordinate of the focus point of the gradient i.e. where a <stop> with offset 0 will be. If not defined then it will be the same as $centerY
	 */
	public function __construct($id, $centerX = 0.5, $centerY = 0.5, $radius = 0.5, $focalX = null, $focalY = null)
	{
		$this->id = (string) $id;

		$this->cx = (float) $centerX;
		$this->cy = (float) $centerY;
		$this->r = abs((float) $radius);

		if (!is_null($focalX) && !is_null($focalY))
		{
			$this->fx = (float) $focalX;
			$this->fy = (float) $focalY;
		}
	}
}