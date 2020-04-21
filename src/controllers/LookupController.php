<?php
namespace sergmoro1\lookup\controllers;

use sergmoro1\modal\controllers\ModalController;

use sergmoro1\lookup\models\LookupEdit;
use sergmoro1\lookup\models\LookupSearch;

class LookupController extends ModalController
{
    public function newModel() { return new LookupEdit(); }
    public function newSearch() { return new LookupSearch(); }
}
