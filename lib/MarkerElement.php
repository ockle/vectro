<?php

namespace Vectro;

class MarkerElement extends ElementAbstract
{
	/**
	 * Construct a <marker> element.
	 * @param string  $id      Unique ID of the element
	 * @param float   $width   Width of the viewport into which the marker is to be fitted when it is rendered
	 * @param float   $height  Height of the viewport into which the marker is to be fitted when it is rendered
	 * @param float   $refX    x-axis coordinate of the reference point which is to be aligned exactly at the marker position
	 * @param float   $refY    y-axis coordinate of the reference point which is to be aligned exactly at the marker position
	 * @param mixed   $orient  How the marker should be oriented. Value should be either 'auto' or angle of type float
	 */
	public function __construct($id, $width, $height, $refX = 0, $refY = 0, $orient = 'auto')
	{
		$this->id = (string) $id;
		$this->markerWidth = abs((float) $width);
		$this->markerHeight = abs((float) $height);
		$this->refX = (float) $refX;
		$this->refY = (float) $refY;
		$this->orient = ($orient === 'auto') ? $orient : (float) $orient;
	}
}