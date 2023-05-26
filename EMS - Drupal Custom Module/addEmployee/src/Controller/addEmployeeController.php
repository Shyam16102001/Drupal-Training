<?php

namespace Drupal\addEmployee\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\addEmployee\Form\addEmployeeForm;

class addEmployeeController extends ControllerBase {

  public function addemployee() {

    $form = \Drupal::formBuilder()->getForm(addEmployeeForm::class);

    return [
      '#theme' => 'addemployee',
      '#title' => 'Add Employee Details',
      '#form' => $form,
    ];
  }

}

?>