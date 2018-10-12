<div class="mainContainer" style="min-height: 100vh;">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">data overzicht</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">aantallen opgeslagen in de database.</h5>
                    <p class="card-text">hieronder kan je zien hoeveel aantallen van wat opgeslagen is.</p>
                    <ul class="list-group">
                        <?php
                        foreach ($counts as $count) {
                            echo "<li class=\"list-group-item d-flex justify-content-between align-items-center\">
                            {$count['name']}
                            <span class=\"badge badge-primary badge-pill\">{$count['count']}</span>
                        </li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">links.</h5>
                    <p class="card-text">hieronder zijn verschillende links om makkelijk de data te beheren.</p>
                    <ul class="list-group list-group-flush">
                        <?php
                            foreach ($links as $link) {
                                echo "<a class=\"list-group-item\" style='text-align: center;' href='{$link['link']}'>{$link['name']}</a>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>