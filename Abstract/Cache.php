<?php

abstract class Cache {
    abstract public function cacheEmployee($employee);
    abstract public function getCachedEmployee($employeeId);
}