<?php
namespace Drupal\employee\Plugin\Block;

use Drupal\Core\Block\BlockBase;
// use Drupal\Code\Database\Database;

/**
 * Provides a block with simple text
 * 
 * @Block(
 *   id = "custom_block",
 *   admin_label = @Translation("Custom Block")
 * )
 */

 class CustomBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */

    public function build() {

        $form = \Drupal::formBuilder()->getForm('\Drupal\employee\Form\EmployeeForm');

        $db = \Drupal::database();
        $query = $db->select('employee','e');
        $query->fields('e');
        $result = $query->execute()->fetchAll();
        
        // foreach( $result as $values ){
        //     $card[] = $values->fname;
        // }

        return [
            '#theme' => 'custom_block',
            '#records' => $result,//$card,
            '#title' => 'Data Display!'
            // '#form' => $form
        ];
    }
 }