<?php
namespace WhiteHatApi;


class DBConnectionFactory
{
    const CONNECTION_CASINO = 'CASINO';

	private static $connections = array(
	    self::CONNECTION_CASINO => null,
    );

	public function getCasino()
    {
        return $this->geDbConnectionFor(self::CONNECTION_CASINO);
    }

	public function geDbConnectionFor($connectionKey)
	{
        if (is_null(self::$connections[$connectionKey]))
	    {
            $config = new \Doctrine\DBAL\Configuration();

            $connectionParams = array(
                'dbname' => getenv("DB_NAME_" . $connectionKey),
                'user' => getenv("DB_USER_" . $connectionKey),
                'password' => getenv("DB_PASSWORD_" . $connectionKey),
                'host' => getenv("DB_HOST_" . $connectionKey),
                'driver' => 'pdo_mysql',
                'charset' => 'utf8'
            );
            self::$connections[$connectionKey] = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        }

		return self::$connections[$connectionKey];
	}

}