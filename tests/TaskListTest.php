<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaskListTest
 *
 * @author namblue
 */
 class TaskListTest extends PHPUnit_Framework_TestCase
  {
    private $CI;
    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
    }
    public function testTaskList()
    {
      $completed = count($this->CI->tasks->getCompletedTasks());
      $uncompleted = count($this->CI->tasks->getCategorizedTasks());
      $this->assertGreaterThan($completed, $uncompleted);
    }
  }
