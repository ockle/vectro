<?php

namespace Vectro;

class PathElement extends ElementAbstract
{
	private $currentCommand;

	/**
	 * Construct a <path> element.
	 * @param float $x x-coordinate of the start point of the path
	 * @param float $y y-coordinate of the start point of the path
	 */
	public function __construct($x, $y)
	{
		$this->moveTo($x, $y);
		$this->d = trim($this->d);
	}

	/**
	 * Adds a command to the element's d attribute
	 * @param  string  $command    The name of the command
	 * @param  string  $string     The value of the command
	 * @param  boolean $checkClose Whether to check that the last command was a close command. Only move commands should not do this as they are the only ones that may follow a close command
	 */
	private function addCommand($command, $string = '', $checkClose = true)
	{
		if ($checkClose)
		{
			if ($this->currentCommand !== 'Z')
			{
				return null;
			}
		}

		$this->d .= ' ' . (($this->currentCommand != $command) ? $command : '') . $string;
		$this->currentCommand = $command;
	}

	/**
	 * Issue an absolute moveto command.
	 * @param  float $x x-coordinate of the point to move to
	 * @param  float $y y-coordinate of the point to move to
	 * @return self
	 */
	public function moveTo($x, $y)
	{
		$this->addCommand('M', (float) $x . ',' . (float) $y, false);

		return $this;
	}

	/**
	 * Issue a relative moveto command.
	 * @param  float $dx From the current point, the value along the x-axis to move by
	 * @param  float $dy From the current point, the value along the y-axis to move by
	 * @return self
	 */
	public function moveBy($dx, $dy)
	{
		$this->addCommand('m', (float) $dx . ',' . (float) $dy, false);

		return $this;
	}

	/**
	 * Issue an absolute line command.
	 * @param  float $x x-coordinate of the point to draw a line to
	 * @param  float $y y-coordinate of the point to draw a line to
	 * @return self
	 */
	public function lineTo($x, $y)
	{
		$this->addCommand('L', (float) $x . ',' . (float) $y);

		return $this;
	}

	/**
	 * Issue a relative line command.
	 * @param  float $dx From the current point, the value along the x-axis to draw a line to
	 * @param  float $dy From the current point, the value along the y-axis to draw a line to
	 * @return self
	 */
	public function lineBy($dx, $dy)
	{
		$this->addCommand('l', (float) $dx . ',' . (float) $dy);

		return $this;
	}

	/**
	 * Issue an absolute horizontal line command.
	 * @param  float $x x-coordinate of the point to draw a line to. The y-coordinate will be the same as the y-coordrinate of the current point
	 * @return self
	 */
	public function hLineTo($x)
	{
		$this->addCommand('H', (float) $x);

		return $this;
	}

	/**
	 * Issue a relative horizontal line command.
	 * @param  float $dx From the current point, the value along the x-axis to draw a line to. The y-coordinate will be the same as the y-coordrinate of the current point
	 * @return self
	 */
	public function hLineBy($dx)
	{
		$this->addCommand('h', (float) $dx);

		return $this;
	}

	/**
	 * Issue an absolute vertical line command.
	 * @param  float $y y-coordinate of the point to draw a line to. The x-coordinate will be the same as the x-coordrinate of the current point
	 * @return self
	 */
	public function vLineTo($y)
	{
		$this->addCommand('V', (float) $y);

		return $this;
	}

	/**
	 * Issue a relative vertical line command.
	 * @param  float $dy From the current point, the value along the y-axis to draw a line to. The x-coordinate will be the same as the x-coordrinate of the current point
	 * @return self
	 */
	public function vLineBy($dy)
	{
		$this->addCommand('v', (float) $dy);

		return $this;
	}

	/**
	 * Issue an absolute quadratic curve command.
	 * @param  float $x  x-coordinate of the point to curve to
	 * @param  float $y  y-coordinate of the point to curve to
	 * @param  float $cx x-coordinate of the point to use as a control point
	 * @param  float $cy y-coordinate of the point to use as a control point
	 * @return self
	 */
	public function qCurveTo($x, $y, $cx, $cy)
	{
		$this->addCommand('Q', (float) $cx . ',' . (float) $cy . ' ' . (float) $x . ',' . (float) $y);

		return $this;
	}

	/**
	 * Issue a relative quadratic curve command.
	 * @param  float $dx  From the current point, the value along the x-axis to curve to
	 * @param  float $dy  From the current point, the value along the y-axis to curve to
	 * @param  float $cdx From the current point, the value along the x-axis to use as a control point
	 * @param  float $cdy From the current point, the value along the y-axis to use as a control point
	 * @return self
	 */
	public function qCurveBy($dx, $dy, $cdx, $cdy)
	{
		$this->addCommand('q', (float) $cdx . ',' . (float) $cdy . ' ' . (float) $dx . ',' . (float) $dy);

		return $this;
	}

	/**
	 * Issue an absolute smooth quadratic curve command.
	 * @param  float $x x-coordinate of the point to curve to
	 * @param  float $y y-coordinate of the point to curve to
	 * @return self
	 */
	public function qSmoothCurveTo($x, $y)
	{
		$this->addCommand('T', (float) $x . ',' . (float) $y);

		return $this;
	}

	/**
	 * Issue a relative smooth quadratic curve command.
	 * @param  float $dx From the current point, the value along the x-axis to curve to
	 * @param  float $dy From the current point, the value along the y-axis to curve to
	 * @return self
	 */
	public function qSmoothCurveBy($dx, $dy)
	{
		$this->addCommand('t', (float) $dx . ',' . (float) $dy);

		return $this;
	}

