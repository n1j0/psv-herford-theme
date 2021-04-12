<?php
/*
Template Name: Corona
*/

/**
 * Check if a honeypot field was filled on the form
 * By checking on the $_REQUEST for the given field names
 * in the $honeypot_fields. The field names passed on this
 * var must be empty on the REQUEST.
 *
 * @param $req {Array} must receive $_REQUEST superglobal
 * @return bool {Boolean} tells if the honeypot catched something
 */
function honeypot_validate($req)
{
    if (!empty($req)) {
        $honeypot_fields = [
            "name",
            "email"
        ];
        foreach ($honeypot_fields as $field) {
            if (isset($req[$field]) && !empty($req[$field])) {
                return false;
            }
        }
    }
    return true;
}

function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

if (isset($_POST['submitted'])) {
    if (honeypot_validate($_REQUEST)) {
        if (trim($_POST['psvfirstname']) === '') {
            $hasError = true;
        } else {
            $firstname = sanitize_input($_POST['psvfirstname']);
        }

        if (trim($_POST['psvname']) === '') {
            $hasError = true;
        } else {
            $name = sanitize_input($_POST['psvname']);
        }

        if (trim($_POST['psvtel']) === '') {
            $hasError = true;
        } else {
            $email = sanitize_input($_POST['psvtel']);
        }

        if (trim($_POST['psvstreet']) !== '') {
            $street = sanitize_input($_POST['psvstreet']);
        } else {
            $street = '';
        }

        if (!isset($hasError)) {

        }
    } else {
        $isSpam = true;
    }
} ?>

<?php get_header(); ?>
<div class="container">
    <?php if (have_posts()) : while (have_posts()) :
        the_post(); ?>
        <?php psv_herford_thumb_img('psv-herford-single'); ?>
        <?php the_title('<h1>', '</h1>'); ?>

        <div>
            <?php do_action('head_theme_before_content'); ?>
            <?php the_content(); ?>
            <?php do_action('head_theme_after_content'); ?>
        </div>

        <?php if (isset($hasError) || isset($isSpam)) { ?>
        <p>Das Formular ist leider aktuell nicht erreichbar. Bitte lade die Seite neu und probiere es
            erneut.
        <p>
    <?php } ?>
        <h2 class="h4">
            <?php
            setlocale(LC_TIME, "de_DE");
            echo utf8_encode(strftime("%A")) . ", " . date("d.m.Y");
            ?></h2>
        <form class="row needs-validation mb-5 g-3" id="coronaForm"
              method="post" enctype="multipart/form-data" novalidate>
            <div class="col-md-6">
                <label for="psvfirstname" class="form-label">Vorname<span class="mandatory">*</span></label>
                <input type="text" class="form-control" id="psvfirstname" name="psvfirstname" placeholder="Vorname"
                       autocomplete="given-name" required>
                <div class="invalid-feedback">
                    Bitte gib deinen Vornamen an.
                </div>
            </div>
            <div class="col-md-6">
                <label for="psvname" class="form-label">Nachname<span class="mandatory">*</span></label>
                <input type="text" class="form-control" id="psvname" name="psvname" placeholder="Nachname"
                       autocomplete="family-name" required>
                <div class="invalid-feedback">
                    Bitte gib deinen Nachnamen an.
                </div>
            </div>
            <div class="col-12">
                <label for="psvtel" class="form-label">Telefonnr.<span class="mandatory">*</span></label>
                <input type="tel" class="form-control" id="psvtel" name="psvtel" placeholder="Telefonnr." required>
                <div class="invalid-feedback">
                    Bitte gib eine gültige Telefonnummer an.
                </div>
            </div>
            <div class="col-md-8">
                <label for="psvstreet" class="form-label">Straße<span class="mandatory">*</span></label>
                <input type="text" class="form-control" id="psvstreet" name="psvstreet" placeholder="Straße" required>
                <div class="invalid-feedback">
                    Bitte gib deine Straße an.
                </div>
            </div>
            <div class="col-md-4">
                <label for="psvnumber" class="form-label">Hausnr.<span class="mandatory">*</span></label>
                <input type="text" class="form-control" id="psvnumber" name="psvnumber" placeholder="Hausnr." required>
                <div class="invalid-feedback">
                    Bitte gib deine Hausnummer an.
                </div>
            </div>
            <div class="col-md-6">
                <label for="psvzip" class="form-label">PLZ<span class="mandatory">*</span></label>
                <input type="text" class="form-control" id="psvzip" name="psvzip" placeholder="PLZ" required>
                <div class="invalid-feedback">
                    Bitte gib deine PLZ an.
                </div>
            </div>
            <div class="col-md-6">
                <label for="psvcity" class="form-label">Ort<span class="mandatory">*</span></label>
                <input type="text" class="form-control" id="psvcity" name="psvcity" placeholder="Ort" required>
                <div class="invalid-feedback">
                    Bitte gib deinen Wohnort an.
                </div>
            </div>

            <!-- H o n e y p o t -->
            <label class="ohnohoney" for="name"></label>
            <input class="ohnohoney" autocomplete="off" type="text" id="name" name="name" placeholder="Your name here">
            <label class="ohnohoney" for="email"></label>
            <input class="ohnohoney" autocomplete="off" type="email" id="email" name="email"
                   placeholder="Your e-mail here">

            <div class="col-12">
                <button type="submit" id="corona-form-submit" class="btn btn-primary float-right">Anmelden</button>
            </div>

            <input type='hidden' name='submitted' id='submitted' value='true'/>
        </form>
    <?php endwhile; ?>
    <?php else : ?>
        <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
