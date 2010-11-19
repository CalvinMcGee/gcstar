<?php
debug($this->data);
echo $this->Form->create('User');
echo $this->Form->radio('User.language', $languages, array('label' => __('Language', true)));
echo $this->Form->input('User.title');
echo $this->Form->submit(__('Continue', true));
echo $this->Form->submit(__('Cancel', true), array('name'=>'Cancel'));
echo $this->Form->end();
?>