	/**
	 * Issue an absolute cubic curve command.
	 * @param  float $x   x-coordinate of the point to curve to
	 * @param  float $y   y-coordinate of the point to curve to
	 * @param  float $c1x x-coordinate of the point to use as a control point at the beginning of the line
	 * @param  float $c1y y-coordinate of the point to use as a control point at the beginning of the line
	 * @param  float $c2x x-coordinate of the point to use as a control point at the end of the line
	 * @param  float $c2y y-coordinate of the point to use as a control point at the end of the line
	 * @return self
	 */
	public function cCurveTo($x, $y, $c1x, $c1y, $c2x, $c2y)
	{
		$this->addCommand('C', (float) $c1x . ',' . (float) $c1y . ' ' . (float) $c2x . ',' . (float) $c2y . ' ' . (float) $x . ',' . (float) $y);

		return $this;
	}

	/**
	 * Issue a relative cubic curve command.
	 * @param  float $dx   From the current point, the value along the x-axis to curve to
	 * @param  float $dy   From the current point, the value along the y-axis to curve to
	 * @param  float $c1dx From the current point, the value along the x-axis to use as a control point at the beginning of the line
	 * @param  float $c1dy From the current point, the value along the y-axis to use as a control point at the beginning of the line
	 * @param  float $c2dx From the current point, the value along the x-axis to use as a control point at the end of the line
	 * @param  float $c2dy From the current point, the value along the y-axis to use as a control point at the end of the line
	 * @return self
	 */
	public function cCurveBy($dx, $dy, $c1dx, $c1dy, $c2dx, $c2dy)
	{
		$this->addCommand('c', (float) $c1dx . ',' . (float) $c1dy . ' ' . (float) $c2dx . ',' . (float) $c2dy . ' ' . (float) $dx . ',' . (float) $dy);

		return $this;
	}

	/**
	 * Issue an absolute smooth cubic curve command.
	 * @param  float $x   x-coordinate of the point to curve to
	 * @param  float $y   y-coordinate of the point to curve to
	 * @param  float $c2x x-coordinate of the point to use as a control point at the end of the line
	 * @param  float $c2y y-coordinate of the point to use as a control point at the end of the line
	 * @return self
	 */
	public function cSmoothCurveTo($x, $y, $c2x, $c2y)
	{
		$this->addCommand('S', (float) $c2x . ',' . (float) $c2y . ' ' . (float) $x . ',' . (float) $y);

		return $this;
	}

	/**
	 * Issue a relative smooth cubic curve command.
	 * @param  float $dx   From the current point, the value along the x-axis to curve to
	 * @param  float $dy   From the current point, the value along the y-axis to curve to
	 * @param  float $c2dx From the current point, the value along the x-axis to use as a control point at the end of the line
	 * @param  float $c2dy From the current point, the value along the y-axis to use as a control point at the end of the line
	 * @return self
	 */
	public function cSmoothCurveBy($dx, $dy, $c2dx, $c2dy)
	{
		$this->addCommand('s', (float) $c2dx . ',' . (float) $c2dy . ' ' . (float) $dx . ',' . (float) $dy);

		return $this;
	}

	/**
	 * Issue an absolute arc command.
	 * @param  float   $x         x-coordinate of the point to curve to
	 * @param  float   $y         y-coordinate of the point to curve to
	 * @param  float   $rx        x-axis radius of the ellipse used to define the curve
	 * @param  float   $ry        y-axis radius of the ellipse used to define the curve
	 * @param  float   $angle     The angle by which the ellipse used to define the curve is rotated
	 * @param  integer $large     Flag indicating whether the large arc or the small arc is used. Set to 0 for the small arc and 1 for the large arc
	 * @param  integer $direction Flag indicating which direction to sweep round the ellipse. Set to 0 for counter-clockwise and 1 for clokwise
	 * @return self
	 */
	public function arcTo($x, $y, $rx, $ry, $angle, $large = 0, $direction = 1)
	{
		$this->addCommand('A', abs((float) $rx) . ',' . abs((float) $ry) . ' ' . (float) $angle . ' ' . (int) (bool) $large . ' ' . (int) (bool) $direction . ' ' . (float) $x . ',' . (float) $y);

		return $this;
	}

	/**
	 * Issue a relative arc command.
	 * @param  float   $dx        From the current point, the value along the x-axis to curve to
	 * @param  float   $dy        From the current point, the value along the y-axis to curve to
	 * @param  float   $rx        From the current point, the value along the x-axis of the radius of the ellipse used to define the curve
	 * @param  float   $ry        From the current point, the value along the y-axis of the radius of the ellipse used to define the curve
	 * @param  float   $angle     The angle by which the ellipse used to define the curve is rotated
	 * @param  integer $large     Flag indicating whether the large arc or the small arc is used. Set to 0 for the small arc and 1 for the large arc
	 * @param  integer $direction Flag indicating which direction to sweep round the ellipse. Set to 0 for counter-clockwise and 1 for clokwise
	 * @return self
	 */
	public function arcBy($dx, $dy, $rx, $ry, $angle, $large = 0, $direction = 1)
	{
		$this->addCommand('a', abs((float) $rx) . ',' . abs((float) $ry) . ' ' . (float) $angle . ' ' . (int) (bool) $large . ' ' . (int) (bool) $direction . ' ' . (float) $dx . ',' . (float) $dy);

		return $this;
	}

	/**
	 * Issue a close command.
	 * @return self
	 */
	public function close()
	{
		$this->addCommand('Z');

		return $this;
	}
}