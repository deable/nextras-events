<?php

declare(strict_types=1);

namespace Deable\NextrasEvents\Listeners;


interface LifecycleListener extends
	BeforeInsertListener,
	BeforePersistListener,
	BeforeRemoveListener,
	BeforeUpdateListener,
	AfterInsertListener,
	AfterPersistListener,
	AfterRemoveListener,
	AfterUpdateListener,
	FlushListener
{

}
