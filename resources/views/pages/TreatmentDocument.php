<div class="mainContainer" style="min-height: 100vh;">
    <?php
    if (isset($clients) && is_array($clients))
    {
        //Create the form to upload a file
        echo '<form action="/upload" method="post" enctype="multipart/form-data">';

        //Create the client selection
        echo '<div class="form-group">';
        echo '<div class="input-group">';
        echo '<h4 class="title" for="client">Cliënt</h4>';
        echo '</div>';
        echo '<select class="form-control" id="client" name="client">';
        foreach ($clients as $id => $name)
        {
            echo "<option value='$id'>$name</option>";
        }
        echo '</select>';
        echo '</div>';

        //Create the file selection
        echo '<div class="form-group">';
        echo '<div class="input-group">';
        echo '<h4 class="title" for="treatmentDocument">Behandel document</h4>';
        echo '</div>';
        echo '<div class="btn btn-primary house-btn uploadFile">';
        echo '<span>Upload</span>';
        echo '<input type="file" id="treatmentDocument" name="treatmentDocument" class="upload" required>';
        echo '</div>';
        echo '<a id="uploadFile">Geen bestand gekozen</a>';
        echo '</div>';

        echo '<button type="submit" class="btn btn-primary house-btn">Opslaan</button>';
        echo '</form>';
    }
    ?>
</div>
<link href="css/treatmentDocument.css" rel="stylesheet"/>
<script src="js/treatmentDocument.js"></script>