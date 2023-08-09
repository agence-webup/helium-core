<?php

namespace Webup\HeliumCore;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Expression;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webup\HeliumCore\Commands\Publish;

class HeliumCoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('helium-core')
            ->hasConfigFile('helium-core')
            ->hasViews('helium-core')
            ->hasCommand(Publish::class);

        $filename = config('helium-core.routing.filename');
        $routes = base_path("routes/{$filename}.php");
        if (file_exists($routes)) {
            $this->loadRoutesFrom($routes);
        }
    }

    public function registeringPackage()
    {
        $this->registerDatatableMacros();
    }

    private function registerDatatableMacros()
    {
        EloquentBuilder::macro('customWithAggregate', function ($relations, $aggregate, $column, $alias = null) {
            if (empty($relations)) {
                return $this;
            }

            $relations = is_array($relations) ? $relations : [$relations];

            foreach ($this->parseWithRelations($relations) as $name => $constraints) {
                $segments = explode(' ', $name);

                if (count($segments) == 3 && Str::lower($segments[1]) == 'as') {
                    [$name, $alias] = [$segments[0], $segments[2]];
                }

                $relation = $this->getRelationWithoutConstraints($name);

                $table = $relation->getRelated()->newQuery()->getQuery()->from === $this->getQuery()->from
                    ? $relation->getRelationCountHashWithoutIncrementing()
                    : ($this->query->getConnection()->getTablePrefix() ?? '').$relation->getRelated()->getTable();

                $query = $relation->getRelationExistenceAggregatesQuery(
                    $relation->getRelated()->newQuery(),
                    $this,
                    $aggregate,
                    $table.'.'.($column ?? 'id')
                );

                $query->callScope($constraints);

                $query = $query->mergeConstraintsFrom($relation->getQuery())->toBase();

                if (count($query->columns) > 1) {
                    $query->columns = [$query->columns[0]];
                }
                $columnAlias = new Expression('`'.($alias ?? collect([$relations, $column])->filter()->flatten()->join('.')).'`');
                $this->selectSub($query, $columnAlias);
            }

            return $this;
        });

        EloquentBuilder::macro('custom', function ($relations, $column, $alias = null) {
            if (empty($relations)) {
                return $this;
            }

            $relations = is_array($relations) ? $relations : [$relations];

            foreach ($this->parseWithRelations($relations) as $name => $constraints) {
                $segments = explode(' ', $name);

                if (count($segments) == 3 && Str::lower($segments[1]) == 'as') {
                    [$name, $alias] = [$segments[0], $segments[2]];
                }

                $relation = $this->getRelationWithoutConstraints($name);

                $table = $relation->getRelated()->newQuery()->getQuery()->from === $this->getQuery()->from
                    ? $relation->getRelationCountHashWithoutIncrementing()
                    : ($this->query->getConnection()->getTablePrefix() ?? '').$relation->getRelated()->getTable();

                $query = $relation->getRelationExistenceQuery(
                    $relation->getRelated()->newQuery(),
                    $this,
                    $table.'.'.($column ?? 'id')
                )->setBindings([], 'select');

                $query->callScope($constraints);

                $query = $query->mergeConstraintsFrom($relation->getQuery())->toBase();

                if (count($query->columns) > 1) {
                    $query->columns = [$query->columns[0]];
                }
                $columnAlias = new Expression('`'.($alias ?? collect([$relations, $column])->filter()->flatten()->join('.')).'`');
                $this->selectSub($query, $columnAlias);
            }

            return $this;
        });

        EloquentBuilder::macro('getRelationTable', function ($name) {
            $relation = $this->getRelationWithoutConstraints($name);

            $table = $relation->getRelated()->newQuery()->getQuery()->from === $this->getQuery()->from
                ? $relation->getRelationCountHashWithoutIncrementing()
                : ($this->query->getConnection()->getTablePrefix() ?? '').$relation->getRelated()->getTable();

            return $table;
        });

        Relation::macro('getRelationExistenceAggregatesQuery', function (EloquentBuilder $query, EloquentBuilder $parentQuery, $aggregate, $column) {
            $distinct_aggregate = new Expression($aggregate."(distinct {$column} separator ', ')");

            if ($query->getConnection()->getPDO()->getAttribute(\PDO::ATTR_DRIVER_NAME) === 'sqlite') {
                $distinct_aggregate = new Expression($aggregate."(REPLACE(DISTINCT({$column}), '', '') , ', ')");
            }

            $expression = $aggregate === 'group_concat'

                ? $distinct_aggregate
                : new Expression('COALESCE('.$aggregate."({$column}),0)");

            return $this->getRelationExistenceQuery(
                $query,
                $parentQuery,
                $expression
            )->setBindings([], 'select');
        });
    }
}
