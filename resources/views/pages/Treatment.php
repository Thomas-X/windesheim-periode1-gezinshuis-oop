<div class="mainContainer" style="min-height: 100vh;">
    <?php
    if (isset($clients) && is_array($clients))
    {
        //Create the form to upload a file
        echo '<form action="/upload" method="post" enctype="multipart/form-data">';

        //Create the client selection
        echo '<div class="form-group">';
        echo '<label for="client">Cliënt: </label>';
        echo '<select class="form-control" id="client" name="client">';
        foreach ($clients as $id => $name)
        {
            echo "<option value='$id'>$name</option>";
        }
        echo '</select>';
        echo '</div>';

        //Create the file selection
        echo '<div class="form-group">';
        echo '<label for="treatmentDocument">Behandel document: </label>';
        echo '<input type="file" class="form-control-file" id="treatmentDocument" name="treatmentDocument">';
        echo '</div>';

        echo '<button type="submit" class="btn btn-primary">Opslaan</button>';
        echo '</form>';
    }
    ?>
</div>