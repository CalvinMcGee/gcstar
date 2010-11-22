<?php
echo $this->Form->create('Setting');
echo $this->Form->input('username', array(
    'default' => $data['User']['username'],
    'label' => __('Username', true)
    ));
echo $this->Form->password('password', array(
    'default' => $data['User']['password']
    ));
echo $this->Form->end(array('label' => __('Save', true)))
?>
