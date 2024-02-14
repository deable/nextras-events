<?php

declare(strict_types=1);

namespace Deable\NextrasEvents\Listeners;

use Nextras\Orm\Entity\IEntity;


interface AfterUpdateListener
{
	public function onAfterUpdate(IEntity $entity): void;
}
