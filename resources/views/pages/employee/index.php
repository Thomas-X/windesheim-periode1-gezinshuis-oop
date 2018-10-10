<div class="container">
    <div class="row bg-white wrapper m-0 p-3">
        <div class="col-lg-7 col-md-7 col-sm-12 mb-4">
            <h3 class="title">Mijn gegevens</h3>
            <form class="mt-3">
                <div class="form-group ">
                    <div class="input-group mb-5">
                        <div class="input-group-prepend">
                            <div class="input-group-text icon-form"><i class="fas fa-user"></i></div>
                        </div>
                        <input type="text" name="name" class="form-control ownInput" value="<?= $users[0]['fname'] ?>">
                    </div>
                </div>
                <div class="form-group ">
                    <div class="input-group mb-5">
                        <div class="input-group-prepend">
                            <div class="input-group-text icon-form"><i class="fas fa-id-card-alt"></i></div>
                        </div>
                        <input type="text" name="lastName" class="form-control ownInput" value="<?= $users[0]['lname'] ?>">
                    </div>
                </div>
                <div class="form-group ">
                    <div class="input-group mb-5">
                        <div class="input-group-prepend">
                            <div class="input-group-text icon-form"><i class="fas fa-phone"></i></div>
                        </div>
                        <input type="text" name="phone" class="form-control ownInput" value="<?= $users[0]['mobile'] ?>">
                    </div>
                </div>
                <div class="form-group ">
                    <div class="input-group mb-5">
                        <div class="input-group-prepend">
                            <div class="input-group-text icon-form"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        </div>
                        <input type="text" name="email" class="form-control ownInput" value="<?= $users[0]['email'] ?>" disabled>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>