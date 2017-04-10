<?php

namespace back\Dashboard\controllers;

use app\repositories\ArticlesRepository;
use app\repositories\NewsRepository;
use app\repositories\OrdersRepository;
use app\repositories\UsersRepository;
use yii\web\HttpException;

class DashboardController extends \back\controllers\Controller {

    public function actionIndex() {
        if($this->getWebUser()->getIsGuest()) {
            throw new HttpException(401);
        }
        $ordersRep = OrdersRepository::getInstance();

        $data = [
            'users' => [],
            'articles' => [],
            'news' => [],
            'totalOrdersCount' => $ordersRep->getTotalOrdersCount(),
            'preProcessingOrdersCount' => $ordersRep->getPreProcessingOrdersCount(),
            'processingOrdersCount' => $ordersRep->getProcessingOrdersCount(),
            'ordersWeeklySum' => $ordersRep->getOrdersWeeklySum(),
            'ordersMonthlySum' => $ordersRep->getOrdersMonthlySum(),
            'ordersTotalSum' => $ordersRep->getOrdersTotalSum(),
        ];

        $users = UsersRepository::getInstance()->findLastRegisteredClients(10);
        foreach($users as $user) {
            $data['users'][] = [
                'id' => $user->getId(),
                'fullName' => $user->getFullName(),
                'phone' => $user->getPhone(),
                'ordersCount' => $user->getOrdersCount(),
            ];
        }

        $articles = ArticlesRepository::getInstance()->findLastArticles(10);
        foreach($articles as $article) {
            $data['articles'][] = [
                'id' => $article->getId(),
                'name' => $article->getName(),
                'added' => $article->getAdded(),
            ];
        }

        $news = NewsRepository::getInstance()->findLastNews(10);
        foreach($news as $newsItem) {
            $data['news'][] = [
                'id' => $newsItem->getId(),
                'name' => $newsItem->getName(),
                'added' => $newsItem->getAdded(),
            ];
        }

        return $this->getResponse($data);
    }

}