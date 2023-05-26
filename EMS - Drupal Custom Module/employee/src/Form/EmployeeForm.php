<?php
namespace Drupal\employee\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class EmployeeForm extends FormBase {

  public $employeeId;
  
  public function getFormId() {
    return 'employee_form';
  }  

  public function buildForm(array $form, FormStateInterface $form_state, $employeeId = NULL) {
    
    $form['hike_percentage'] = [
    '#type' => 'number',
    '#title' => $this->t('Hike Percentage'),
    '#required' => TRUE,
    ];

    $form['employee_id'] = [
      '#type' => 'hidden',
      '#default_value' => $employeeId,
    ];

    $form['submit'] = [
    '#type' => 'submit',
    '#value' => $this->t('Update Salary'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $hikePercentage = $form_state->getValue('hike_percentage'); 
    $employeeIds = $form_state->getValue('employee_id');

    $connection = mysqli_connect('localhost', 'root', '', 'employee_db');

    if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
    }

      $employeeQuery = "SELECT * FROM employee WHERE EmpID = '$employeeIds'";
      $employeeResult = mysqli_query($connection, $employeeQuery);
      $employee = mysqli_fetch_assoc($employeeResult);

      if ($employee) {
        $newSalary = $employee['EmpSalary'] + ($employee['EmpSalary'] * $hikePercentage / 100);
        $updateQuery = "UPDATE employee SET EmpSalary = '$newSalary' WHERE EmpID = '$employeeIds'";
        mysqli_query($connection, $updateQuery);
      }


    mysqli_close($connection);

    $this->messenger()->addStatus($this->t('Salary updated successfully.'));
  }

}
