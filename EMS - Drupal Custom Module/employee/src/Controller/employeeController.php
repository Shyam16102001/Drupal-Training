<?php

namespace Drupal\employee\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\employee\Form\EmployeeForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

class employeeController extends ControllerBase {

  protected $formBuilder;

  public static function create(ContainerInterface $container) {
    $formBuilder = $container->get('form_builder');
    return new static($formBuilder);
  }

  public function __construct($formBuilder) {
    $this->formBuilder = $formBuilder;
  }

  public function employeeList() {
    $connection = mysqli_connect('localhost', 'root', '', 'employee_db');

    if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM employee";
    $employees = mysqli_query($connection, $sql);

    $count = mysqli_num_rows($employees);

    mysqli_close($connection);

    $empform = [];


    foreach ($employees as $employee) {
      $employeeId = $employee['EmpID'];
      $empform[$employeeId] = $this->formBuilder->getForm(EmployeeForm::class, $employeeId);
    }

    return [
      '#theme' => 'employeelist',
      '#title' => 'Employee Details',
      '#details' => $employees,
      '#employee_form' => $empform,
    ];
  }

}

?>