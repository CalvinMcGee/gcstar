<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->meta(__('Most Recent Items', true), array(
            'controller' => 'items',
            'action' => 'feed'.'.rss'
            ), array('type' => 'rss'));

        echo $this->Html->css(array('reset', '960', 'style'));
        echo $this->Html->script(array('jquery', 'javascript'));

        echo $scripts_for_layout;
    ?>
</head>
<body>
    <div id="overlay">
        <div class="busy-indicator">&nbsp;</div>
        <div>
            <span class="busy-indicator"><?php echo $this->Html->image('ajax.gif');?><br />
                <?php __('Loading. Please wait.'); ?>
            </span>
        </div>
    </div>

    <div class="container_12">
        <div id="header" class="grid_12">
            <h1><?php echo Configure::read('Visual.title') ?></h1>
        </div>
        <div class="clear"></div>
        <div id="content" class="grid_12">
            <div class="grid_3 alpha">
                <?php echo $this->Html->link(__('Home', true), array(
                        'controller' => 'items',
                        'action' => 'index'
                    ))."\n";?>
                <h2><?php __('Order by'); ?></h2>
                <ul>
                    <li>
                        <?php __('Title');
                            echo $this->Html->link('⇓', array(
                                'controller' => 'items', 'action' => 'index',
                                'sort:Item.title', 'direction:desc'
                            ))."\n";
                            echo $this->Html->link('⇑', array(
                                'controller' => 'items', 'action' => 'index',
                                'sort:Item.title', 'direction:asc'
                            ))."\n";?>
                    </li>
                    <li>
                        <?php __('Date added');
                            echo $this->Html->link('⇓', array(
                                'controller' => 'items', 'action' => 'index',
                                'sort:Item.added', 'direction:desc'
                            ))."\n";
                            echo $this->Html->link('⇑', array(
                                'controller' => 'items', 'action' => 'index',
                                'sort:Item.added', 'direction:asc'
                            ))."\n";?>
                    </li>
                    <li>
                        <?php __('Year of publication');
                            echo $this->Html->link('⇓', array(
                                'controller' => 'items', 'action' => 'index',
                                'sort:Item.date', 'direction:desc'
                            ))."\n";
                            echo $this->Html->link('⇑', array(
                                'controller' => 'items', 'action' => 'index',
                                'sort:Item.date', 'direction:asc'
                            ))."\n";?>
                    </li>
                </ul>
            </div>
            <div id="ajax" class="grid_9 omega">
            <?php echo $this->Session->flash(); ?>

            <?php echo $content_for_layout; ?>
            </div>

        </div>
        <div class="clear"></div>
        <div id="footer" class="grid_12">
        </div>
        <div class="clear"></div>
    </div>
    <?php echo $this->Js->writeBuffer(); ?>
</body>
</html>