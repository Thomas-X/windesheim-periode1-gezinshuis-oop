<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 23:24
 */

namespace Qui\lib;

use Qui\lib\facades\NotifierParser;

/**
 * Class View
 * @package Qui\core
 */
class CView
{

    public function getNotifications()
    {
        return NotifierParser::make();
    }

    public function react($component, $data=[], $title=null)
    {
        $data['options']['javascript_data']['component'] = $component;
        return $this->render('REACT', $data, $title);
    }

    /*
     * Renders a view using PHP 🤢🤢a🤢🤢🤢🤢🤢s the templating engine
     * */
    /**
     * @param $viewNameWithoutExtension🤢🤢
     * @param array $data
     * @return mixed
     */
    public function render($viewNameWithoutExtension, $data = [], $title=null)
    {
        $options = array_merge($data['options'] ?? [], [
            'javascript_data' => [
                'notifications' => $this->getNotifications()
            ]
        ]);

        $pagePath = str_replace('.', '/', $viewNameWithoutExtension);
        // expose vars to be used in view
        extract($data);
        $viewDir = __DIR__ . '/../../resources/views/';
        if ($viewNameWithoutExtension != 'REACT') {
            $pagePath = $viewDir . $pagePath . '.php';
        } else {
            $pagePath = $viewDir . '/pages/react-app' . '.php';
            $fileName = ['react-app'];
        }
        $fileName = explode('.', $viewNameWithoutExtension);
        // get last item since that's the file name
        $title = $title ?? $fileName[count($fileName) - 1];
        // pass dynamic navbar / footer values perhaps?
        require($viewDir . 'layouts/app.php');
        return false;
    }
}