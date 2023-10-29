<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0;">
        <meta name="format-detection" content="telephone=no"/>
        <style>
        body { margin: 0; padding: 0; min-width: 100%; width: 100% !important; height: 100% !important;}
        body, table, td, div, p, a { -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; }
        img { border: 0; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        #outlook a { padding: 0; }
        .ReadMsgBody { width: 100%; } .ExternalClass { width: 100%; }
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
        @media all and (min-width: 560px) {
        .container { border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; -khtml-border-radius: 8px; }
        }
        a, a:hover {
        color: #FFFFFF;
        }
        .footer a, .footer a:hover {
        color: #828999;
        }
        </style>
        <title>Live Learning Email Notifications</title>
    </head>
    <body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
        background-color: #2D3445;
        color: #FFFFFF;"
        bgcolor="#2D3445"
        text="#FFFFFF">
        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background"><tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
            bgcolor="#2D3445">
            <table border="0" cellpadding="0" cellspacing="0" align="center"
                width="500" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
                max-width: 500px;" class="wrapper">
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                        padding-top: 20px;
                        padding-bottom: 20px;">

                        <a target="_blank" style="text-decoration: none;"
                            href=""><img border="0" vspace="0" hspace="0"
                            src="{{asset( $settings['logo_image'] ?? '')}}"
                            width="150" height="50"
                            alt="Live Learning" style="
                            color: #FFFFFF;
                        font-size: 10px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;" /></a>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;  padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%;
                        padding-top: 5px;
                        color: #FFFFFF;
                        font-family: sans-serif;" class="header">
                        Live Learning Response At Open Ticket
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                        padding-top: 24px;" class="line"><hr
                        color="#565F73" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
                        padding-top: 15px;
                        color: #FFFFFF;
                        font-family: sans-serif; font-style: italic;" class="paragraph">
                        Dear Student,
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
                        padding-top: 10px;
                        color: #FFFFFF;
                        font-family: sans-serif; justify-content: center;" class="paragraph">
                        A new ticket response submitted by Administrator. you can check response here or go to dashboard in Support area for further details.
                        <div style="padding-bottom: 5px;">Ticket ID: <strong style="color: #bbb;font-size: 18px;">{{$data['ticket_id']}}</strong></div>
                        <div style="padding-bottom: 5px;">Status: <strong style="color: #bbb;font-size: 18px;">Open</strong></div>
                         {!! $data['message'] !!}
                    </td>
                </tr>




                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                        padding-top: 25px;
                        padding-bottom: 5px;" class="button">
                        <a href="{{ route('student.dashboard') }}" target="_blank" style="text-decoration: none;">
                            <table border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;">
                                <tr>
                                    <td align="center" valign="middle" style="padding: 12px 24px; margin: 0; text-decoration: none; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;"
                                        bgcolor="#E9703E">
                                        <a target="_blank" style="text-decoration: none;
                                            color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: bold; line-height: 120%;"
                                            href="{{ route('student.dashboard') }}">
                                            Go to Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 15px; font-weight: 400; line-height: 160%;
                        padding-top: 15px;
                        color: #FFFFFF;
                        font-family: sans-serif;" class="paragraph">
                        Thanks,<br/>
                        Live Learning Team
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                        padding-top: 30px;" class="line"><hr
                        color="#565F73" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;
                        padding-top: 10px;
                        padding-bottom: 20px;
                        color: #828999;
                        font-family: sans-serif;" class="footer">
                        This email was sent to&nbsp;you because we&nbsp;want to&nbsp;make the&nbsp;world a&nbsp;better place. You&nbsp;can <a href="" target="_blank" style="text-decoration: underline; color: #828999; font-family: sans-serif; font-size: 13px; font-weight: 400; line-height: 150%;">contact</a> with us at anytime if you want any assistance.<br/>
                        © Live Learning International Ltd. 2020
                    </td>
                </tr>
            </table>
        </td></tr></table>
    </body>
</html>
