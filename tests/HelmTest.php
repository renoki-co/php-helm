<?php

namespace RenokiCo\PhpHelm\Test;

use RenokiCo\PhpHelm\Helm;

class HelmTest extends TestCase
{
    public function test_helm_run()
    {
        $process = Helm::call('repo', [
            'add',
            'stable',
            'https://charts.helm.sh/stable',
        ], ['--no-update' => true]);

        $process->run();

        dump($process->getCommandLine());
        dump($process->getOutput());

        $this->assertTrue($process->isSuccessful());
    }
}
