<?php
return array (
  'RBAC Manager' => 
  array (
    'type' => 2,
    'description' => 'Manages Auth Items and Role Assignments. RBAM required role.',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'Auth Items Manager',
      1 => ' Auth Assignments Manager',
    ),
    'assignments' => 
    array (
      'demo' => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
  'Auth Items Manager' => 
  array (
    'type' => 2,
    'description' => 'Manages Auth Items. RBAM required role.',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  ' Auth Assignments Manager' => 
  array (
    'type' => 2,
    'description' => 'Manages Role Assignments. RBAM required role.',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Authenticated' => 
  array (
    'type' => 2,
    'description' => 'Default role for users that are logged in. RBAC default role.',
    'bizRule' => 'return !Yii::app()->getUser()->getIsGuest();',
    'data' => NULL,
  ),
  'Guest' => 
  array (
    'type' => 2,
    'description' => 'Default role for users that are not logged in. RBAC default role.',
    'bizRule' => 'return Yii::app()->getUser()->getIsGuest();',
    'data' => NULL,
  ),
);
