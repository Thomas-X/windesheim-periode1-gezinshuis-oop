<div class="mainContainer" style="min-height: 100vh;">
    <?php
    if (is_array($clients) && !empty($clients))
    {
        echo '<form action="/upload", method="post">';
        echo '<div class="form-group">';
        echo '<label for="clients">Cliënt: </label>';
        echo '<select class="form-control" id="clients">';
        foreach ($clients as $id => $name)
        {
            echo "<option value='$id'>$name</option>";
        }
        echo '</select>';
        echo '</div>';

        echo '<div class="form-group">';
        echo '<label for="treatmentDocument">Behandel document: </label>';
        echo '<input type="file" class="form-control-file" id="treatmentDocument">';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary">Opslaan</button>';
        echo '</form>';
    }
    ?>
</div>