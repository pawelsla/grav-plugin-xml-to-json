<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class XmlToJsonPlugin
 * @package Grav\Plugin
 */
class XmlToJsonPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onTwigPageVariables' => ['onTwigPageVariables', 0]
        ]);
    }

    /**
     * Do some work for this event, full details of events can be found
     * on the learn site: http://learn.getgrav.org/plugins/event-hooks
     *
     * @param Event $e
     */

    public function onTwigPageVariables()
    {

        $xml = '';

        $twig = $this->grav['twig'];
        (function () use (&$xml) {

            $query = $this->grav['config']->get('plugins.xml-to-json.query');
            $key = $this->grav['config']->get('plugins.xml-to-json.key');
            $url = $this->grav['config']->get('plugins.xml-to-json.url');
            $path = "{$url}?key={$key}&q={$query}";



            $myxmlfilecontent = @file_get_contents($path);
            $xml = simplexml_load_string($myxmlfilecontent);
            $xml = json_encode($xml);
        })();


        $twig->twig_vars['api'] = $xml;
    }


   
}
