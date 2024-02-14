<?php

declare(strict_types=1);

namespace Deable\NextrasEvents\Listeners;

use Nextras\Orm\Entity\IEntity;


interface BeforeInsertListener
{
	public function onBeforeInsert(IEntity $entity): void;
}
