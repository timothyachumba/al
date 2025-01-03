<!doctype html>
<html lang="und" dir="auto" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <title></title>
  <!--[if !mso]><!-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    #outlook a {
      padding: 0;
    }

    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      border-collapse: collapse;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    p {
      display: block;
      margin: 13px 0;
    }

  </style>
  <!--[if mso]>
    <noscript>
    <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    </noscript>
    <![endif]-->
  <!--[if lte mso 11]>
    <style type="text/css">
      .mj-outlook-group-fix { width:100% !important; }
    </style>
    <![endif]-->
  <style type="text/css">
    @media only screen and (min-width:480px) {
      .mj-column-per-100 {
        width: 100% !important;
        max-width: 100%;
      }

      .mj-column-per-25 {
        width: 25% !important;
        max-width: 25%;
      }
    }

  </style>
  <style media="screen and (min-width:480px)">
    .moz-text-html .mj-column-per-100 {
      width: 100% !important;
      max-width: 100%;
    }

    .moz-text-html .mj-column-per-25 {
      width: 25% !important;
      max-width: 25%;
    }

  </style>
  <style type="text/css">
    table,
    table tr,
    table td {
      border: 0 solid transparent;
    }

    .uppercase,
    .uppercase * {
      text-transform: uppercase !important;
    }

    .typography p {
      margin: 0;
      padding: 0;
    }

    .typography h1,
    .typography h2,
    .typography h3,
    .typography h4 {
      font-weight: 600;
    }

    .typography h1 {
      margin: 0;
      padding: 1.5em 0 .5em;
    }

    .typography h3:not(:first-child) {
      margin: 0;
      padding: 3em 0 2em;
    }

    .typography h4:not(:first-child) {
      margin: 0;
      padding: 2em 0 1em;
    }

    .typography a,
    .typography a:hover,
    .typography a:active,
    .typography a:visited,
    .typography a:focus {
      color: inherit;
      text-decoration: underline;
    }

    ul,
    ol {
      padding: 0 4ch;
      margin: 0;
    }

    ul.flat {
      padding: 0;
      margin: 0;
      list-style: none !important;
    }

    ol>li:not(:last-of-type) {
      padding-bottom: 16px;
    }

    ul>li:not(:last-of-type) {
      padding-bottom: 16px;
    }

  </style>
  <!--[if !mso]><!-->
  <style type="text/css">
    @import url(https://akukolabs.com/dist/assets/newsletter.css);

  </style>
  <!--<![endif]-->
</head>

<body style="word-spacing:normal;background-color:red;">
  <div style="display:none;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;"><?= $preview ?></div>
  <div style="background-color:red;" lang="und" dir="auto"> <?php foreach($blocks as $block): ?><?php if($block->type() === 'nl-header'): ?><!-- [nl-header] -->
    <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:640px;" width="640" ><tr><td style="line-height:0;font-size:0;mso-line-height-rule:exactly;"><v:image style="border:0;height:640px;mso-position-horizontal:center;position:absolute;top:0;width:640px;z-index:-3;" src="<?= $block->bgimg()->toFile()?->thumb(['width' => 640*2, 'height' => 640*2, 'crop' => true, 'format' => 'jpeg'])->url() ?>" xmlns:v="urn:schemas-microsoft-com:vml" /><![endif]-->
    <div style="margin:0 auto;max-width:640px;">
      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
          <tr style="vertical-align:top;">
            <td style="width:0.01%;padding-bottom:100%;mso-padding-bottom-alt:0;" />
            <td background="<?= $block->bgimg()->toFile()?->thumb(['width' => 640*2, 'height' => 640*2, 'crop' => true, 'format' => 'jpeg'])->url() ?>" style="background:<?= $block->bgcolor() ?> url('<?= $block->bgimg()->toFile()?->thumb(['width' => 640*2, 'height' => 640*2, 'crop' => true, 'format' => 'jpeg'])->url() ?>') no-repeat center center / cover;background-position:center center;background-repeat:no-repeat;padding:100px 0px;vertical-align:top;">
              <!--[if mso | IE]><table border="0" cellpadding="0" cellspacing="0" style="width:640px;" width="640" ><tr><td style=""><![endif]-->
              <div class="mj-hero-content" style="margin:0px auto;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0px;">
                  <tbody>
                    <tr>
                      <td style="">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;margin:0px;">
                          <tbody>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
            <td style="width:0.01%;padding-bottom:100%;mso-padding-bottom-alt:0;" />
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><![endif]-->
    <!-- [/nl-header] --><?php endif; ?><?php if($block->type() === 'nl-text'): ?><!-- [nl-text] -->
    <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:640px;" width="640" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="margin:0px auto;max-width:640px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:16px;text-align:center;">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:608px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                  <tbody>
                    <tr>
                      <td align="left" style="font-size:0px;padding:0px;word-break:break-word;">
                        <div style="font-family:PolySans, Helvetica, Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">text</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><![endif]-->
    <!-- [/nl-text] --><?php endif; ?><?php if($block->type() === 'nl-images'): ?><!-- [nl-images] -->
    <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:640px;" width="640" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="margin:0px auto;max-width:640px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:16px;text-align:center;">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:608px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                  <tbody>
                    <tr>
                      <td align="left" style="font-size:0px;padding:0px;word-break:break-word;">
                        <div style="font-family:PolySans, Helvetica, Arial;font-size:13px;line-height:1;text-align:left;color:#000000;">images</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><![endif]-->
    <!-- [/nl-images] --><?php endif; ?><?php if($block->type() === 'nl-line'): ?><!-- [nl-line] -->
    <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:640px;" width="640" bgcolor="<?= $block->bgcolor() ?>" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="background:<?= $block->bgcolor() ?>;background-color:<?= $block->bgcolor() ?>;margin:0px auto;max-width:640px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:<?= $block->bgcolor() ?>;background-color:<?= $block->bgcolor() ?>;width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:16px 0;text-align:center;">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:640px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                  <tbody>
                    <tr>
                      <td align="center" style="font-size:0px;padding:0;word-break:break-word;">
                        <p style="border-top:solid 1px <?= $block->bordercolor() ?>;font-size:1px;margin:0px auto;width:100%;">
                        </p>
                        <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px <?= $block->bordercolor() ?>;font-size:1px;margin:0px auto;width:640px;" role="presentation" width="640px" ><tr><td style="height:0;line-height:0;"> &nbsp;
</td></tr></table><![endif]-->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><![endif]-->
    <!-- [/nl-line] --><?php endif; ?><?php if($block->type() === 'nl-footer'): ?><!-- [nl-footer] -->
    <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:640px;" width="640" bgcolor="<?= $block->bgcolor() ?>" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="background:<?= $block->bgcolor() ?>;background-color:<?= $block->bgcolor() ?>;margin:0px auto;max-width:640px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:<?= $block->bgcolor() ?>;background-color:<?= $block->bgcolor() ?>;width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:16px;text-align:center;">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="width:608px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0;line-height:0;text-align:left;display:inline-block;width:100%;direction:ltr;">
                <!--[if mso | IE]><table border="0" cellpadding="0" cellspacing="0" role="presentation" ><tr><![endif]--> <?php $s=0; foreach($socials as $social): ?> <!--[if mso | IE]><td style="vertical-align:top;width:152px;" ><![endif]-->
                <div class="mj-column-per-25 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:25%;">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                    <tbody>
                      <tr>
                        <td align="<?php
    switch($s) {
        case 0: echo 'left'; break;
        case 3: echo 'right'; break;
        default:  echo 'center';
    }
?>" class="uppercase" style="font-size:0px;padding:0;word-break:break-word;">
                          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                            <tbody>
                              <tr>
                                <td align="center" bgcolor="transparent" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:0;background:transparent;" valign="middle">
                                  <a href="<?= $social->url() ?>" style="display:inline-block;background:transparent;color:<?= $block->textcolor() ?>;font-family:PolySans, Helvetica, Arial;font-size:8px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:0;mso-padding-alt:0px;border-radius:3px;" target="_blank"> <?= $social->title() ?> </a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!--[if mso | IE]></td><![endif]--> <?php $s++; endforeach; ?> <!--[if mso | IE]></tr></table><![endif]-->
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:640px;" width="640" bgcolor="<?= $block->bgcolor() ?>" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="background:<?= $block->bgcolor() ?>;background-color:<?= $block->bgcolor() ?>;margin:0px auto;max-width:640px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:<?= $block->bgcolor() ?>;background-color:<?= $block->bgcolor() ?>;width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:16px;text-align:center;">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="typography-outlook" style="vertical-align:top;width:608px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix typography" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                  <tbody>
                    <tr>
                      <td align="center" style="font-size:0px;padding:0px;word-break:break-word;">
                        <div style="font-family:PolySans, Helvetica, Arial;font-size:7px;line-height:1;text-align:center;color:<?= $block->textcolor() ?>;">Don't want to receive these updates anymore? <a href="<?= $unsubscribeLink ?>">Unsubscribe</a></div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]></td></tr></table><![endif]-->
    <!-- [/nl-footer] --><?php endif; ?><?php endforeach; ?>
  </div>
</body>

</html>
