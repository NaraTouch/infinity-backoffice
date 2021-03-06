<?php
namespace Cake\Database\Driver;
use PDO;

class Dummy
{
    public function enabled()
    {
        return true;
    }
    function connect() {
        $this->connected = true;
        return $this->connected;
    }
    function disconnect() {
        $this->connected = false;
        return !$this->connected;
    }
    function isConnected() {
        return true;
    }
}