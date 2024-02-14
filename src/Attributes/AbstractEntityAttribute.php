<?php

declare(strict_types=1);

namespace Deable\NextrasEvents\Attributes;


abstract class AbstractEntityAttribute
{
	public string $class;

	public function __construct(string $class)
	{
		$this->class = $class;
	}
}
