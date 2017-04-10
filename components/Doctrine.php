<?php

namespace app\components;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use yii\base\Component;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Компонент doctrine
 */
class Doctrine extends Component {

    public $host = 'localhost';
    public $dbname;
    public $username;
    public $password;
    public $charset;

    /** @var EntityManager */
    private $em;

    /** @inheritdoc */
    public function init() {
        parent::init();

        $dbParams = [
            'driver'   => 'pdo_mysql',
            'dbname'   => $this->dbname,
            'user'     => $this->username,
            'password' => $this->password,
            'charset'  => $this->charset,
        ];
        $config = Setup::createConfiguration(YII_ENV == 'dev');
        $driver = new AnnotationDriver(new AnnotationReader());
        AnnotationRegistry::registerLoader('class_exists');
        $config->setMetadataDriverImpl($driver);
        $runtimeDir = \Yii::$app->getBasePath() . '/runtime';
        $config->setProxyDir($runtimeDir . '/proxies');
        $config->setProxyNamespace('Proxies');
        $config->addEntityNamespace('Models', 'app\models');
        $this->em = EntityManager::create($dbParams, $config);
    }

    /** @return EntityManager */
    public function getEntityManager() {
        return $this->em;
    }

}