<?php

namespace Drupal\addemployee\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


class addEmployeeForm extends FormBase {

  public function getFormId() {
    return 'addemployee_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Employee Name'),
      '#required' => TRUE, 
    ];

    $form['salary'] = [
      '#type' => 'number',
      '#title' => $this->t('Salary'),
      '#required' => TRUE, 
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add Employee'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $empName = $form_state->getValue('name');
    $empSalary = $form_state->getValue('salary');

    $connection = mysqli_connect('localhost', 'root', '', 'employee_db');

    if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `employee` (`EmpID`, `EmpName`, `EmpSalary`) VALUES (NULL, '$empName', '$empSalary')";
    mysqli_query($connection, $sql);

    mysqli_close($connection);

    $response = new RedirectResponse('/employee/employeelist');
    $response->send();

    $this->messenger()->addStatus($this->t('Employee added successfully.'));

    return;
  }

}
