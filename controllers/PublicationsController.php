<?php

namespace app\controllers;

use app\models\Publication;

abstract class PublicationsController extends Controller {

    abstract public function getPublicationUrl(Publication $publication);

}
