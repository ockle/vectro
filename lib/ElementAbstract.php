<?php

namespace Vectro;

abstract class ElementAbstract
{
	private $attributes = array();
	private $children = array();

	/**
	 * Gets an attribute. A dedicated getter can be defined on a per-attribute basis.
	 * @param  string $name Name of the attribute to get
	 * @return mixed        Value of the attribute being gotten
	 */
	public function __get($name)
	{
		$replacedName = $this->replaceName($name);

		if (method_exists($this, 'get' . ucfirst($name)))
		{
			$method = 'get' . ucfirst($name);
			return $this->$method();
		}
		else if (isset($this->attributes[$replacedName]))
		{
			return $this->attributes[$replacedName];
		}
		else
		{
			return null;
		}
	}

	/**
	 * Sets an attribute. A dedicated setter can be defined on a per-attribute basis.
	 * @param string $name  Name of the attribute to set
	 * @param mixed  $value Value of the attribute being set
	 */
	public function __set($name, $value)
	{
		$replacedName = $this->replaceName($name);

		if (method_exists($this, 'set' . ucfirst($name)))
		{
			$method = 'set' . ucfirst($name);
			$this->$method($value);
		}
		else
		{
			$this->attributes[$replacedName] = $value;
		}
	}

	/**
	 * Checks whether an attribute is set.
	 * @param  string  $name Name of the attribute to check if set
	 * @return boolean       Whether or not the attribute is set
	 */
	public function __isset($name)
	{
		$replacedName = $this->replaceName($name);

		if (method_exists($this, 'get' . ucfirst($name)))
		{
			$method = 'get' . ucfirst($name);
			$value = $this->$method();

			if (!is_null($value) && !empty($value))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else if (isset($this->attributes[$replacedName]))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Unset an attribute.
	 * @param string $name Name of the attribute to unset
	 */
	public function __unset($name)
	{
		$replacedName = $this->replaceName($name);

		if (isset($this->attributes[$replacedName]))
		{
			unset($this->attributes[$replacedName]);
		}
	}

	/**
	 * Allows characters to be used in attributes that cannot be used in property names.
	 * @param  string $name Name of the property
	 * @return string       Name of the attribute
	 */
	private function replaceName($name)
	{
		return str_replace(array('__', '_'), array(':', '-'), $name);
	}

	/**
	 * Getter to return the list of children of the element.
	 * @return array Array of the element's children
	 */
	protected function getChildren()
	{
		return $this->children;
	}

	/**
	 * Getter to return the list of the attribute-value pairs of the element.
	 * @return array Array of the element's attribute-value pairs
	 */
	protected function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * Add a child to the element. Child must be an instance of Element, Comment, Xml, CData or of tpye string.
	 * @param  mixed $child The chld to be added to the element
	 * @return mixed        Returns self on success, boolean false on failure
	 */
	public function add($child)
	{
		if (($child instanceof ElementAbstract) || ($child instanceof Comment) || ($child instanceof Xml) || ($child instanceof CData) || (is_string($child)))
		{
			$this->children[] = $child;

			return $this;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Remove a child from the element.
	 * @param  mixed $child The child to be removed from the element
	 * @return mixed        Returns self on success, boolean false on failure
	 */
	public function remove($child)
	{
		$key = array_search($child, $this->children);

		if ($key !== false)
		{
			unset($this->children[$key]);

			return $this;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Add a style property-value pair to the element's style attribute.
	 * @param  string $attribute Name of the style property
	 * @param  string $value     Value of the style property
	 * @return self
	 */
	public function addStyle($attribute, $value)
	{
		$styleArray = $this->styleToArray();

		$styleArray[trim($attribute)] = trim($value);

		$this->arrayToStyle($styleArray);

		return $this;
	}

	/**
	 * Add multiple style proprty-value pairs to the element's style attribute at once.
	 * @param  array $styles Array of style property-value pairs, with the style property name as the array key and the style balue as the array value.
	 * @return self
	 */
	public function addStyles(array $styles)
	{
		$styleArray = $this->styleToArray();

		foreach ($styles as $attribute => $value)
		{
			$styleArray[trim($attribute)] = trim($value);
		}

		$this->arrayToStyle($styleArray);

		return $this;
	}

	/**
	 * Explodes the style attribute into an array of style property-value pairs.
	 * @return array The element's style attribute represented as an array of style property-value pairs
	 */
	private function styleToArray()
	{
		if (!isset($this->style))
		{
			return array();
		}

		$exploded = explode(';', $this->style);
		$styleArray = array();

		foreach ($exploded as $pair)
		{
			if (empty($pair))
			{
				break;
			}

			list($attribute, $value) = explode(':', trim($pair), 2); // Limit of 2 so that you can have values such as "progid:DXImageTransform.*" etc.
			$styleArray[trim($attribute)] = trim($value);
		}

		return $styleArray;
	}

	/**
	 * Implodes an array of style property-value pairs into the element's style attribute.
	 * @param  array  $styleArray An array of style property-value pairs
	 */
	private function arrayToStyle(array $styleArray)
	{
		$style = '';

		foreach ($styleArray as $attribute => $value)
		{
			$style .= $attribute . ': ' . $value . '; ';
		}

		$this->style = substr($style, 0, -1);
	}

	/**
	 * Apply a matrix transformation on the element.
	 * @param  float $a
	 * @param  float $b
	 * @param  float $c
	 * @param  float $d
	 * @param  float $e
	 * @param  float $f
	 * @return self
	 */
	public function matrix($a, $b, $c, $d, $e, $f)
	{
		$transformString = 'matrix(' . implode(', ', array_map('floatval', array($a, $b, $c, $d, $e, $f))) . ')';
		$this->addTransform($transformString);

		return $this;
	}

	/**
	 * Apply a translate transformation to the element.
	 * @param  float $x Value by which to translate on the x-axis
	 * @param  float $y Value by which to translate on the y-axis
	 * @return self
	 */
	public function translate($x, $y = 0)
	{
		$transformString = 'translate(' . (float) $x . ', ' . (float) $y . ')';
		$this->addTransform($transformString);

		return $this;
	}

	/**
	 * Apply a scale transformation to the element.
	 * @param  float $x Value by which to scale on the x-axis
	 * @param  float $y Value by which to scale on the y-axis
	 * @return self
	 */
	public function scale($x, $y = null)
	{
		$transformString = 'scale(' . (float) $x . ', ' . (($y !== null) ? (float) $y : (float) $x) . ')';
		$this->addTransform($transformString);

		return $this;
	}

	/**
	 * Apply a rotate transformation to the element.
	 * @param  float $angle Angle by which to rotate
	 * @param  float $cx    x-coordinate of the point about which the rotation will be performed
	 * @param  float $cy    y-coordinate of the point about which the rotation will be performed
	 * @return self
	 */
	public function rotate($angle, $cx = null, $cy = null)
	{
		$transformString = 'rotate(' . (float) $angle . (($cx !== null) ? ', ' . (float) $cx . ', ' . (($cy !== null) ? (float) $cy : (float) $cx) : '') . ')';
		$this->addTransform($transformString);

		return $this;
	}

	/**
	 * Apply a skew transformation to the element along the x-axis.
	 * @param  float $x Value by which to skew
	 * @return self
	 */
	public function skewX($x)
	{
		$transformString = 'skewX(' . (float) $x . ')';
		$this->addTransform($transformString);

		return $this;
	}

	/**
	 * Apply a skew transformation to the element along the y-axis.
	 * @param  float $y Value by which to skew
	 * @return self
	 */
	public function skewY($y)
	{
		$transformString = 'skewY(' . (float) $y . ')';
		$this->addTransform($transformString);

		return $this;
	}

	/**
	 * Separately apply a skew transformation to the element along the x-axis and the y-axis. Calls skewX and skewY sequentially.
	 * @param  float $x Value by which to skew along the x-axis
	 * @param  float $y Balue by which to skew along the y-axis
	 * @return self
	 */
	public function skewXY($x, $y)
	{
		$this->skewX($x)->skewY($y);

		return $this;
	}

	/**
	 * Adds a transformation to the element's transform attribute.
	 * @param string $transformString The transformation string to be added
	 */
	protected function addTransform($transformString)
	{
		if (!isset($this->transform))
		{
			$this->transform = $transformString;
		}
		else
		{
			$this->transform .= ' ' . $transformString;
		}
	}

	/**
	 * Sets a properly formed value for the element's viewBox attribute.
	 * @param  array  $viewBox A 4 value array containing the min-x, min-y, width and height of the viewBox, in that order
	 * @return bool            Whether or not a valid value for viewBox was able to be set
	 */
	public function viewBox(array $viewBox)
	{
		if (sizeof($viewBox) == 4)
		{
			$viewBox[0] = (float) $viewBox[0];
			$viewBox[1] = (float) $viewBox[1];
			$viewBox[2] = abs((float) $viewBox[2]);
			$viewBox[3] = abs((float) $viewBox[3]);

			$this->viewBox = implode(' ', $viewBox);

			return true;
		}

		return false;
	}
}