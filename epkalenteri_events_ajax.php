<?php 
defined('_JEXEC') or die;
require_once(__DIR__ . '/linkedevents-controller.php');
jimport('joomla.plugin.plugin');

class plgAjaxEpkalenteri_events_ajax extends JPlugin {
	function onAjaxEpkalenteri_events_ajax() {
    $params = $_REQUEST['params'];
    $paramsArray = json_decode($params, true);
    $html = self::getHtml($paramsArray);
    
		return $html;
  }
  
  public function getHtml($paramsArray) {
    $linkedEventsController = new LinkedeventsController();
    $events = $linkedEventsController->getEvents($paramsArray);
    $html = self::buildHtml($events);
    return array("events"=>$html);
  }

  private static function buildHtml ($events) {
    require_once(__DIR__.'/templates/event.php');
    $eventTemplate = new EventTemplate();
    $html = '<div class="epkalenteri-events-list">';

    foreach ($events['data'] as $event) {
      $html = $html . $eventTemplate->getEventHtml($event);
    }

    $html = $html . '</div>';
    return $html;
  }
}
