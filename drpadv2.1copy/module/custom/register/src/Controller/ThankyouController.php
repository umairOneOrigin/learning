<?php
 namespace Drupal\register\Controller;

 use Drupal\Core\Controller\ControllerBase;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Drupal\Core\Database\Database;

 /**
 * Provides route responses for the Example module.
 */

 class ThankyouController extends ControllerBase {
    /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */

   public function successpage() {
    //display thank you page
    $element = array(
        '#markup' => 'Form Data Submitted!',
    );
    return $element;
   }

   public function getDetails() {
    // fetches data from students table 
    $db = \Drupal::database();
    $query = $db->select('students','n');
    $query->fields('n');
    $response = $query->execute()->fetchAll();
     return new JsonResponse( $response );
   }
 }