<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 09/10/18
 * Time: 19:57
 */

namespace Qui\lib;


class Form
{
    public static function input($title, $iconName, $inputElement)
    {
        echo "<div class=\"form-group\">
                <h3 class=\"title\">{$title}</h3>
                <div class=\"form-group\">
                    <div class=\"input-group mb-5\">
                        <div class=\"input-group-prepend\">
                            <div class=\"input-group-text icon-form\"><i class=\"fas {$iconName}\"></i></div>
                        </div>
                        {$inputElement}
                    </div>
                </div>
            </div>";
    }

}