<?php

namespace RenokiCo\PhpHelm\Test;

use RenokiCo\PhpHelm\Helm;

class HelmTest extends TestCase
{
    public function test_helm_repo_add()
    {
        $process = Helm::addRepo('stable', 'https://charts.helm.sh/stable', ['--no-update' => true, '--debug' => true]);

        $process->run();

        dump($process->getCommandLine());
        dump($process->getOutput());

        $this->assertTrue($process->isSuccessful());
    }

    public function test_helm_repo_update()
    {
        $process = Helm::repoUpdate(['--debug' => true]);

        $process->run();

        dump($process->getCommandLine());
        dump($process->getOutput());

        $this->assertTrue($process->isSuccessful());
    }

    public function test_helm_repo_install()
    {
        $process = Helm::install(
            'test-release',
            'stable/chart-name',
            ['--debug' => true]
        );

        $this->assertStringContainsString(
            'install test-release "stable/chart-name" --debug',
            $process->getCommandLine()
        );
    }

    public function test_helm_repo_upgrade()
    {
        $process = Helm::upgrade(
            'test-release',
            'stable/chart-name',
            ['--debug' => true]
        );

        $this->assertStringContainsString(
            'upgrade test-release "stable/chart-name" --debug',
            $process->getCommandLine()
        );
    }

    public function test_helm_repo_macro()
    {
        Helm::macro('test', function ($var) {
            return $var;
        });

        $this->assertEquals('123', Helm::test('123'));
    }
}
