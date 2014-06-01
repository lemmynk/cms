<?php
return array (
  'items' => 
  array (
    'editor' => 
    array (
      'type' => 1,
      'assignments' => 
      array (
        2 => 
        array (
          'roleName' => 'editor',
        ),
      ),
    ),
    'admin' => 
    array (
      'type' => 1,
      'children' => 
      array (
        0 => 'editor',
      ),
      'assignments' => 
      array (
        1 => 
        array (
          'roleName' => 'admin',
        ),
      ),
    ),
  ),
  'rules' => 
  array (
  ),
);
