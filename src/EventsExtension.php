<?php

declare(strict_types=1);

namespace Deable\NextrasEvents;

use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\ServiceDefinition;
use Nette\DI\ServiceCreationException;
use Nextras\Orm\Repository\IRepository;
use ReflectionClass;
use ReflectionException;


final class EventsExtension extends CompilerExtension
{

	/**
	 * @throws ReflectionException
	 */
	public function beforeCompile(): void
	{
		$eventsMapping = EventsMapping::get();
		$entityMapping = $this->loadEntityMapping();

		$builder = $this->getContainerBuilder();
		foreach ($entityMapping as $entity => $repository) {
			if (!class_exists($entity)) {
				throw new ServiceCreationException("Entity class '$entity' not found");
			}

			$types = [$entity];
			$uses = class_uses($entity);
			if ($uses !== false) {
				$types = $uses + [$entity];
			}
			foreach ($types as $type) {
				$reflection = new ReflectionClass($type);
				$builder->addDependency($reflection);

				foreach ($reflection->getAttributes() as $attribute) {
					$events = $eventsMapping[$attribute->getName()] ?? null;
					if ($events !== null) {
						$this->loadListenerByAttribute($events, $repository, $attribute->getArguments());
					}
				}
			}
		}
	}

	/**
	 * @return array<string, string>
	 */
	private function loadEntityMapping(): array
	{
		$mapping = [];

		$builder = $this->getContainerBuilder();
		$repositories = $builder->findByType(IRepository::class);

		foreach ($repositories as $repository) {
			assert($repository instanceof ServiceDefinition);

			$repositoryClass = $repository->getType();
			if (!class_exists($repositoryClass)) {
				throw new ServiceCreationException("Repository class '$repositoryClass' not found");
			}
			if (!method_exists($repositoryClass, 'getEntityClassNames')) {
				continue;
			}
			foreach ($repositoryClass::getEntityClassNames() as $entity) {
				$mapping[$entity] = $repositoryClass;
			}
		}

		return $mapping;
	}

	/**
	 * @param array $events
	 * @param string $repository
	 * @param string[] $arguments
	 *
	 * @throws ReflectionException
	 */
	private function loadListenerByAttribute(array $events, string $repository, array $arguments): void
	{
		$builder = $this->getContainerBuilder();

		$repositoryName = $builder->getByType($repository);
		if ($repositoryName === null) {
			throw new ServiceCreationException("Repository service '$repository' not found");
		}

		[$listener] = $arguments;
		$listenerName = $builder->getByType($listener);
		if ($listenerName === null) {
			throw new ServiceCreationException("Listener service '$listener' not found");
		}

		$repositoryDefinition = $builder->getDefinition($repositoryName);
		assert($repositoryDefinition instanceof ServiceDefinition);
		$listenerDefinition = $builder->getDefinition($listenerName);

		$reflection = new ReflectionClass($listener);
		foreach ($events as $event => $interface) {
			if (!$reflection->implementsInterface($interface)) {
				throw new ServiceCreationException("Object '$listener' should implement '$interface'");
			}

			$repositoryDefinition->addSetup('$service->?[] = function() {call_user_func_array([?, ?], func_get_args());}', [
				$event, $listenerDefinition, $event,
			]);
		}
	}

}
