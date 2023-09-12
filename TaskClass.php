<?php

class TaskClass
{
    private $database;
    private $fileSystem;
    private $cache;
    private $logger;

    public function __construct(
        Database $database,
        FileSystem $fileSystem,
        Cache $cache,
        Logger $logger
    ) {
        $this->database = $database;
        $this->fileSystem = $fileSystem;
        $this->cache = $cache;
        $this->logger = $logger;
    }

    /**
     * @throws Exception
     */
    public function sendDailyPlan($employeeId)
    {
        $employee = $this->cache->getCachedEmployee($employeeId);

        if (!$employee) {
            $employee = $this->database->getEmployee($employeeId);
            $this->cache->cacheEmployee($employee);
        }

        $currentDate = $this->getCurrentDate();
        $dailyPlan = $this->fileSystem->getDailyPlan($employeeId, $currentDate);

        if (!$dailyPlan) {
            throw new Exception("Not found.");
        }

        $filePath = "plans/{$currentDate}/{$employee->getName()}_world_plan.txt";
        $this->fileSystem->createDailyPlan($employeeId, $currentDate, $dailyPlan);
        $this->logger->log($employee->getName(), $filePath, $currentDate, $this->getCurrentTime());
    }

    private function getCurrentDate()
    {
        return Carbon::now(); //TODO: Get Carbon package and current date.
        // here need package.json and composer
    }

    private function getCurrentTime()
    {
        return Carbon::now(); //TODO: Get Carbon package and current date time.
        // here need package.json and composer
    }
}

// Example
$password = 'test';
$username = 'test';
$databaseName = 'test';
$hostname ='localhost';
$database = new MyDatabase("mysql:host=$hostname;dbname=$databaseName", $username, $password);
$fileSystem = new MyFileSystem("/var/www/test/public_holder");
$cache = new MyCache();
$logger = new MyLogger();

$mailer = new TaskClass($database, $fileSystem, $cache, $logger);

$employeesToNotify = [100, 200, 300]; // employeeIds

foreach ($employeesToNotify as $employeeId) {
    try {
        $mailer->sendDailyPlan($employeeId);
    } catch (Exception $e) {
        echo "Ups, {$employeeId}: {$e->getMessage()}\n";
    }
}
