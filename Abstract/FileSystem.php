<?php

abstract class FileSystem {
    abstract public function getDailyPlan($employeeId, $date);
    abstract public function createDailyPlan($employeeId, $date, $content);
}