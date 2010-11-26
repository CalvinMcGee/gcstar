<h2><?php echo $title; ?></h2>
<?php
echo $this->Html->div('tagcloud',
        $this->Html->tag('h2', __('Genres', true), array('escape' => true)).
        $this->element('tagcloud', array('data' => $genres, 'escape' => true),
            array('cache' => '+1 hour'))
        )."\n";
echo $this->Html->div('tagcloud',
        $this->Html->tag('h2', __('Directors', true), array('escape' => true)).
        $this->element('tagcloud', array('data' => $directors, 'escape' => true),
            array('cache' => '+1 hour'))
        )."\n";
echo $this->Html->div('tagcloud',
        $this->Html->tag('h2', __('Actors', true), array('escape' => true)).
        $this->element('tagcloud', array('data' => $actors, 'escape' => true),
            array('cache' => '+1 hour'))
        )."\n";
echo $this->Html->div('tagcloud',
        $this->Html->tag('h2', __('Countries', true), array('escape' => true)).
        $this->element('tagcloud', array('data' => $countries, 'escape' => true),
            array('cache' => '+1 hour'))
        )."\n";
echo $this->Html->div('tagcloud',
        $this->Html->tag('h2', __('Years of publication', true), array('escape' => true)).
        $this->element('tagcloud', array('data' => $years, 'escape' => true),
            array('cache' => '+1 hour'))
        )."\n";
?>
