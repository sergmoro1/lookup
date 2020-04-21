<?php
namespace sergmoro1\lookup\controllers;

use sergmoro1\modal\controllers\ModalController;

use sergmoro1\lookup\models\PropertyEdit;
use sergmoro1\lookup\models\PropertySearch;

class PropertyController extends ModalController
{
    public function newModel() { return new PropertyEdit(); }
    public function newSearch() { return new PropertySearch(); }
}
