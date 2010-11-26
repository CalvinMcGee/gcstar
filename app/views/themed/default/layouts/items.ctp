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
        echo $this->Html->script('jquery');

        echo $scripts_for_layout;
    ?>
</head>
<body>
    <div class="container_12">
        <div id="header" class="grid_12">
            <h1><?php echo Configure::read('Visual.title') ?></h1>
        </div>
        <div class="clear"></div>
        <div id="content" class="grid_12">
            <div class="grid_2 alpha">
                <?php
                    echo $paginator->sort(__('Sort by added', true), 'Item.added')."\n";
                    echo $paginator->sort(__('Sort by year of publication', true), 'Item.date')."\n";
                ?>
            </div>
            <div id="ajax" class="grid_10 omega">
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