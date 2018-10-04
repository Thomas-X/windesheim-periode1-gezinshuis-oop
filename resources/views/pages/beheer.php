<?php
/**
 * Created by PhpStorm.
 * User: Romymae
 * Date: 3-10-2018
 * Time: 15:58
 */
?>
<div class="mainContainer">
    <div class=" col-sm-12 " >
        <button class="accordion house-btn-mirror">Verzorgers</button>
        <div class="panel">
            <a href="">Toevoegen</a>
            <table class="tableUsers">
            <tr><th>ID</th><th>Voornaam</th><th>Achternaam</th><th>Geboortedatum</th><th>E-mail</th><th>Telefoonnummer</th><th>Verwijderen</th><th>Aanpassen</th></tr>
            </table>
        </div>

        <button class="accordion house-btn">Triade</button>
        <div class="panel">
            <a href="">Toevoegen</a>
            <table class="tableUsers">
                <tr><th>ID</th><th>Voornaam</th><th>Achternaam</th><th>Geboortedatum</th><th>E-mail</th><th>Telefoonnummer</th><th>Verwijderen</th><th>Aanpassen</th></tr>
            </table>
        </div>

        <button class="accordion house-btn-mirror ">Kinderen</button>
        <div class="panel">
             <a href="/beheer/add">Toevoegen</a>
            <table class="tableUsers">
                <tr><th>ID</th><th>Voornaam</th><th>Achternaam</th><th>Geboortedatum</th><th>E-mail</th><th>Telefoonnummer</th><th>Verwijderen</th><th>Aanpassen</th></tr>
            </table>
        </div>

        <button class="accordion house-btn">Ouders/verzorgers</button>
        <div class="panel">
            <a href="">Toevoegen</a>
            <table class="tableUsers">
                <tr><th>ID</th><th>Voornaam</th><th>Achternaam</th><th>Geboortedatum</th><th>E-mail</th><th>Telefoonnummer</th><th>Verwijderen</th><th>Aanpassen</th></tr>
            </table>
        </div>
    </div>
</div>'?>
<!--for the arcordion, this makes it flip open and close -->
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight){
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>

