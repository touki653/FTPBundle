<?php

namespace Touki\Bundle\FTPBundle;

use Touki\FTP\Connection\Connection;
use Touki\FTP\Connection\SSLConnection;
use Touki\FTP\ConnectionInterface;

/**
 * Connection factory which instanciates a connection based on parameters
 *
 * @author Touki <g.vincendon@vithemis.com>
 */
class ConnectionFactory
{
    /**
     * Builds the connection
     *
     * @param  boolean $secured  If the connection needs to be SSL
     * @param  string  $host     Hostname
     * @param  string  $username Username
     * @param  string  $password Password
     * @param  integer $port     Port
     * @return ConnectionInterface
     */
    public function build($secured, $host, $username, $password, $port)
    {
        if ($secured) {
            return new SSLConnection($host, $username, $password, $port);
        }

        return new Connection($host, $username, $password, $port);
    }
}
