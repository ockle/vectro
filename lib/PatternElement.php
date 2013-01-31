<?php

namespace Vectro;

class PatternElement extends ElementAbstract
{
	/**
	 * Construct a <pattern> element.
	 * @param string $id     Unique ID of the element
	 * @param float  $width  Width of the pattern tile
	 * @param float  $height Height of the pattern tile
	 * @param float  $x      x-coordinate of the top left corner of the starting pattern tile
	 * @param float  $y      y-coordinate of the top left corner of the starting pattern tile
	 */
	public function __construct($id, $width, $height, $x = 0, $y = 0)
	{
		$this->id = (string) $id;
		$this->width = abs((float) $width);
		$this->height = abs((float) $height);
		$this->x = (float) $x;
		$this->y = (float) $y;
		$this->patternUnits = 'userSpaceOnUse';
	}

	/**
	 * Overload the base ElementAbstract function to apply the transform to the patternTransform attribute instead of the transform attribute.
	 * @param string $transformString {@inheritdoc}
	 */
	protected function addTransform($transformString)
	{
		if (!isset($this->patternTransform))
		{
			$this->patternTransform = $transformString;
		}
		else
		{
			$this->patternTransform .= ' ' . $transformString;
		}
	}
}