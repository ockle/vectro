<?php

namespace Vectro;

class ScriptElement extends ElementAbstract
{
	/**
	 * Construct a <script> element.
	 * @param string $script Content of the script or link to an external script, depending on the setting of $link
	 * @param string $link   Whether or not $script is a link to an external script
	 * @param string $type   MIME type of the script
	 */
	public function __construct($script, $link = false, $type = 'application/javascript')
	{
		if (!$link)
		{
			$this->add(new CData($script));
		}
		else
		{
			$this->xlink__href = (string) $link;
		}

		$this->type = (string) $type;
	}
}