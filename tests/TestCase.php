<?php

namespace Spatie\LaravelEndpointResources\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\LaravelEndpointResources\Tests\Fakes\TestModel;
use Spatie\LaravelEndpointResources\Tests\Fakes\FakeRouter;
use Spatie\LaravelEndpointResources\Tests\Fakes\SecondTestModel;

abstract class TestCase extends BaseTestCase
{
    /** @var \Spatie\LaravelEndpointResources\Tests\Fakes\FakeRouter */
    protected $fakeRouter;

    protected function setUp() : void
    {
        parent::setUp();

        $this->setUpEnvironment();
        $this->setUpDatabase();

        $this->fakeRouter = FakeRouter::setup();
    }

    private function setUpDatabase()
    {
        Schema::create('test_models', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
        });

        Schema::create('second_test_models', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
        });
    }

    private function setUpEnvironment(): void
    {
        $this->app['config']->set('database.default', 'sqlite');
        $this->app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $this->app['config']->set('app.key', 'kuFyUdCwrgWJjLWURIbkemJlFLGatcmo');

        Model::unguard();
    }
}
