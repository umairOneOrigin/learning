<?php

namespace Drupal\employee\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class EmployeeForm extends FormBase {

    /**
     * {@inheritdoc}
     */

     public function getFormId()
     {
        return 'create_employee';
        // gets id to indentify uniquely 
     }

     /**
      * {@inheritdoc}
      */

      public function buildForm(array $form, FormStateInterface $form_state)
      {
        $form['fname'] = array(
            '#type' => 'textfield',
            '#title' => 'First ',
            '#default_value' => '',
            '#attibutes' => array(
                'placeholder'=>'Enter Your First Name...'
            ),
            '#required' => TRUE
        );
        $form['sname'] = array(
            '#type' => 'textfield',
            '#title' => 'Second Name',
            '#default_value' => '',
            '#attibutes' => array(
                'placeholder'=>'Enter Your Second Name...'
            ),
            '#required' => TRUE
        );
        $form['gender'] = array (
            '#type' => 'select',
            '#title' => 'Gender:',
            '#required' => TRUE,
            '#options' => array (
                'Male' => 'Male',
                'Female' => 'Female',
                'Other' => 'Others',
            ),
        );
        $form['dob'] = array (
            '#type' => 'date',
            '#title' => "Date Of Birth",
            '#required' => TRUE
        );
        
        $form['save'] = array(
        '#type' => 'submit',
        '#value' => 'Submit',
        '#button_type' => 'primary',
        );
        return $form;
      }

      /**
       * {@inheritdoc}
       */

       public function validateForm(array &$form, FormStateInterface $form_state) {
        $name = $form_state->getValue('fname');
        if (trim($form_state->getValue('fname')) > 10) {
            $form_state -> setErrorByName('fname',$this->t('First Name cannot be more less than 10 characters'));
        }
        else if (strlen($form_state->getValue('sname')) > 8) {
            $form_state -> setErrorByName('sname', $this->t('Second Name exceeding the limit'));
        }
   }

       /**
       * {@inheritdoc}
       */

       public function submitForm(array &$form, FormStateInterface $form_state)
       {
            // $postData = $form_state->getValues();

            // echo "<pre>";

            //   print_r($postData);

            // echo "</pre>";

            // exit;

            /**
             * To Remove the unwanted keys/fields from postData use below method
             */

            // unset($postData['save'],$postData['form_build_id'],$postData['form_token'],$postData['form_id'],$postData['op']);

            $query = \Drupal::database();
            $query->insert('employee')->fields([
                'fname',
                'sname',
                'gender',
                'dob',
            ])->values(array(
                $form_state->getValue('fname'),
                $form_state->getValue('sname'),
                $form_state->getValue('gender'),
                $form_state->getValue('dob'),
                ))->execute();

            // drupal_set_message('Your Data has Succesfully Submitted!','status',TRUE);
            // $form = array(
            //     '#markup' => theme_status_messages(array('display' => 'error')),
            // );
       }
}
