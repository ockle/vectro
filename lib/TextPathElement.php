<?php

namespace Vectro;

class TextPathElement extends ElementAbstract
{
	/**
	 * Construct a <textPath> element.
	 * @param mixed  $text   The content of the element
	 * @param string $pathId ID of the path to be used
	 */
	public function __construct($text, $pathId)
	{
		$this->add($text);
		$this->xlink__href = (string) $pathId;
	}
}