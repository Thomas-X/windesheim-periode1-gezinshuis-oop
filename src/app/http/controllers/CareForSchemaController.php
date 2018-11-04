<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 2-10-2018
 * Time: 19:36
 */

namespace Qui\app\http\controllers;

use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\CareForSchema;
use Qui\lib\Routes;

/**
 * Class CareForSchemaController
 * @package Qui\app\http\controllers
 */
class CareForSchemaController
{

    public function downloadCareForSchemas(Request $req, Response $res)
    {
        if (isset($req->params['type']) && $req->params['type'] === 'download_post')
                CareForSchema::downloadCareForSchemas($req, $res);
        $res->redirect(Routes::$routes['cms_careforschema']);
    }
}