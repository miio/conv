<?php

namespace Conv\Command;

use Conv\Util\Config;
use Symfony\Component\Console\Command\Command;
use Conv\Operator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{
    public function getPDO($dbname = null): \PDO
    {
    	$host = Config::pdo('host');
        if (is_null($dbname)) {
            $pdo = new \PDO("mysql:host=$host;charset=utf8;", Config::pdo('username'), Config::pdo('password'));
        } else {
            $pdo = new \PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", Config::pdo('username'), Config::pdo('password'));
        }
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getOperator(InputInterface $input, OutputInterface $output): Operator
    {
        return new Operator(
            $this->getHelper('question'),
            $input,
            $output
        );
    }
}
