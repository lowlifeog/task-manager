<?php

$this->add('', ['controller' => 'Task', 'action' => 'Index']);
$this->add('{controller}', ['action' => 'Index']);
$this->add('{page:\d+}', ['controller' => 'Task', 'action' => 'Index']);
$this->add('{controller}/{action}');