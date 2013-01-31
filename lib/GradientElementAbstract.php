<?php

namespace Vectro;

abstract class GradientElementAbstract extends ElementAbstract
{
	/**
	 * Shortcut for adding a new <stop> element to the gradient.
	 * @param  float   $offset     Value of the offset from the start of the gradient
	 * @param  string  $color      Color of the gradient stop
	 * @param  float   $opacity    Opacity of the gradient stop
	 * @param  boolean $percentage If true, $offset and $opacity should be in the range 0-100, else in the rangle 0-1
	 * @return self
	 */
	public function stop($offset, $color, $opacity = 100, $percentage = true)
	{
		$stop = new StopElement($offset, $color, $opacity, $percentage);
		$this->add($stop);

		return $this;
	}

	/**
	 * Overload the base ElementAbstract function to apply the transform to the gradientTransform attribute instead of the transform attribute.
	 * @param string $transformString {@inheritdoc}
	 */
	protected function addTransform($transformString)
	{
		if (!isset($this->gradientTransform))
		{
			$this->gradientTransform = $transformString;
		}
		else
		{
			$this->gradientTransform .= ' ' . $transformString;
		}
	}
}