<?php

namespace Vectro;

abstract class PolyElementAbstract extends ElementAbstract
{
	/**
	 * Construct an element that uses multiple points i.e. <polygon> and <polyline>.
	 * @param float $x x-coordinate of the start point
	 * @param float $y y-coordinate of the start point
	 */
	public function __construct($x, $y)
	{
		$this->point($x, $y);
		$this->points = trim($this->points);
	}

	/**
	 * Add a point.
	 * @param  float $x x-coordinate of the point to add
	 * @param  float $y y-coordinate of the point to add
	 * @return self
	 */
	public function point($x, $y)
	{
		$this->points .= ' ' . (float) $x . ',' . (float) $y;

		return $this;
	}
}