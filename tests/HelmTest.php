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
}
