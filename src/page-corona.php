<?php
/*
Template Name: Corona
*/
?>

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
