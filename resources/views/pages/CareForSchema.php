<div class="mainContainer" style="min-height: 100vh;">
    <div class="accordion" id="accordion">
        <?php foreach ($clients as $id => $name) { ?>
            <div class="card">
                <div class="card-header header" id="heading<?= $id ?>" data-toggle="collapse" data-target="#collapse<?= $id ?>" aria-expanded="false" aria-controls="collapse<?= $id ?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed header-button" type="button">
                            <?= $name ?>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?= $id ?>" class="collapse" aria-labelledby="heading<?= $id ?>" data-parent="#accordion">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <form id="upload<?= $id ?>" action="/h/careforschemas" method="post" enctype="multipart/form-data">
                                        <?php
                                            \Qui\lib\Form::input("Upload", "fa-save",
                                                "<input type=\"hidden\" name=\"clientId\" value=\"$id\">
                                                            <input type=\"hidden\" name=\"upload\" value=\"update\">
                                                            <div class=\"fileUpload btn btn-primary house-btn\">
                                                                <span>File</span>
                                                                <input type=\"file\" name=\"treatmentDocument\" class=\"upload treatmentDocument\" required>
                                                            </div>
                                                            <div class=\"uploadFileParent\">
                                                                <a class=\"uploadFile\">Geen bestand gekozen</a>
                                                            </div>");
                                        ?>
                                        <br>
                                        <button type="submit" class="btn btn-primary house-btn">Upload</button>
                                    </form>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <form action="/h/careforschemas" method="post">
                                        <h3 class="title">Download</h3>
                                        <input type="hidden" name="clientId" value="$id">
                                        <button type="submit" class="btn btn-primary house-btn">Download</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<link href="/../css/careForSchema.css" rel="stylesheet"/>
<script src="/../js/careForSchema.js"></script>