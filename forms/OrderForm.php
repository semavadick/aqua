<?php

namespace app\forms;

use app\components\Doctrine;
use app\components\WebUser;
use app\models\AdditionProduct;
use app\models\AdditionProductOption;
use app\models\Currency;
use app\models\Language;
use app\models\Order;
use app\models\OrderAdditionProduct;
use app\models\OrderAdditionProductOption;
use app\models\OrderProduct;
use app\models\User;
use app\repositories\SettingsRepository;
use app\repositories\UsersRepository;
use app\validators\ModelFile;
use back\helpers\HandyFile;
use Yii;
use yii\swiftmailer\Mailer;

/**
 * Форма заказа
 */
class OrderForm extends Form {

    /**
     * @var string Имя и фамилия
     */
    public $fullName;

    /**
     * @var string Телефон
     */
    public $phone;

    /**
     * @var string Email
     */
    public $email;

    /**
     * @var WebUser Веб-юзер
     */
    public $wUser;

    /**
     * @var Currency Валюта
     */
    public $currency;

    /** @var HandyFile|null */
    public $uFile;

    /**
     * @inheritdoc
     */
    public function rules() {
        if(!$this->wUser->getIsGuest()) {
            return [];
        }
        return [
            [['fullName', 'email', 'phone'], 'required'],
            ['email', 'email'],
            ['email', 'checkEmail'],
            ['uFile', ModelFile::className()],
        ];
    }

    public function checkEmail() {
        $email = trim($this->email);
        $user = UsersRepository::getInstance()->findUserByEmail($email);
        if(empty($user)) {
            return;
        }
        if(empty($this->user) || $this->user->getId() != $user->getId()) {
            $this->addError('email', 'Пользоваетль с таким email уже существует');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'fullName' => Yii::t('app', 'Your full name'),
            'email' => Yii::t('app', 'E-mail'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }

    /** @param array */
    public function loadFile($data) {
        if(!empty($data['uFile']['tmp_name']) && !empty($data['uFile']['name'])) {
            $this->uFile = HandyFile::createFromPath($data['uFile']['tmp_name'], $data['uFile']['name']);
        } else {
            $this->uFile = null;
        }
    }

    /**
     * Создает заказ
     * @param Language $language
     * @param Currency $currency
     * @return bool Результат операции
     */
    public function createOrder(Language $language, Currency $currency) {
        if(!$this->validate()) {
            return false;
        }

        /** @var Doctrine $doctrine */
        $doctrine = Yii::$app->get('doctrine');
        $em = $doctrine->getEntityManager();
        $setting = SettingsRepository::getInstance()->findSetting();
        /* @var Mailer $mailer */
        $mailer = Yii::$app->get('mailer');

        $wUser = $this->wUser;
        if($wUser->getIsGuest()) {
            $user = new User();
            $user->setFullName($this->fullName);
            $user->setEmail($this->email);
            $user->setPhone($this->phone);
            $user->setStatus($user::STATUS_ACTIVE);
            $user->setRole($user::ROLE_CLIENT);
            $password = uniqid();
            $user->setPassword($password);
            $em->persist($user);
            if(!empty($this->uFile)) {
                $path = $this->uFile->saveToDir('/files/users', true);
                if(empty($path)) {
                    $this->addError('uFile', 'Не удалось сохранить файл');
                    return false;
                }
                $user->setCompanyInfoFilePath($path);
            }

            $message = $mailer->compose('users/registration', [
                'fullName' => $this->fullName,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => $password,
            ]);
            /*$message
                ->setFrom($setting->getNoreplyEmail())
                ->setTo($user->getEmail())
                ->send();*/

            // TODO
            /*$message = $mailer->compose('managers/registration', [
                'fullName' => $this->fullName,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
            $message
                ->setFrom($setting->getNoreplyEmail())
                ->setTo($user->getFeedbackEmail())
                ->send();*/

        } else {
            $user = $wUser->getModel();
        }

        $order = new Order();
        $order->setUser($user);
        $order->setStatus(Order::STATUS_PRE_PROCESSING);
        $order->setCurrency($currency);
        $em->persist($order);

        foreach($wUser->getCartProducts() as $product) {
            $addition_product = false;
            if(!$product instanceof AdditionProduct) {
                $ordProduct = new OrderProduct();
            } else {
                $ordProduct = new OrderAdditionProduct();
                $addition_product = true;
            }
            $ordProduct->setOrder($order);
            $ordProduct->setProduct($product);
            $ordProduct->setName($product->getName($language));
            $ordProduct->setPrice($product->getCalculatedPrice($currency, $user));
            $ordProduct->setSku($product->getSku());
            $ordProduct->setDiscount($product->getDiscount($user));
            if($addition_product) {
                if($product->getCartOptions()){
                    $optionsIds = [];
                    foreach($product->getCartOptions() as $optIndex => $option) {
                        $optionsIds[] = $option['id'];
                    }
                    $options = $em->getRepository('Models:AdditionProductOption')->findBy([
                        'id' => $optionsIds
                    ]);
                    $ordProduct->setOptions($options);
                }
            }
            $ordProduct->setQuantity($product->getCartQuantity());
            $em->persist($ordProduct);
        }

        $em->flush();

        // TODO
        /*$message = $mailer->compose('users/order', [
            'user' => $user,
            'order' => $order,
        ]);
        $message
            ->setFrom($setting->getNoreplyEmail())
            ->setTo($user->getEmail())
            ->send();

        $message = $mailer->compose('managers/order', [
            'user' => $user,
            'order' => $order,
        ]);
        $message
            ->setFrom($setting->getFeedbackEmail())
            ->setTo($user->getEmail())
            ->send();*/

        return true;
    }

}