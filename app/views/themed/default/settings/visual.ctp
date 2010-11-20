<?php
debug($data);
echo $this->Form->create();
echo $this->Form->input('language', array('default' => $data['Visual']['language'],
    'label' => __('Language', true),
    'options' => $languages
    ));
echo $this->Form->input('limit', array('default' => $data['Visual']['limit'],
    'label' => __('Number of items per page', true)
    ));
echo $this->Form->end();
?>
