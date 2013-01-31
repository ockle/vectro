<?php

namespace Vectro;

class SvgElement extends ElementAbstract
{
	/**
	 * Construct a <svg> element
	 * @param float   $width     Width of the SVG document
	 * @param float   $height    Height of the SVG document
	 * @param array   $viewBox   A 4 value array containing the min-x, min-y, width and height of the viewBox, in that order. Defaults to match the dimensions of element as defined by $width and $height
	 * @param boolean $outermost Whether or not it is the outermost <svg> element, of which there can only be one. If constructing an <svg> element to define a new viewport, set this to false
	 */
	public function __construct($width, $height, array $viewBox = array(), $outermost = true)
	{
		$this->width = abs((float) $width);
		$this->height = abs((float) $height);
		if (empty($viewBox))
		{
			$viewBox = array(0, 0, $this->width, $this->height);
		}
		$this->viewBox($viewBox);

		if ($outermost)
		{	
			$this->version = 1.1;
			$this->xmlns = 'http://www.w3.org/2000/svg';
			$this->xmlns__xlink = 'http://www.w3.org/1999/xlink';
		}
	}
}