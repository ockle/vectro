<?php

namespace Vectro;

class ViewElement extends ElementAbstract
{
	/**
	 * Construct a <view> element.
	 * @param string $id Unique ID of the element
	 */
	public function __construct($id)
	{
		$this->id = (string) $id;
	}
}