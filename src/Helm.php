<?php

namespace RenokiCo\PhpHelm;

use Symfony\Component\Process\Process;

class Helm
{
    /**
     * The process instance to run Helm from.
     *
     * @var \Symfony\Component\Process\Process
     */
    protected $process;

    /**
     * The base path for helm binary.
     *
     * @var string
     */
    protected static $path = '/usr/local/bin/helm';

    /**
     * Call a new Helm command.
     *
     * @param  string  $action
     * @param  array  $params
     * @param  array  $flags
     * @param  array  $envs
     * @return \RenokiCo\PhpHelm\Helm
     */
    public static function call(string $action, array $params = [], array $flags = [], array $envs = [])
    {
        return new static($action, $params, $flags, $envs);
    }

    /**
     * Initiate a new helm repo add command.
     *
     * @param  string  $name
     * @param  string  $url
     * @param  array  $extraFlags
     * @param  array  $envs
     * @return \RenokiCo\PhpHelm\Helm
     */
    public static function addRepo(string $name, string $url, array $extraFlags = [], array $envs = [])
    {
        return static::call('repo', ['add', $name, $url], $extraFlags, $envs);
    }

    /**
     * Initiate a helm repo update command.
     *
     * @param  array  $extraArgs
     * @param  array  $extraFlags
     * @param  array  $envs
     * @return \RenokiCo\PhpHelm\Helm
     */
    public static function repoUpdate(array $extraFlags = [], array $envs = [])
    {
        return static::call('repo', ['update'], $extraFlags, $envs);
    }

    /**
     * Change the default path for helm CLI.
     *
     * @param  string  $path
     * @return void
     */
    public static function setHelmPath(string $path)
    {
        static::$path = $path;
    }

    /**
     * Create a new Helm process instance.
     *
     * @param  string  $action
     * @param  array  $flags
     * @param  array  $envs
     * @return void
     */
    public function __construct(string $action, array $params = [], array $flags = [], array $envs = [])
    {
        $command = array_merge(
            [static::$path, $action],
            $params,
            $this->compileFlags($flags)
        );

        $this->process = new Process($command, null, $envs);
    }

    /**
     * Proxy the call to the process instance.
     *
     * @param  string  $method
     * @param  array  $params
     * @return mixed
     */
    public function __call(string $method, array $params)
    {
        return $this->process->{$method}(...$params);
    }

    /**
     * Compile an array of flags to helm-supported flags.
     *
     * @param  array  $flags
     * @return array
     */
    protected function compileFlags(array $flags): array
    {
        $compiledFlags = [];

        foreach ($flags as $name => $value) {
            // If the flag has exactly bool false, then skil the flag.
            // So ['--some-flag' => false] would mean --some-flag does not appear.
            if ($value === false) {
                continue;
            }

            // For flags that have true bind, just mention the flags directly.
            // Otherwise, add slashes for the value and attach it ad key=value.
            // You can have "--no-update" but not --no-update="1" if ['--no-update' => true] is set.
            if ($value === true) {
                $compiledFlags[] = $name;
            } else {
                $value = escapeshellarg($value);
                $compiledFlags[] = "{$name}={$value}";
            }
        }

        return $compiledFlags;
    }
}
