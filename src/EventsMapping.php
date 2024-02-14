<?php

declare(strict_types=1);

namespace Deable\NextrasEvents;

use Deable\NextrasEvents\Attributes\AfterInsert;
use Deable\NextrasEvents\Attributes\AfterPersist;
use Deable\NextrasEvents\Attributes\AfterRemove;
use Deable\NextrasEvents\Attributes\AfterUpdate;
use Deable\NextrasEvents\Attributes\BeforeInsert;
use Deable\NextrasEvents\Attributes\BeforePersist;
use Deable\NextrasEvents\Attributes\BeforeRemove;
use Deable\NextrasEvents\Attributes\BeforeUpdate;
use Deable\NextrasEvents\Attributes\Flush;
use Deable\NextrasEvents\Attributes\Lifecycle;
use Deable\NextrasEvents\Listeners\AfterInsertListener;
use Deable\NextrasEvents\Listeners\AfterPersistListener;
use Deable\NextrasEvents\Listeners\AfterRemoveListener;
use Deable\NextrasEvents\Listeners\AfterUpdateListener;
use Deable\NextrasEvents\Listeners\BeforeInsertListener;
use Deable\NextrasEvents\Listeners\BeforePersistListener;
use Deable\NextrasEvents\Listeners\BeforeRemoveListener;
use Deable\NextrasEvents\Listeners\BeforeUpdateListener;
use Deable\NextrasEvents\Listeners\FlushListener;
use Nette\StaticClass;


final class EventsMapping
{
	use StaticClass;

	public static function get(): array
	{
		return [
			Lifecycle::class => [
				'onBeforeInsert' => BeforeInsertListener::class,
				'onBeforePersist' => BeforePersistListener::class,
				'onBeforeRemove' => BeforeRemoveListener::class,
				'onBeforeUpdate' => BeforeUpdateListener::class,
				'onAfterInsert' => AfterInsertListener::class,
				'onAfterPersist' => AfterPersistListener::class,
				'onAfterRemove' => AfterRemoveListener::class,
				'onAfterUpdate' => AfterUpdateListener::class,
				'onFlush' => FlushListener::class,
			],
			BeforeInsert::class => [
				'onBeforeInsert' => BeforeInsertListener::class,
			],
			BeforePersist::class => [
				'onBeforePersist' => BeforePersistListener::class,
			],
			BeforeRemove::class => [
				'onBeforeRemove' => BeforeRemoveListener::class,
			],
			BeforeUpdate::class => [
				'onBeforeUpdate' => BeforeUpdateListener::class,
			],
			AfterInsert::class => [
				'onAfterInsert' => AfterInsertListener::class,
			],
			AfterPersist::class => [
				'onAfterPersist' => AfterPersistListener::class,
			],
			AfterRemove::class => [
				'onAfterRemove' => AfterRemoveListener::class,
			],
			AfterUpdate::class => [
				'onAfterUpdate' => AfterUpdateListener::class,
			],
			Flush::class => [
				'onFlush' => FlushListener::class,
			]
		];
	}

}
