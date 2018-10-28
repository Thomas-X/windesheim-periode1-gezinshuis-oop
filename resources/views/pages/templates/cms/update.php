<div class="container" style="min-height: 100vh;">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"><?= $title ?></h1>
            <?= $subtitle ? "<p>{$subtitle}</p>" : '' ?>
        </div>
    </div>
    <form action="<?= $baseUri . "?id={$_GET['id']}&type=update_post" ?>" method="post">
        <?php
        foreach ($fields as $field) {
            if ($field['not_in_update']) {
                echo "<input name=\"{$field['name']}\" style=\"display: none;\" value=\"{$fieldData[$field['name']]}\"/>";
                continue;
            }

                $fieldElem = "";
            switch ($field['html_type']) {
                case 'input':
                    $fieldElem = "<input type=\"{$field['type']}\" class=\"form-control\" placeholder=\"{$field['placeholder']}\" name=\"{$field['name']}\" required value='{$fieldData[$field['name']]}'>";
                    break;
                case 'textarea':
                    $fieldElem = "<textarea class='form-control' rows='3' name=\"{$field['name']}\" required>" . $fieldData[$field['name']] . "</textarea>";
                    break;
                case 'checkbox':
                    if ((int)$fieldData[$field['name']] === 1) {
                        $checked = 'checked';
                    } else {
                        $checked = null;
                    }
                    $fieldElem = "<div class=\"form-check\">
  <input class=\"form-check-input\" type=\"checkbox\" value=\"{$field['value']}\" name=\"{$field['name']}\" {$checked}>
  <label class=\"form-check-label\" for=\"defaultCheck1\">
    {$field['title']}
  </label>
</div>";
                    break;
                case 'select':
                    $options = "";
                    foreach ($field['values'] as $value) {
                        $options = $options . "<option value=\"{$value['value']}\">{$value['title']}</option>";
                    }
                    $fieldElem = "<select name=\"{$field['name']}\" class='form-control'>
            {$options}
</select>";
            }
            $muteText = !!$field['muteText']
                ? "<small class=\"form-text text-muted\">{$field['muteText']}</small>"
                : null;
            $label = $field['html_type'] != 'checkbox' ? "<label>{$field['title']}</label>" : null;

            if (array_key_exists('custom_html', $field)) {
                echo $field['custom_html'];
            } else {
                echo "<div class=\"form-group\">
            {$label}
            {$fieldElem}
            {$muteText}
        </div>";
            }
        }
        ?>
        <button class="btn btn-success" type="submit">
            Update
        </button>
    </form>
</div>