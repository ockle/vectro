<?php

namespace Vectro;

class Document
{
	private $svg;
	private $dom;

	/**
	 * Create an SVG document.
	 * @param SvgElement $svg The outermost SVG element
	 */
	public function __construct(SvgElement $svg)
	{
		$imp = new \DOMImplementation;
		$dtd = $imp->createDocumentType('svg', '-//W3C//DTD SVG 1.1//EN', 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd');
		$this->dom = $imp->createDocument('', '', $dtd);

		$this->dom->formatOutput = true;
		$this->svg = $svg;
	}

	/**
	 * Output the generated XML.
	 * @param  boolean $inline Whether or not the SVG is to be embedded in a containing document e.g. HTML, in which case the XML declaration and DTD are omitted
	 * @return string          The resultant XML
	 */
	public function output($inline = false)
	{
		$outermostSvgNode = $this->dom->appendChild($this->outputChildren($this->svg));

		return (!$inline) ? $this->dom->saveXML() : $this->dom->saveXML($outermostSvgNode);
	}

	/**
	 * Passes through the result of DOMDocument's validate function. This validates the document against the DTD. It is slow and should only be used in production.
	 * @return boolean The result of the validation
	 */
	public function validate()
	{
		return $this->dom->validate();
	}

	/**
	 * Recursively generate the XML for each element.
	 * @param  mixed $element The element to be outputted
	 * @return DOMElement     A node of XML to be appended
	 */
	private function outputChildren($element)
	{
		$name = explode('\\', get_class($element));
		$node = $this->dom->createElement(lcfirst(str_replace('Element', '', end($name))));

		foreach ($element->attributes as $name => $value)
		{
			$attr = $this->dom->createAttribute($name);
			$attr->value = $value;
			$node->appendChild($attr);
		}

		foreach ($element->children as $child)
		{
			if ($child instanceof ElementAbstract)
			{
				$node->appendChild($this->outputChildren($child));
			}
			elseif ($child instanceof Comment)
			{
				$node->appendChild($this->dom->createComment($child));
			}
			elseif ($child instanceof CData)
			{
				$node->appendChild($this->dom->createCDATASection($child));
			}
			elseif ($child instanceof Xml)
			{
				$fragment = $this->dom->createDocumentFragment();
				$fragment->appendXML($child);
				$node->appendChild($fragment);
			}
			elseif (is_string($child))
			{
				$node->appendChild($this->dom->createTextNode($child));
			}
		}

		return $node;
	}
}