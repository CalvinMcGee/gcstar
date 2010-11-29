<h2><?php echo $title; ?></h2>
<?php
echo $this->Js->link(__('Update database', true), array('action' => 'xml'), array(
    'update' => '#ajax',
    'before' => $this->Js->get('#overlay')->effect('fadeIn', array('buffer' => false)),
    'success' => $this->Js->get('#overlay')->effect('fadeOut', array('buffer' => false)),
    'complete' => $this->Js->redirect(array('action' => 'index'))));
foreach ($languages as $language)
    $options[$language] = languageCodes($language);

echo $this->Form->create();
echo $this->Form->input('title', array(
    'error' => array(
        'validateSettingTitle' => __('This field is required', true)
    ),
    'default' => $data['Visual']['title'],
    'label' => __('The page title', true)
    ));
echo $this->Form->input('theme', array('default' => $data['Visual']['theme'],
    'label' => __('Theme', true),
    'options' => $themes
    ));
echo $this->Form->input('language', array('default' => $data['Visual']['language'],
    'label' => __('Language', true),
    'options' => $options,
    'type' => 'radio'
    ));
echo $this->Form->input('limit', array(
    'error' => array(
        'validateSettingLimit' => __('Must be a valid number', true)
    ),
    'default' => $data['Visual']['limit'],
    'label' => __('Number of items per page', true)
    ));
echo $this->Form->input('tagcloud_min_size', array(
    'after' => '%',
    'error' => array(
        'validateSettingLimit' => __('Must be a valid number', true)
    ),
    'default' => $data['Visual']['tagcloud_min_size'],
    'label' => __('Minimum font size in tag cloud', true)
    ));
echo $this->Form->input('tagcloud_max_size', array(
    'after' => '%',
    'error' => array(
        'validateSettingLimit' => __('Must be a valid number', true)
    ),
    'default' => $data['Visual']['tagcloud_max_size'],
    'label' => __('Maximum font size in tag cloud', true)
    ));
echo $this->Form->end(array('label' => __('Save', true)));
?>
