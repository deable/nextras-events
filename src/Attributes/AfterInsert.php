<?php

declare(strict_types=1);

namespace Deable\NextrasEvents\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class AfterInsert extends AbstractEntityAttribute
{

}
