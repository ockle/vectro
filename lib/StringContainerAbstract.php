<?php

namespace Vectro;

/**
 * Used for classes that only serve to hold a string, but determine how that string is used in the XML i.e. as a comment, CDATA or an XML document fragment
 */
class StringContainerAbstract
{
	private $text;

	public function __construct($text)
	{
		if (is_string($text))
		{
			$this->text = $text;
		}
	}

	public function __toString()
	{
		return $this->text;
	}
}