<?php

abstract class Logger {
    abstract public function log($employeeName, $filePath, $date, $time);
}