<?php

namespace Vectro;

class ClipPathElement extends ElementAbstract
{
	/**
	 * Construct a <clipPath> element.
	 * @param string $id Unique ID of the element
	 */
	public function __construct($id)
	{
		$this->id = (string) $id;
	}
}