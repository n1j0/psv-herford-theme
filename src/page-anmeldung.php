<?php
/*
Template Name: Anmeldung
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

function sanitize_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}

if (isset($_POST['submitted'])) {
	if (honeypot_validate($_REQUEST)) {
		if (trim($_POST['psvfirstname']) === '') {
			$firstnameError = true;
			$hasError = true;
		} else {
			$firstname = sanitize_input($_POST['psvfirstname']);
		}

		if (trim($_POST['psvname']) === '') {
			$nameError = true;
			$hasError = true;
		} else {
			$name = sanitize_input($_POST['psvname']);
		}

		if (trim($_POST['psvemail']) === '') {
			$emailError = true;
			$hasError = true;
		} else {
			$email_check = sanitize_input($_POST['psvemail']);

			if (filter_var($email_check, FILTER_VALIDATE_EMAIL)) {
                $email = $email_check;
            } else {
                $emailError = true;
                $hasError = true;
            }
		}

        if (trim($_POST['psvtel']) === '') {
            $telError = true;
            $hasError = true;
        } else {
            $tel = sanitize_input($_POST['psvtel']);
        }

		if (trim($_POST['psvage']) === '') {
			$ageError = true;
            $hasError = true;
		} else {
            $age = sanitize_input($_POST['psvage']);
		}

		if (trim($_POST['psvaddress']) === '') {
			$addressError = true;
			$hasError = true;
		} else {
			$address = sanitize_input($_POST['psvaddress']);
		}

		if (!isset($hasError)) {
			$subjectMail = 'Neue Anmeldung';
			$body = '<div>
                <p><strong>Name Kind:</strong> ' . $firstname . '</p>
                <p><strong>Name Eltern:</strong> ' . $name . '</p>
                <p><strong>E-Mail:</strong> ' . $email . '</p>
                <p><strong>Telefon:</strong> ' . $tel . '</p>
                <p><strong>Geburtsdatum:</strong> ' . $age . '</p>
                <p><strong>Adresse:</strong> ' . $address . '</p>
</div>';

			$headers = array('Content-Type: text/html; charset=UTF-8', 'From: PSV Herford Badminton <jonas.pfannkuche@psv-herford-badminton.de>', 'Reply-To: Jonas Pfannkuche <jonas.pfannkuche@psv-herford-badminton.de>');

			wp_mail('jonas.pfannkuche@psv-herford-badminton.de', $subjectMail, $body, $headers);
            wp_mail($email, 'Automatische Bestätigung der Anmeldung', '<div><p>Wir freuen uns über die Anmeldung zu unserem Sportkurs!</p><p>In den nächsten Tagen erhalten Sie noch einmal alle Informationen.</p><p>Sportliche Grüße<br>Jonas Pfannkuche<br>PSV Herford Abteilung Badminton</p></div>', $headers);

			header('Location: /kontaktformular-abgeschickt');
		}
	} else {
		$isSpam = true;
	}
} ?>

<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php psv_herford_thumb_img('psv-herford-single'); ?>
				<?php the_title('<h1>', '</h1>'); ?>

				<div>
					<?php do_action('head_theme_before_content'); ?>
					<?php the_content(); ?>
					<?php do_action('head_theme_after_content'); ?>
				</div>

				<?php if (isset($hasError) || isset($isSpam)) { ?>
					<p>Das Formular ist leider aktuell nicht erreichbar. Bitte Seite neuladen und erneut ausprobieren.<p>
				<?php } ?>

				<form class="row needs-validation mb-5 g-3" action="<?php htmlspecialchars(the_permalink()); ?>" id="contactForm" method="post" enctype="multipart/form-data" novalidate>
					<div class="col-12">
						<label for="psvfirstname" class="form-label">Name der teilnehmenden Person<span class="mandatory">*</span></label>
						<input type="text" class="form-control" id="psvfirstname" name="psvfirstname" placeholder="Vorname Nachname" value="<?php if (isset($_POST['psvfirstname'])) echo sanitize_input($_POST['psvfirstname']); ?>" required>
						<div class="invalid-feedback">
							Bitte Namen angeben.
						</div>
					</div>
					<div class="col-12">
						<label for="psvname" class="form-label">Name erziehungsberechtige Person<span class="mandatory">*</span></label>
						<input type="text" class="form-control" id="psvname" name="psvname" placeholder="Vorname Nachname" value="<?php if (isset($_POST['psvname'])) echo sanitize_input($_POST['psvname']); ?>" required>
						<div class="invalid-feedback">
							Bitte Namen angeben.
						</div>
					</div>
					<div class="col-12">
						<label for="psvemail" class="form-label">E-Mail<span class="mandatory">*</span></label>
						<input type="email" class="form-control" id="psvemail" name="psvemail" placeholder="E-Mail Adresse" value="<?php if (isset($_POST['psvemail'])) echo sanitize_input($_POST['psvemail']); ?>" required>
						<div class="invalid-feedback">
							Bitte gültige E-Mail Adresse angeben.
						</div>
					</div>
                    <div class="col-md-6">
                        <label for="tel" class="form-label">Telefon<span class="mandatory">*</span></label>
                        <input type="tel" class="form-control" id="tel" name="psvtel" value="<?php if (isset($_POST['psvtel'])) echo sanitize_input($_POST['psvtel']); ?>" placeholder="Telefonnummer" required>
                        <div class="invalid-feedback">
                            Bitte Telefonnummer angeben.
                        </div>
                    </div>
					<div class="col-md-6">
						<label for="age" class="form-label">Geburtsdatum der teilnehmenden Person<span class="mandatory">*</span></label>
						<input type="date" class="form-control" id="age" name="psvage" value="<?php if (isset($_POST['psvage'])) echo sanitize_input($_POST['psvage']); ?>" placeholder="23.07.2012" required pattern="\d{2}.\d{2}.\d{4}">
                        <div class="invalid-feedback">
                            Bitte Geburtsdatum angeben.
                        </div>
					</div>
					<div class="col-12">
						<label for="address" class="form-label">Adresse<span class="mandatory">*</span></label>
						<input type="text" class="form-control" id="address" name="psvaddress" placeholder="Beispielstraße 12a, 12345 Musterstadt" required><?php if (isset($_POST['psvaddress'])) echo sanitize_input($_POST['psvaddress']); ?></input>
						<div class="invalid-feedback">
							Bitte gib eine Adresse ein.
						</div>
					</div>

					<!-- H o n e y p o t -->
					<label class="ohnohoney" for="name"></label>
					<input class="ohnohoney" autocomplete="off" type="text" id="name" name="name" placeholder="Your name here">
					<label class="ohnohoney" for="email"></label>
					<input class="ohnohoney" autocomplete="off" type="email" id="email" name="email" placeholder="Your e-mail here">

					<div class="col-12">
						<button type="submit" id="contact-form-submit" class="btn btn-primary float-right">Absenden</button>
					</div>

					<input type='hidden' name='submitted' id='submitted' value='true'/>
				</form>
			<?php endwhile; ?>
			<?php else : ?>
				<?php get_template_part('content', 'none'); ?>
			<?php endif; ?>
		</div>
		<div class="col-lg-4">
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
