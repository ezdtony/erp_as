<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'assets/phpmailer/src/Exception.php';
require 'assets/phpmailer/src/PHPMailer.php';
require 'assets/phpmailer/src/SMTP.php';
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex">
                    <!-- <a href="javascript: void(0);" class="btn btn-primary ms-2">
                             <i class="mdi mdi-autorenew"></i>
                         </a> -->
                </form>
            </div>
            <h4 class="page-title">Envíar status de Viáticos</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Depósitos</h4>
                <br>
                <!-- <form action="https://formsubmit.co/your@email.com" method="POST">
                    <input type="text" name="name" required>
                    <input type="email" name="email" required>
                    <button type="submit">Send</button>
                </form> -->

                <!-- Contact Section -->
                <div id="contact" class="text-center">
                    <div class="container">
                        <div class="section-title center">
                            <h2>Contacto</h2>
                            <hr>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <h3>Envíame un mensaje</h3>

                            <?php
                            $html_cuerpo = '<!DOCTYPE html>
                            <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
                            
                            <head>
                                <title></title>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
                                <style>
                                    * {
                                        box-sizing: border-box;
                                    }
                            
                                    body {
                                        margin: 0;
                                        padding: 0;
                                    }
                            
                                    a[x-apple-data-detectors] {
                                        color: inherit !important;
                                        text-decoration: inherit !important;
                                    }
                            
                                    #MessageViewBody a {
                                        color: inherit;
                                        text-decoration: none;
                                    }
                            
                                    p {
                                        line-height: inherit
                                    }
                            
                                    .desktop_hide,
                                    .desktop_hide table {
                                        mso-hide: all;
                                        display: none;
                                        max-height: 0px;
                                        overflow: hidden;
                                    }
                            
                                    @media (max-width:640px) {
                                        .desktop_hide table.icons-inner {
                                            display: inline-block !important;
                                        }
                            
                                        .icons-inner {
                                            text-align: center;
                                        }
                            
                                        .icons-inner td {
                                            margin: 0 auto;
                                        }
                            
                                        .image_block img.big,
                                        .row-content {
                                            width: 100% !important;
                                        }
                            
                                        .mobile_hide {
                                            display: none;
                                        }
                            
                                        .stack .column {
                                            width: 100%;
                                            display: block;
                                        }
                            
                                        .mobile_hide {
                                            min-height: 0;
                                            max-height: 0;
                                            max-width: 0;
                                            overflow: hidden;
                                            font-size: 0px;
                                        }
                            
                                        .desktop_hide,
                                        .desktop_hide table {
                                            display: table !important;
                                            max-height: none !important;
                                        }
                                    }
                                </style>
                            </head>
                            
                            <body style="background-color: #DFDFDF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
                                <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #DFDFDF;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                                            <div class="alignment" align="center" style="line-height:10px"><img class="big" src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/top_rounded_15.png" style="display: block; height: auto; border: 0; width: 620px; max-width: 100%;" width="620" alt="Image" title="Image"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/hero_bg_2.jpg); background-position: top center; background-repeat: no-repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-left:60px;padding-right:60px;padding-top:60px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; font-family: Oswald, Lucida Sans Unicode, Lucida Grande, sans-serif; mso-line-height-alt: 21.6px; color: #FFFFFF; line-height: 1.8;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 61.2px;"><span style="font-size:34px;"><span style="font-size:34px;">Estimado </span><strong><span style="font-size:34px;"><span style="font-size:34px;background-color:#ffffff;"><span style="color:#003300;font-size:34px;background-color:#ffffff;">&nbsp;</span><span style="color:#003300;font-size:34px;background-color:#ffffff;"><span style="color:#008000;">Manuel León</span></span></span>,&nbsp;</span></strong></span></p>
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 43.2px;"><span style="font-size:24px;"><span style="font-size:24px;">Te recordamos que tienes hasta el día 25/Oct/2022 para finalizar la comprobación de gastos</span></span></p>
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21.6px;">&nbsp;</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table class="image_block block-2 mobile_hide" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                                            <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/smile.png" style="display: block; height: auto; border: 0; width: 64px; max-width: 100%;" width="64" alt="Image" title="Image"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <div class="spacer_block mobile_hide" style="height:125px;line-height:125px;font-size:1px;">&#8202;</div>
                                                                                <div class="spacer_block mobile_hide" style="height:40px;line-height:40px;font-size:1px;">&#8202;</div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ebebeb; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:20px;">
                                                                                            <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/barcode.png" style="display: block; height: auto; border: 0; width: 27px; max-width: 100%;" width="27" alt="Image" title="Image"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:20px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Invoice NO:</span> <strong>2-9838CX</strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:15px;">
                                                                                            <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/calendar.png" style="display: block; height: auto; border: 0; width: 27px; max-width: 100%;" width="27" alt="Image" title="Image"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:20px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Invoice Date:</span> <strong>Jun 18, 2018</strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-3" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:15px;">
                                                                                            <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/dollar.png" style="display: block; height: auto; border: 0; width: 14px; max-width: 100%;" width="14" alt="Image" title="Image"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Total:</span>&nbsp;<strong>$ 263,00</strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:5px;padding-left:40px;padding-right:40px;padding-top:15px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-family: Oswald, Lucida Sans Unicode, Lucida Grande, sans-serif; font-size: 12px; mso-line-height-alt: 18px; color: #56B500; line-height: 1.5;">
                                                                                                    <p style="margin: 0; text-align: center; font-size: 12px; mso-line-height-alt: 36px;"><span style="font-size:24px;"><b>Invoice recap</b></span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-5" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #56b500; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px solid #519E0A; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:13px;"><strong>Description</strong></span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px solid #519E0A; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:13px;"><strong>Quantity</strong></span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-3" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:13px;"><strong>Total</strong></span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-6" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Lorem ipsum dolor</span></p>
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">sit amet desicititnum.</span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:20px;padding-left:15px;padding-right:15px;padding-top:20px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><b>1</b></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-3" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>&nbsp;$ 12,00</strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-7" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #F5F5F5; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad">
                                                                                            <div class="alignment" align="center">
                                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                    <tr>
                                                                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-8" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Lorem ipsum dolor</span></p>
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">sit amet desicititnum.</span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:20px;padding-left:15px;padding-right:15px;padding-top:20px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><b>1</b></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-3" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>&nbsp;$ 75,00</strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-9" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad">
                                                                                            <div class="alignment" align="left">
                                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                    <tr>
                                                                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-10" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Lorem ipsum dolor</span></p>
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">sit amet desicititnum.</span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:20px;padding-left:15px;padding-right:15px;padding-top:20px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><b>1</b></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-3" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>&nbsp;$ 88,00</strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-11" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #F5F5F5; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad">
                                                                                            <div class="alignment" align="center">
                                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                    <tr>
                                                                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-12" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Lorem ipsum dolor</span></p>
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">sit amet desicititnum.</span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:20px;padding-left:15px;padding-right:15px;padding-top:20px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><b>1</b></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-3" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>&nbsp;$ 88,00</strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-13" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad">
                                                                                            <div class="alignment" align="left">
                                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                    <tr>
                                                                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-14" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 0px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="empty_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-right:0px;padding-bottom:0px;padding-left:0px;padding-top:15px;">
                                                                                            <div></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 0px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-left:25px;padding-top:5px;padding-bottom:25px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #56B500; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; mso-line-height-alt: 14.399999999999999px;">&nbsp;</p>
                                                                                                    <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><span style="font-size:20px;">Total Pendiente por pagar:</span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-3" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #56B500; border-bottom: 0px solid #DFDFDF; border-left: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-right: 0px;">
                                                                                <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:30px;padding-left:10px;padding-right:10px;padding-top:30px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:18px;"><strong>$ 263,00</strong></span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-15" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 20px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:5px;padding-left:40px;padding-right:40px;padding-top:15px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; font-family: Oswald, Lucida Sans Unicode, Lucida Grande, sans-serif; mso-line-height-alt: 18px; color: #56B500; line-height: 1.5;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 36px;"><span style="font-size:24px;"><strong><span style="font-size:24px;">FAQ</span></strong></span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-bottom:15px;padding-left:40px;padding-right:40px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 18px; color: #555555; line-height: 1.5; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 18px;"><span style="font-size:12px;">Integer eget nibh vel massa gravida ullamcorper. Sed a viverra ante. Nullam posuere pellentesque lectus, nec vehicula felis rutrum ac. Maecenas porta facilisis turpis, eget imperdiet purus.</span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-16" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #333; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="66.66666666666667%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #EBEBEB; padding-left: 35px; padding-right: 25px; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-left:10px;padding-right:15px;padding-top:11px;padding-bottom:20px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><strong><a style="text-decoration: underline; color: #555555;" href="#" target="_blank" rel="noopener">Lorem ipsum dolor sit amet?</a></strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #EBEBEB; padding-right: 35px; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;">
                                                                                <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-right:10px;width:100%;padding-left:0px;padding-top:7px;padding-bottom:15px;">
                                                                                            <div class="alignment" align="right" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/next_1.png" style="display: block; height: auto; border: 0; width: 20px; max-width: 100%;" width="20" alt="Image" title="Image"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-17" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-left: 20px; padding-right: 20px; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad">
                                                                                            <div class="alignment" align="left">
                                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                    <tr>
                                                                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-18" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #333; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="66.66666666666667%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #EBEBEB; padding-left: 35px; padding-right: 25px; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-left:10px;padding-right:15px;padding-top:11px;padding-bottom:20px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><strong><a style="text-decoration: underline; color: #555555;" href="#" target="_blank" rel="noopener">Lorem ipsum dolor sit amet ullacomper?</a></strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #EBEBEB; padding-right: 35px; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;">
                                                                                <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-right:10px;width:100%;padding-left:0px;padding-top:7px;padding-bottom:15px;">
                                                                                            <div class="alignment" align="right" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/next_1.png" style="display: block; height: auto; border: 0; width: 20px; max-width: 100%;" width="20" alt="Image" title="Image"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-19" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-left: 20px; padding-right: 20px; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad">
                                                                                            <div class="alignment" align="left">
                                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                    <tr>
                                                                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-20" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #333; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="66.66666666666667%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #EBEBEB; padding-left: 35px; padding-right: 25px; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;">
                                                                                <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-left:10px;padding-right:15px;padding-top:11px;padding-bottom:20px;">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><strong><a style="text-decoration: underline; color: #555555;" href="#" target="_blank" rel="noopener">Lorem ipsum dolor et?</a></strong></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="column column-2" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #EBEBEB; padding-right: 35px; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;">
                                                                                <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="padding-right:10px;width:100%;padding-left:0px;padding-top:7px;padding-bottom:15px;">
                                                                                            <div class="alignment" align="right" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/next_1.png" style="display: block; height: auto; border: 0; width: 20px; max-width: 100%;" width="20" alt="Image" title="Image"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-21" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-left: 20px; padding-right: 20px; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad">
                                                                                            <div class="alignment" align="left">
                                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                    <tr>
                                                                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-22" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 10px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <div class="spacer_block" style="height:50px;line-height:50px;font-size:1px;">&#8202;</div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-23" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                                            <div class="alignment" align="center" style="line-height:10px"><img class="big" src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/bottom_rounded_15.png" style="display: block; height: auto; border: 0; width: 620px; max-width: 100%;" width="620" alt="Image" title="Image"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-24" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F0F0F0; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 15px; padding-bottom: 15px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                    <tr>
                                                                                        <td class="pad">
                                                                                            <div style="font-family: sans-serif">
                                                                                                <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                    <p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 14.399999999999999px;"><strong>Your Company © All rights reserved</strong></p>
                                                                                                    <p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 14.399999999999999px;">Lorem ipsum dolor sit amet</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row row-25" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                <table class="icons_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="pad" style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
                                                                                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td class="alignment" style="vertical-align: middle; text-align: center;">
                                                                                                        <!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
                                                                                                        <!--[if !vml]><!-->
                                                                                                        <table class="icons-inner" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;" cellpadding="0" cellspacing="0" role="presentation">
                                                                                                            <!--<![endif]-->
                                                                                                            <tr>
                                                                                                                <td style="vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;"><a href="https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link" target="_blank" style="text-decoration: none;"><img class="icon" alt="Designed with BEE" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/53601_510656/Signature/bee.png" height="32" width="34" align="center" style="display: block; height: auto; margin: 0 auto; border: 0;"></a></td>
                                                                                                                <td style="font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif; font-size: 15px; color: #9d9d9d; vertical-align: middle; letter-spacing: undefined; text-align: center;"><a href="https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link" target="_blank" style="color: #9d9d9d; text-decoration: none;">Designed with BEE</a></td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table><!-- End -->
                            </body>
                            
                            </html>';
                            ?>
                            <?php





                            $mail = new PHPMailer(true);

                            try {
                                //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host       = 'mail.astelecom.com.mx';                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'contabilidad@astelecom.com.mx';                     //SMTP username
                                $mail->Password   = 'hcZnW7NCo3*';                               //SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                //Recipients
                                $mail->setFrom('contabilidad@astelecom.com.mx', 'CONTABILIDAD ASTELECOM');
                                $mail->addAddress('antoniogonzalez.rt@gmail.com', 'Antonio G.');     //Add a recipient
                                $mail->addAddress('lmgger@hotmail.com');               //Name is optional
                                $mail->addReplyTo('l.gonzalez@ae.edu.mx', 'AVISOS AS');
                                /* $mail->addCC('cc@example.com');
                                $mail->addBCC('bcc@example.com'); */

                                //Attachments
                                /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments */
                                /* $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name */

                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = 'AVISO: COMPROBACIÓN DE GASTOS';
                                $mail->Body    = $html_cuerpo;
                                $mail->AltBody = 'Estimado colaborador. El departamento de contabilidad le hace llegar este correo de prueba.';

                                $mail->send();
                                echo 'Message has been sent';
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                            ?>
                            <!-- <form name="sentMessage" id="contactForm" novalidate>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="name" class="form-control" placeholder="Nombre" required="required">
                                            <p class="help-block text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" id="email" class="form-control" placeholder="Correo" required="required">
                                            <p class="help-block text-danger"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="Mensaje" required></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div id="success"></div>
                                <button type="submit" class="btn btn-default">Enviar Mensaje</button>
                            </form> -->
                        </div>
                        <!-- end card-body-->
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col-->
            </div>
            <!-- end row -->
            <?php
            include_once('php/views/viaticos/mails/mail_valid.php');

            ?>
            <!-- <script src="js/functions/viaticos/viaticos.js"></script> -->
            <script src="js/loading.js"></script>
            <script src="js/functions/send_mails/send_mail.js"></script>