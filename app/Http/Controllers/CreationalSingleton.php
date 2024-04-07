<?php

namespace App\Http\Controllers;

use App\Singleton\LoggerSingleton;

class CreationalSingleton extends Controller
{
    public function index(): void
    {
        $firstLogger = LoggerSingleton::getInstance(); // Creating first singleton instance
        var_dump($firstLogger);

        $secondLogger = LoggerSingleton::getInstance(); // Trying to create a second singleton instance
        var_dump($secondLogger);

        if ($firstLogger === $secondLogger) {
            var_dump("Singleton Pattern works!");
        }

        // spl_object_id($firstLogger) and spl_object_id($secondLogger) should be the same ID
        $firstLogger::addLog("Add log message from firstSingleton. Singleton ID#" . spl_object_id($firstLogger));
        $secondLogger::addLog("Add log message from secondSingleton. Singleton ID#" . spl_object_id($firstLogger));

        var_dump(LoggerSingleton::getLogs());
    }
}
