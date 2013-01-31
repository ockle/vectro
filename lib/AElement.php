<?php

namespace Vectro;

class AElement extends ElementAbstract
{
	/**
	 * Create an <a> element.
	 * @param string $link The link target
	 */
	public function __construct($link)
	{
		$this->xlink__href = (string) $link;
	}
}