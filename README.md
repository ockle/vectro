# Vectro

A library designed to aid in the dynamic creation of SVG images in PHP.

## Basic Usage

Each SVG element is represented by its own class. First, you will need an outermost `<svg>` element, which is done like so:

```php
$svg = new Vectro\SvgElement(100, 100); // A 100x100 pixel SVG image
```

Then, you can define whatever elements you need to. For a `<circle>`, for example:

```php
$circle = new Vectro\CircleElement(50, 50, 25); // A circle with its center at co-ordinates 50,50 and a radius of 25
```

In Vectro, element attributes are set via object properties, so if you wanted to apply `fill` to the `<circle>`:

```php
$circle->fill = 'red';
```

If you need to set an attribute with a hyphen in it, replace the hyphen with an underscore in the property name:

```php
$circle->stroke = 'black';
$circle->stroke_width = '3';
```

If you would prefer to use the `style` attribute for element styling rather than individual attributes, Vectro provides a couple of methods to facilitate this:

```php
$circle->addStyle('fill', 'red');
$circle->addStyles(array('stroke' => 'black', 'stroke-width' => '3px'));
```

Then the `<circle>` needs to be made a child of the outermost `<svg>`:

```php
$svg->add($circle);
```

When you've finished constructing your SVG, you use it to create an instance of `Vectro\Document` and use the `output()` method to output the SVG string:

```php
$document = new Vectro\Document($svg);
// Then optionally serve the string as SVG
header('content-type: image/svg+xml');
echo $document->output();
```

## Requirements

* PHP 5.3+
* libxml extension

## License

Vectro is released under the MIT license