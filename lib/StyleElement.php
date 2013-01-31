<?php

namespace Vectro;

class StyleElement extends ElementAbstract
{
	/**
	 * Construct a <style> element.
	 * @param string $style Content of the stylesheet
	 */
	public function __construct($style)
	{
		$this->add(new CData($style));
	}
}