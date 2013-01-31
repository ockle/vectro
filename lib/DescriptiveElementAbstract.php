<?php

namespace Vectro;

abstract class DescriptiveElementAbstract extends ElementAbstract
{
	/**
	 * Construct a "descriptive element" i.e. <desc>, <metadata> or <title>.
	 * @param mixed $content The content of the element. Should be of type string or an instance of Xml.
	 */
	public function __construct($content)
	{
		if (is_string($content) || ($content instanceof Xml))
		{
			$this->add($content);
		}
	}
}