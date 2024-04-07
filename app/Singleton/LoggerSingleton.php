<?php

namespace App\Singleton;

use Exception;

final class LoggerSingleton
{
    protected static self|null $instance = null;
    public static array $messages = [];

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    protected function __construct()
    {
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    protected function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception('Cannot unserialize a singleton object');
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$messages[] = "Creating instance of Singleton";
            self::$instance = new self();
        } else {
            self::$messages[] = "Using previous instance of Singleton";
        }

        return static::$instance;
    }

    public static function addLog(string $message): void
    {
        self::$messages[] = "Using static Log method to add message: {$message}";
    }

    public static function getLogs(): array
    {
        return self::$messages;
    }
}
