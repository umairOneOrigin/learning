<?php
/**
 * @file
 * Contains \Drupal\first_form\form\ExampleForm.
 */
namespace Drupal\first_form\form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ExampleForm extends FormBase {

   public function getFormId() {
        return 'first_form';
   }

   public function buildForm(array $form, FormStateInterface $form_state) {
     
     $form['first_name'] = array (
        '#type' => 'textfield',
        '#title' => 'First Name',
        '#required' => TRUE,
     );
     $form['second_name'] = array (
        '#type' => 'textfield',
        '#title' => 'Second Name',
        '#required' => TRUE
     );
     $form['gender'] = array (
        '#type' => 'select',
        '#title' => 'Gender:',
        '#required'=> TRUE,
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
    $form['actions']["#type"] = 'actions';
    $form['actions']['submit'] = array(
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
        '#button_type' => 'primary',
    );
    return $form;
   } 

   public function validateForm(array &$form, FormStateInterface $form_state) {
        if (strlen($form_state->getValue('first_name')) > 10) {
            $form_state -> setErrorByName('first_name',$this->t('First Name exceeding the limit'));
        }
        if (strlen($form_state->getValue('second_name')) > 10) {
            $form_state -> setErrorByName('second_name', $this->t('Second Name exceeding the limit'));
        }
   }

   public function submitForm(array &$form, FormStateInterface $form_state) {
        \Drupal::messenger()->addMessage("Form Submitted! Registered Values are:");
                foreach ($form_state->getValues() as $key => $value) {
                    \Drupal::messenger()->addMessage($key .':' . $value);
                } // to print on the top
                \Drupal::messenger()->addMessage('hi');
    }
}
