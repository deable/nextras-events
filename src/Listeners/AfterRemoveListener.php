<?php

declare(strict_types=1);

namespace Deable\NextrasEvents\Listeners;

use Nextras\Orm\Entity\IEntity;


interface AfterRemoveListener
{
	public function onAfterRemove(IEntity $entity): void;
}
