<?php

namespace Vectro;

class LinearGradientElement extends GradientElementAbstract
{
	/**
	 * Construct a <linearGradient> element.
	 * @param string $id    Unique ID of the element
	 * @param float  $fromX x-coordinate of the start point of the gradient, as a portion of the width of the element applying the gradient. Should be in the range 0-1
	 * @param float  $fromY y-coordinate of the start point of the gradient, as a portion of the width of the element applying the gradient. Should be in the range 0-1
	 * @param float  $toX   x-coordinate of the end point of the gradient, as a portion of the width of the element applying the gradient. Should be in the range 0-1
	 * @param float  $toY   y-coordinate of the end point of the gradient, as a portion of the width of the element applying the gradient. Should be in the range 0-1
	 */
	public function __construct($id, $fromX = 0, $fromY = 0, $toX = 1, $toY = 0)
	{
		$this->id = (string) $id;

		$this->x1 = (float) $fromX;
		$this->y1 = (float) $fromY;
		$this->x2 = (float) $toX;
		$this->x2 = (float) $toY;
	}
}