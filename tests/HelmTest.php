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
        Helm::addRepo('bitnami', 'https://charts.bitnami.com/bitnami')->run();
        Helm::repoUpdate()->run();

        $process = Helm::install(
            'release-1',
            'bitnami/postgresql',
            ['--debug' => true]
        );

        $process->run();

        dump($process->getCommandLine());
        dump($process->getOutput());

        $this->assertTrue($process->isSuccessful());
    }

    public function test_helm_repo_upgrade()
    {
        Helm::addRepo('bitnami', 'https://charts.bitnami.com/bitnami')->run();
        Helm::repoUpdate()->run();

        $process = Helm::upgrade(
            'release-2',
            'bitnami/postgresql',
            [
                '--install' => true,
                '--debug' => true,
                ['--set', 'label1=value1'],
                ['--set', 'label2=value2'],
            ]
        );

        $process->run();

        dump($process->getCommandLine());
        dump($process->getOutput());

        $this->assertTrue($process->isSuccessful());
    }

    public function test_helm_repo_macro()
    {
        Helm::macro('test', function ($var) {
            return $var;
        });

        $this->assertEquals('123', Helm::test('123'));
    }
}
