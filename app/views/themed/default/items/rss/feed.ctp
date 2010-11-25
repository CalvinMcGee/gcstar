<?php
$this->set('documentData', array(
    'xmlns:dc' => 'http://purl.org/dc/elements/1.1/'));

$this->set('channelData', array(
    'title' => __("Most Recent Items", true),
    'link' => $this->Html->url('/', true),
    'description' => __('Most recent items.', true),
    'language' => 'en-us'));

foreach ($data as $post) {
    $postTime = strtotime($post['Item']['added']);

    $postLink = array(
        'controller' => 'items',
        'action' => 'item',
        $post['Item']['slug']);

    App::import('Sanitize');
    // This is the part where we clean the body text for output as the description
    // of the rss item, this needs to have only text to make sure the feed validates
    $bodyText = preg_replace('=\(.*?\)=is', '', $post['Item']['synopsis']);
    $bodyText = $text->stripLinks($bodyText);
    $bodyText = Sanitize::stripAll($bodyText);
    $bodyText = $text->truncate($bodyText, 400, '...', true, true);

    echo  $this->Rss->item(array(), array(
        'title' => $post['Item']['title'],
        'link' => $postLink,
        'guid' => array('url' => $postLink, 'isPermaLink' => 'true'),
        'description' =>  $bodyText,
        'dc:creator' => 'Joachim',
        'pubDate' => $postTime));
}
?>
