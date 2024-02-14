<?php

declare(strict_types=1);

namespace Deable\NextrasEvents\Listeners;

use Nextras\Orm\Entity\IEntity;


class LifecycleListenerAdapter implements LifecycleListener
{

	public function onAfterInsert(IEntity $entity): void
	{
	}

	public function onAfterPersist(IEntity $entity): void
	{
	}

	public function onAfterRemove(IEntity $entity): void
	{
	}

	public function onAfterUpdate(IEntity $entity): void
	{
	}

	public function onBeforeInsert(IEntity $entity): void
	{
	}

	public function onBeforePersist(IEntity $entity): void
	{
	}

	public function onBeforeRemove(IEntity $entity): void
	{
	}

	public function onBeforeUpdate(IEntity $entity): void
	{
	}

	public function onFlush(array $persisted, array $removed): void
	{
	}

}
