<?php

namespace Vectro;

class MaskElement extends ElementAbstract
{
	/**
	 * Construct a <mask> element.
	 * @param string $id Unique ID of the element
	 */
	public function __construct($id)
	{
		$this->id = (string) $id;
	}
}