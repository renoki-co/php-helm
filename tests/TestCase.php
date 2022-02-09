<?php

namespace RenokiCo\PhpHelm\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use RenokiCo\PhpHelm\Helm;

abstract class TestCase extends Orchestra
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        Helm::setHelmPath(getenv('HELM_PATH') ?: '/usr/local/bin/helm');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app)
    {
        return [
            \RenokiCo\PhpHelm\PhpHelmServiceProvider::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'wslxrEFGWY6GfGhvN9L3wH3KSRJQQpBD');
    }
}
