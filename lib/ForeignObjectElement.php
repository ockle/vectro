<?php

namespace Vectro;

class ForeignObjectElement extends ElementAbstract
{
	/**
	 * Construct a <foreignObject> element.
	 * @param Xml   $content Content of the element.
	 * @param float $width   Width of the rectangular region into which the content is placed
	 * @param float $height  Height of the rectangular region into which the content is placed
	 * @param float $x       x-coordinate of the top left of the rectangular region
	 * @param float $y       y-coordinate of the top left of the rectangular region
	 */
	public function __construct(Xml $content, $width, $height, $x = 0, $y = 0)
	{
		$this->add($content);
		$this->width = abs((float) $width);
		$this->height = abs((float) $height);
		$this->x = (float) $x;
		$this->y = (float) $y;
	}
}