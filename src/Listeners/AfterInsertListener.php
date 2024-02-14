<?php

declare(strict_types=1);

namespace Deable\NextrasEvents\Listeners;

use Nextras\Orm\Entity\IEntity;


interface AfterInsertListener
{
	public function onAfterInsert(IEntity $entity): void;
}
