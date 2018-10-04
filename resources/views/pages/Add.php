<?php
/**
 * Created by PhpStorm.
 * User: Romymae
 * Date: 4-10-2018
 * Time: 11:52
 */
echo'<div class="mainContainer">
    <div>
        <form method="post" action="/register">
            <div class="form-group">
                <div class="input-group mb-5">
                  <h4 class="title" for="fname">First name</h4>
                </div>
                <div class="input-group-prepend">
                    <div class="input-group-text icon-form"><i class="fas fa-user"></i></div>
                 <input type="text" class="form-control ownInput" id="fname" placeholder="Enter your firstname" name="fname">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-5">
                    <h4 class="title" for="lname">Last name</h4>
                </div>
                <div class="input-group-prepend">
                    <div class="input-group-text icon-form"><i class="fas fa-user"></i></div>
                <input type="text" class="form-control ownInput" id="lname" placeholder="Enter your lastname" name="lname">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-5">
                <h4 class="title" for="email">E-mail</h4>
                </div>
                <div class="input-group-prepend">
                    <div class="input-group-text icon-form"><i class="fas fa-envelope"></i></div>
                <input type="email" class="form-control ownInput" id="email" placeholder="Enter your e-mail" name="email">
            </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-5">
                <h4 class="title" for="lname">Mobile number</h4>
                </div>
                <div class="input-group-prepend">
                    <div class="input-group-text icon-form"><i class="fas fa-phone"></i></div>
                <input type="number" class="form-control ownInput" id="mobilenumber" placeholder="Enter your mobile number" name="mobile">
            </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-5">
                <h4 class="title" for="password">Password</h4>
                </div>
                <div class="input-group-prepend">
                    <div class="input-group-text icon-form"><i class="fas fa-lock"></i></div>
                <input type="password" class="form-control ownInput" id="password" placeholder="Enter your password" name="password">
            </div>
             <div class="form-group">
                <div class="input-group mb-5">
             </div>
                <div class="input-group-prepend">
                    <div class="input-group-text icon-form"><i class="fas fa-lock"></i></div>
                <input type="password" class="form-control ownInput" id="password2" placeholder="Repeat password" name="password2">
            </div>
            </div>
            <button type="submit" class="btn btn-primary house-btn">Submit</button>
        </form>
    </div>
</div>


<script src="js/register.js"></script>';