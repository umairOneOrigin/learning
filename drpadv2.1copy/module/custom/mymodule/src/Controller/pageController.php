<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;
// use Drupal\devel\Plugin\Devel\Dumper\VarDumper;
// use Drupal\views\Plugin\views\row\Fields;

// use Drupal\Code\Database\Database;

class pageController extends ControllerBase {
    public function content(){
        $form = \Drupal::formBuilder()->getForm('Drupal\mymodule\Form\PageForm');
        //  $renderForm = \Drupal::service('renderer')->render($form);

        $db = \Drupal::database();
        $query = $db->select('formpage','f');
        $query->fields('f');
        $result = $query->execute()->fetchAll();
        // dump($form);
        // dump($form);

        return [
            '#theme' => 'form_page',
            '#items' => $result,
            // '#title' => 'Registration Form - 2'
        ];
    }
}