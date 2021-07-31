<?php
/*
Template Name: Kontakt
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
			$email = sanitize_input($_POST['psvemail']);
		}

		if (trim($_POST['psvsubject']) !== '') {
			$subject = sanitize_input($_POST['psvsubject']);
		} else {
			$subject = '';
		}

		if (trim($_POST['psvmessage']) === '') {
			$messageError = true;
			$hasError = true;
		} else {
			$message = sanitize_input($_POST['psvmessage']);
		}

		if (!isset($hasError)) {
			$fullname = $firstname . ' ' . $name;

			$subjectMail = 'Kontaktformular: Nachricht von ' . $fullname;
			$body = '<div>
    <!--[if mso | IE]>
    <table
            align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:600px;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" width="600"
    >
        <tr>
            <td  style="line-height:0;font-size:0;mso-line-height-rule:exactly;">
                <v:image
                        style="border:0;mso-position-horizontal:center;position:absolute;top:0;width:600px;z-index:-3;" xmlns:v="urn:schemas-microsoft-com:vml"
                />
    <![endif]-->
    <div style="margin:0 auto;max-width:600px;">
        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tr style="vertical-align:top;">
                <td style="background: #ffffff no-repeat center center;padding:0;vertical-align:top;" height="0">
                    <!--[if mso | IE]>
                    <table
                            border="0" cellpadding="0" cellspacing="0" style="width:600px;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" width="600"
                    >
                        <tr>
                            <td>
                    <![endif]-->
                    <div class="mj-hero-content" style="margin:0 auto;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;">
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;">
                                        <tr>
                                            <td align="left" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                                <div style="font-family:helvetica,serif;font-size:32px;line-height:1;text-align:left;color:#F45E43;">' . $subjectMail . '</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0;padding:10px 25px;word-break:break-word;">
                                                <p style="border-top:solid 4px #F45E43;font-size:1px;margin:0 auto;width:100%;display: block;"> </p>
                                                <!--[if mso | IE]>
                              <table
                                 align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 4px #F45E43;font-size:1px;margin:0 auto;width:550px;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" role="presentation" width="550px"
                              >
                                <tr>
                                  <td style="height:0;line-height:0;">
                                    &nbsp;
                                  </td>
                                </tr>
                              </table>
                            <![endif]-->
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
        </table>
    </div>
    <!--[if mso | IE]>
    </td>
    </tr>
    </table>

    <table
            align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" width="600"
    >
        <tr>
            <td style="line-height:0;font-size:0;mso-line-height-rule:exactly;">
    <![endif]-->
    <div style="margin:0 auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0;padding:20px 0;text-align:center;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;">

                        <tr>

                            <td
                                    class="" style="vertical-align:top;width:600px;"
                            >
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" width="100%">
                            <tr>
                                <td align="left" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:helvetica;font-size:20px;font-weight:bold;line-height:1;text-align:left;color:#020202;">Name</div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:helvetica;font-size:16px;line-height:1;text-align:left;color:#000000;">' . $fullname . '</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <p style="border-top:solid 2px #636363;font-size:1px;margin:0 auto;width:100%;display:block;"> </p>
                                    <!--[if mso | IE]>
                      <table
                         align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 2px #636363;font-size:1px;margin:0 auto;width:550px;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" role="presentation" width="550px"
                      >
                        <tr>
                          <td style="height:0;line-height:0;">
                            &nbsp;
                          </td>
                        </tr>
                      </table>
                    <![endif]-->
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:helvetica;font-size:20px;font-weight:bold;line-height:1;text-align:left;color:#020202;">E-Mail</div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:helvetica;font-size:16px;line-height:1;text-align:left;color:#000000;">' . $email . '</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <p style="border-top:solid 2px #636363;font-size:1px;margin:0 auto;width:100%;display:block"> </p>
                                    <!--[if mso | IE]>
                      <table
                         align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 2px #636363;font-size:1px;margin:0 auto;width:550px;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" role="presentation" width="550px"
                      >
                        <tr>
                          <td style="height:0;line-height:0;">
                            &nbsp;
                          </td>
                        </tr>
                      </table>
                    <![endif]-->
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:helvetica;font-size:20px;font-weight:bold;line-height:1;text-align:left;color:#020202;">Betreff</div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:helvetica;font-size:16px;line-height:1;text-align:left;color:#000000;">' . $subject . '</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <p style="border-top:solid 2px #636363;font-size:1px;margin:0 auto;width:100%;display:block;"> </p>
                                    <!--[if mso | IE]>
                      <table
                         align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 2px #636363;font-size:1px;margin:0 auto;width:550px;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" role="presentation" width="550px"
                      >
                        <tr>
                          <td style="height:0;line-height:0;">
                            &nbsp;
                          </td>
                        </tr>
                      </table>
                    <![endif]-->
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:helvetica;font-size:20px;font-weight:bold;line-height:1;text-align:left;color:#020202;">Nachricht</div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:helvetica;font-size:16px;line-height:1;text-align:left;color:#000000;">' . $message . '</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>

                    </tr>

                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--[if mso | IE]>
    </td>
    </tr>
    </table>

    <table
            align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" width="600"
    >
        <tr>
            <td style="line-height:0;font-size:0;mso-line-height-rule:exactly;">
    <![endif]-->
    <div style="margin:0 auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0;padding:20px 0;text-align:center;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;">

                        <tr>

                            <td
                                    class="" style="vertical-align:top;width:600px;"
                            >
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;" width="100%">
                            <tr>
                                <td align="center" style="font-size:0;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:helvetica;font-size:16px;line-height:1;text-align:center;color:#000000;">Gesendet von <a href="https://psv-herford-badminton.de">PSV Herford Badminton</a></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
</div>';

			$headers = array('Content-Type: text/html; charset=UTF-8');

			wp_mail('jonas.pfannkuche@psv-herford-badminton.de', $subjectMail, $body, $headers);

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
					<p>Das Formular ist leider aktuell nicht erreichbar. Bitte lade die Seite neu und probiere es
						erneut.<p>
				<?php } ?>

				<form class="row needs-validation mb-5 g-3" action="<?php htmlspecialchars(the_permalink()); ?>" id="contactForm" method="post" enctype="multipart/form-data" novalidate>
					<div class="col-md-6">
						<label for="psvfirstname" class="form-label">Vorname<span class="mandatory">*</span></label>
						<input type="text" class="form-control" id="psvfirstname" name="psvfirstname" placeholder="Vorname" autocomplete="given-name" value="<?php if (isset($_POST['psvfirstname'])) echo sanitize_input($_POST['psvfirstname']); ?>" required>
						<div class="invalid-feedback">
							Bitte gib deinen Vornamen an.
						</div>
					</div>
					<div class="col-md-6">
						<label for="psvname" class="form-label">Nachname<span class="mandatory">*</span></label>
						<input type="text" class="form-control" id="psvname" name="psvname" placeholder="Nachname" autocomplete="family-name" value="<?php if (isset($_POST['psvname'])) echo sanitize_input($_POST['psvname']); ?>" required>
						<div class="invalid-feedback">
							Bitte gib deinen Nachnamen an.
						</div>
					</div>
					<div class="col-12">
						<label for="psvemail" class="form-label">E-Mail<span class="mandatory">*</span></label>
						<input type="email" class="form-control" id="psvemail" name="psvemail" placeholder="E-Mail" autocomplete="email" value="<?php if (isset($_POST['psvemail'])) echo sanitize_input($_POST['psvemail']); ?>" required>
						<div class="invalid-feedback">
							Bitte gib eine gültige E-Mail Adresse an.
						</div>
					</div>
					<div class="col-12">
						<label for="subject" class="form-label">Betreff</label>
						<input type="text" class="form-control" id="subject" name="psvsubject" value="<?php if (isset($_POST['psvsubject'])) echo sanitize_input($_POST['psvsubject']); ?>" placeholder="Betreff">
					</div>
					<div class="col-12">
						<label for="message" class="form-label">Nachricht<span class="mandatory">*</span></label>
						<textarea type="text" class="form-control" id="message" name="psvmessage" rows="5" placeholder="Deine Nachricht" required><?php if (isset($_POST['psvmessage'])) echo sanitize_input($_POST['psvmessage']); ?></textarea>
						<div class="invalid-feedback">
							Bitte gib eine Nachricht ein.
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
