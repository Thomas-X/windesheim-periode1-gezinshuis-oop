<!-- begin image holder -->
<section>
    <div class="wrapper" style="height: 40vh;">
        <div class="mask" style="background: url('imgs/happy-child.jpg');background-repeat: no-repeat;background-size: cover; background-position: center;">
            <div class="d-flex justify-content-center align-items-center wrapper-body">
                <h4>evenementen</h4>
            </div>
        </div>
    </div>
</section>
<!-- end image holder -->
<div class="container">
    <div class="row m-5">
        <div class="event-header text-center w-100 pt-5">
            <h3>laatst toegevoegde evenementen</h3>
        </div>
        <hr style="width: 100%;"/>
    </div>
    <div class="row mt-5">
        <?php foreach ($events as $key => $event): ?>
            <div class="col-lg-4 col-md-4 col-sm-6 mt-5 mb-5">
                <div class="blog-card">
                    <div class="blog-body">
                        <div class="img-wrap">
                            <img src="<?= $event['pictures'] ?>"/>
                            <div class="date-wrap">
                                <div class="date-text">
                                    <div class="date-num">
                                        <span><?= substr($event['date_event'], 8, 9)  ?></span>
                                        <span><?php
                                            $d = date_parse_from_format("Y-m-d", $event["date_event"]);
                                            echo $month[$d["month"]];
                                            ?>
                                        </span>
                                    </div>
                                    <span class="day">
                                        <?php
                                        $day = date('N', strtotime($event["date_event"]));
                                        echo $days[$day - 1];
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-name">
                            <div class="blog-name-wrap">
                                <div class="name-button text-center">
                                    <p><?= $event['eventname'] ?></p>
                                    <a href="#" class="btn btn-primary a-btn-default unique-btn">naar evenement</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="js/events.js"></script>