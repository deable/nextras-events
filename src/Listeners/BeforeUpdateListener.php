<?php

declare(strict_types=1);

namespace Deable\NextrasEvents\Listeners;

use Nextras\Orm\Entity\IEntity;


interface BeforeUpdateListener
{
	public function onBeforeUpdate(IEntity $entity): void;
}
