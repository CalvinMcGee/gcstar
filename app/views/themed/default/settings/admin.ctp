<?php
debug($this->data);
echo $this->Form->create('Setting');
echo $this->Form->submit(__('Continue', true));
echo $this->Form->submit(__('Cancel', true), array('name'=>'Cancel'));
echo $this->Form->end();
?>
