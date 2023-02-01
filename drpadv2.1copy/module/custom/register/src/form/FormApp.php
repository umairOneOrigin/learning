<?php
namespace Drupal\register\form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Drupal\Core\Routing;

class FormApp extends FormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'register';
    }

    /**
     * {@inheritdoc}
     */

     public function buildForm(array $form, FormStateInterface $form_state) {
        $form['fname'] = array (
            '#type' => 'textfield',
            '#title' => 'First Name',
            '#required' => TRUE
        );
        $form['sname'] = array (
            '#type' => 'textfield',
            '#title' => 'Second Name',
            '#required' => TRUE
         );
         $form['gender'] = array (
            '#type' => 'select',
            '#title' => 'Gender:',
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

     public function submitForm(array &$form, FormStateInterface $form_state) {
        $conn = Database::getConnection();
        $conn->insert('students')->fields(
            array(
                'fname' => $form_state->getValue('fname'),
                'sname' => $form_state->getValue('sname'),
                'gender' => $form_state->getValue('gender'),
                'dob' => $form_state->getValue('dob'),
            )
        )->execute();
        $url = Url::fromroute('register.thankyou');
        $form_state->setRedirectUrl($url);
     }

     public function validateForm(array &$form, FormStateInterface $form_state) {
        if (strlen($form_state->getValue('fname')) > 10) {
            $form_state -> setErrorByName('fname',$this->t('First Name cannot be more less than 10 characters'));
        }
        if (strlen($form_state->getValue('sname')) > 6) {
            $form_state -> setErrorByName('sname', $this->t('Second Name exceeding the limit'));
        }
   }
}

