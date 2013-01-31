<?php

namespace Vectro;

class TextElement extends ElementAbstract
{
	/**
	 * Construct a <text> element.
	 * @param mixed   $text     The content of the element
	 * @param mixed   $x        A list of values specifying the x-coordinates (or if $relative is true, then the value along the x-axis from the current point) of each character in $text
	 * @param mixed   $y        A list of values specifying the y-coordinates (or if $relative is true, then the value along the x-axis from the current point) of each character in $text
	 * @param boolean $relative Whether or not the values in $x and $y are absolute coordinates or relative values
	 */
	public function __construct($text, $x = null, $y = null, $relative = false)
	{
		$this->add($text);

		if (!is_null($x))
		{
			$this->setListOfValues($x, ($relative) ? 'dx' : 'x');
		}

		if (!is_null($y))
		{
			$this->setListOfValues($y, ($relative) ? 'dy' : 'y');
		}
	}

	/**
	 * Rotate each character by a given angle.
	 * @param  mixed $angle A list of angles specifying the rotation of each charcter in the element's content
	 * @return self
	 */
	public function rotateChars($angle)
	{
		$this->setListOfValues($angle, 'rotate');

		return $this;
	}

	/**
	 * Set the length of the rectangle into which the text will fit, stretching if required.
	 * @param  float   $length           Length of the rectangle into which the text will fit
	 * @param  boolean $spacingAndGlyphs So that the text reaches its required length, if true, each character will be stretched, if false, the characters will be spaced out
	 * @return self
	 */
	public function length($length, $spacingAndGlyphs = false)
	{
		$this->textLength = abs((float) $length);

		$this->lengthAdjust = ($spacingAndGlyphs) ? 'spacingAndGlyphs' : 'spacing';

		return $this;
	}

	/**
	 * Takes a list of values used in defining some of a textual element's attributes, formats the value or values correctly and then sets the attribute.
	 * @param mixed  $list      List of values, or a single value
	 * @param string $attribute Name of the attribute to be set
	 */
	protected function setListOfValues($list, $attribute)
	{
		if (is_array($list))
		{
			$list = array_map('floatval', $list);

			$this->$attribute = implode(' ', $list);
		}
		else
		{
			$this->$attribute = (float) $list;
		}
	}
}