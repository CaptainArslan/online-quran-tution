@extends('layouts.app')
@section('title', $settings['how_it_works_meta_title'] ?? '')
@section('meta')

<meta name="description" content="{{ $settings['how_it_works_meta_description'] ?? '' }}">
<meta name="keywords" content="{{ $settings['how_it_works_meta_keywords'] ?? '' }}">
@endsection
@section('css')
<style>
    .privacy-card p
    {
        text-align:justify;
    }
</style>
@endsection
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section class="container-banner-lg p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 banner-left-heading m-auto">
                    <div class="banner-left-area">
                        <h1 class="text-dark custom-font-3"><span>Privacy</span> Policy</h1>
                        <p class="text-justify text-dark">By using our site you accept these privacy policy.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 asideimg" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset($settings['header_banner_image']) }});"></div>
                {{-- <div class="col-lg-6 col-md-6 col-sm-12 asideimg" style="background-image: url({{ asset($settings['header_banner_image']) }});">

                </div> --}}
            </div>
        </div>
    </section>
    <section class="container-banner-md p-0" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset($settings['header_banner_image']) }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 banner-left-heading m-auto">
                    <div class="banner-left-area">
                        <h1 class="text-white custom-font-3"><span>Privacy</span> Policy</h1>
                        <p class="text-justify text-white">By using our site you accept these privacy policy.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12"></div>
                {{-- <div class="col-lg-6 col-md-6 col-sm-12 asideimg" style="background-image: url({{ asset($settings['header_banner_image']) }});">

                </div> --}}
            </div>
        </div>
    </section>


    <section class="p-0" id="free-members">
        <div class="container">
            <div class="card mt-4 mb-4 schools-card">
                <div class="card-header p-0 text-center schoools-card-heading">
                    <h2 class="pt-1 m-0">Privacy Policy</h2>
                </div>
                <div class="card-body privacy-card">
                    <h3 id="top">1. Introduction</h3>
                    <p>
                        <span class="font-weight-bold">1.1</span> We are committed to safeguarding the privacy of [our website visitors, service users, individual customers and customer personnel].
                    </p>
                    <p>
                        <span class="font-weight-bold">1.2</span> This policy applies where we are acting as a data controller with respect to the personal data of such persons; in other words, where we determine the purposes and means of the processing of that personal data.
                    </p>
                    <p>
                        <span class="font-weight-bold">1.3</span> Our website incorporates privacy controls which affect how we will process your personal data. By using the privacy controls, you can [specify whether you would like to receive direct marketing communications and limit the collection, sharing and publication of your personal data]. You can access the privacy controls via [URL].
                    </p>
                    <p>
                        <span class="font-weight-bold">1.4</span> We use cookies on our website. Insofar as those cookies are not strictly necessary for the provision of [our website and services], we will ask you to consent to our use of cookies when you first visit our website.
                    </p>
                    <p>
                        <span class="font-weight-bold">1.5</span> In this policy, "we", "us" and "our" refer to [data controller name].[ For more information about us, see Section 14.]
                    </p>
                    
                    <h3>2. Credit</h3>
                    <p>
                        <span class="font-weight-bold">2.1</span> This document was created using a template from Docular (https://seqlegal.com/free-legal-documents/privacy-policy). You must retain the above credit. Use of this document without the credit is an infringement of copyright. However, you can purchase from us an equivalent document that does not include the credit.
                    </p>
                    
                    <h3>3. The personal data that we collect</h3>
                    <p>
                        <span class="font-weight-bold">3.1</span> In this Section 3 we have set out the general categories of personal data that we process[ and, in the case of personal data that we did not obtain directly from you, information about the source and specific categories of that data].
                    </p>
                    <p>
                        <span class="font-weight-bold">3.2</span> We may process data enabling us to get in touch with you ("contact data").[ The contact data may include [your name, email address, telephone number, postal address and/or social media account identifiers].][ The source of the contact data is [you and/or your employer].][ If you log into our website using a social media account, we will obtain elements of the contact data from the relevant social media account provider.]
                    </p>
                    <p>
                        <span class="font-weight-bold">3.3</span> We may process [your website user account data] ("account data").[ The account data may [include your account identifier, name, email address, business name, account creation and modification dates, website settings and marketing preferences].][ The primary source of the account data is [you and/or your employer, although some elements of the account data may be generated by our website].][ If you log into our website using a social media account, we will obtain elements of the account data from the relevant social media account provider.]
                    </p>
                    <p>
                        <span class="font-weight-bold">3.4</span> We may process [information relating to transactions, including purchases of goods and/or services, that you enter into with us and/or through our website] ("transaction data").[ The transaction data may include [your name, your contact details, your payment card details (or other payment details) and the transaction details].][ The source of the transaction data is [you and/or our payment services provider].]
                    </p>
                    <p>
                        <span class="font-weight-bold">3.5</span> We may process [information contained in or relating to any communication that you send to us or that we send to you] ("communication data"). The communication data may include [the communication content and metadata associated with the communication].[ Our website will generate the metadata associated with communications made using the website contact forms.]
                    </p>
                    <p>
                        <span class="font-weight-bold">3.6</span> We may process [data about your use of our website and services] ("usage data"). The usage data may include [your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views and website navigation paths, as well as information about the timing, frequency and pattern of your service use]. The source of the usage data is [our analytics tracking system].
                    </p>
                    <p>
                        <span class="font-weight-bold">3.7</span> We may process [identify general category of data].[ This data may include [list specific items of data].][ The source of this data is [identify source].]
                    </p>
                    
                    <h3>4. Purposes of processing and legal bases</h3>
                    <p>
                        <span class="font-weight-bold">4.1</span> In this Section 4, we have set out the purposes for which we may process personal data and the legal bases of the processing.
                    </p>
                    <p>
                        <span class="font-weight-bold">4.2</span> Operations - We may process [your personal data] for [the purposes of operating our website, the processing and fulfilment of orders, providing our services, supplying our goods, generating invoices, bills and other payment-related documentation, and credit control]. The legal basis for this processing is [our legitimate interests, namely [the proper administration of our website, services and business]] OR [the performance of a contract between you and us and/or taking steps, at your request, to enter into such a contract] OR [[specify basis]].
                    </p>
                    <p>
                        <span class="font-weight-bold">4.3</span> Publications - We may process [account data] for [the purposes of publishing such data on our website and elsewhere through our services in accordance with your express instructions]. The legal basis for this processing is [consent] OR [our legitimate interests, namely [the publication of content in the ordinary course of our operations]] OR [the performance of a contract between you and us and/or taking steps, at your request, to enter into such a contract] OR [[specify basis]].
                    </p>
                    <p>
                        <span class="font-weight-bold">4.4</span> Relationships and communications - We may process [contact data, account data, transaction data and/or communication data] for [the purposes of managing our relationships, communicating with you (excluding communicating for the purposes of direct marketing) by email, SMS, post, fax and/or telephone, providing support services and complaint handling]. The legal basis for this processing is [our legitimate interests, namely [communications with our website visitors, service users, individual customers and customer personnel, the maintenance of relationships, and the proper administration of our website, services and business]] OR [[specify basis]].
                    </p>
                    <p>
                        <span class="font-weight-bold">4.5</span> Direct marketing - We may process [contact data, account data and/or transaction data] for [the purposes of creating, targeting and sending direct marketing communications by email, SMS, post and/or fax and making contact by telephone for marketing-related purposes]. The legal basis for this processing is [consent] OR [our legitimate interests, namely [promoting our business and communicating marketing messages and offers to our website visitors and service users]] OR [[specify basis]].
                    </p>
                    <p>
                        <span class="font-weight-bold">4.6</span> Research and analysis - We may process [usage data and/or transaction data] for [the purposes of researching and analysing the use of our website and services, as well as researching and analysing other interactions with our business]. The legal basis for this processing is [consent] OR [our legitimate interests, namely [monitoring, supporting, improving and securing our website, services and business generally]] OR [[specify basis]].
                    </p>
                    <p>
                        <span class="font-weight-bold">4.7</span> Record keeping - We may process [your personal data] for [the purposes of creating and maintaining our databases, back-up copies of our databases and our business records generally]. The legal basis for this processing is our legitimate interests, namely [ensuring that we have access to all the information we need to properly and efficiently run our business in accordance with this policy].
                    </p>
                    <p>
                        <span class="font-weight-bold">4.8</span> Security - We may process [your personal data] for [the purposes of security and the prevention of fraud and other criminal activity]. The legal basis of this processing is our legitimate interests, namely [the protection of our website, services and business, and the protection of others].
                    </p>
                    <p>
                        <span class="font-weight-bold">4.9</span> Insurance and risk management - We may process [your personal data] where necessary for [the purposes of obtaining or maintaining insurance coverage, managing risks and/or obtaining professional advice]. The legal basis for this processing is our legitimate interests, namely [the proper protection of our business against risks].
                    </p>
                    <p>
                        <span class="font-weight-bold">4.10</span> Legal claims - We may process [your personal data] where necessary for [the establishment, exercise or defence of legal claims, whether in court proceedings or in an administrative or out-of-court procedure]. The legal basis for this processing is our legitimate interests, namely [the protection and assertion of our legal rights, your legal rights and the legal rights of others].
                    </p>
                    <p>
                        <span class="font-weight-bold">4.11</span> Legal compliance and vital interests - We may also process your personal data where such processing is necessary for compliance with a legal obligation to which we are subject or in order to protect your vital interests or the vital interests of another natural person.
                    </p>
                    
                    <h3>5. Providing your personal data to others</h3>
                    <p>
                        <span class="font-weight-bold">5.1</span> We may disclose [your personal data] to [our insurers and/or professional advisers] insofar as reasonably necessary for the purposes of [obtaining or maintaining insurance coverage, managing risks, obtaining professional advice].
                    </p>
                    <p>
                        <span class="font-weight-bold">5.2</span> [Your personal data held in our website database] OR [[Identify personal data category or categories]] will be stored on the servers of our hosting services providers[ identified at [URL]].
                    </p>
                    <p>
                        <span class="font-weight-bold">5.3</span> We may disclose [specify personal data category or categories] to [our suppliers or subcontractors][ identified at [URL]] insofar as reasonably necessary for [specify purposes].
                    </p>
                    <p>
                        <span class="font-weight-bold">5.4</span> Financial transactions relating to [our website and services] [are] OR [may be] handled by our payment services providers, [identify PSPs]. We will share transaction data with our payment services providers only to the extent necessary for the purposes of [processing your payments, refunding such payments and dealing with complaints and queries relating to such payments and refunds]. You can find information about the payment services providers' privacy policies and practices at [URLs].
                    </p>
                    <p>
                        <span class="font-weight-bold">5.5</span> In addition to the specific disclosures of personal data set out in this Section 5, we may disclose your personal data where such disclosure is necessary for compliance with a legal obligation to which we are subject, or in order to protect your vital interests or the vital interests of another natural person. We may also disclose your personal data where such disclosure is necessary for the establishment, exercise, or defence of legal claims, whether in court proceedings or in an administrative or out-of-court procedure.
                    </p>
                    
                    <h3>6. International transfers of your personal data</h3>
                    <p>
                        <span class="font-weight-bold">6.1</span> In this Section 6, we provide information about the circumstances in which your personal data may be transferred to [countries outside the United Kingdom and the European Economic Area (EEA)].
                    </p>
                    <p>
                        <span class="font-weight-bold">6.2</span> The hosting facilities for our website are situated in [specify countries].[ The competent data protection authorities have made an "adequacy decision" with respect to [the data protection laws of each of these countries].][ Transfers to [each of these countries] will be protected by appropriate safeguards, namely [the use of standard data protection clauses adopted or approved by the competent data protection authorities, a copy of which you can obtain from [source]] OR [[specify appropriate safeguards and means to obtain a copy]].]
                    </p>
                    <p>
                        <span class="font-weight-bold">6.3</span> [Specify category or categories of supplier or subcontractor] [is] OR [are] situated in [specify countries].[ The competent data protection authorities have made an "adequacy decision" with respect to [the data protection laws of each of these countries].][ Transfers to [each of these countries] will be protected by appropriate safeguards, namely [the use of standard data protection clauses adopted or approved by the competent data protection authorities, a copy of which can be obtained from [source]] OR [[specify appropriate safeguards and means to obtain a copy]].]
                    </p>
                    <p>
                        <span class="font-weight-bold">6.4</span> You acknowledge that [personal data that you submit for publication through our website or services] may be available, via the internet, around the world. We cannot prevent the use (or misuse) of such personal data by others.
                    </p>
                    
                    <h3>7. Retaining and deleting personal data</h3>
                    <p>
                        <span class="font-weight-bold">7.1</span> This Section 7 sets out our data retention policies and procedures, which are designed to help ensure that we comply with our legal obligations in relation to the retention and deletion of personal data.
                    </p>
                    <p>
                        <span class="font-weight-bold">7.2</span> Personal data that we process for any purpose or purposes shall not be kept for longer than is necessary for that purpose or those purposes. 7.3 We will retain your personal data as follows:
                        
                        <ul class="pl-3">
                            <li>
                                [contact data will be retained for a minimum period of [period] following the date of the most recent contact between you and us, and for a maximum period of [period] following that date];
                            </li>
                            <li>
                                [account data will be retained for a minimum period of [period] following the date of closure of the relevant account, and for a maximum period of [period] following that date];
                            </li>
                            <li>
                                [transaction data will be retained for a minimum period of [period] following the date of the transaction, and for a maximum period of [period] following that date];
                            </li>
                            <li>
                                [communication data will be retained for a minimum period of [period] following the date of the communication in question, and for a maximum period of [period] following that date];
                            </li>
                            <li>
                                [usage data will be retained for [period] following the date of collection]; and
                            </li>
                            <li>
                                [[data category] will be retained for a minimum period of [period] following [date], and for a maximum period of [period] following [date]]. [additional list items]
                            </li>
                        </ul>
                    </p>
                    <p>
                        <span class="font-weight-bold">7.3</span> Notwithstanding the other provisions of this Section 7, we may retain your personal data where such retention is necessary for compliance with a legal obligation to which we are subject, or in order to protect your vital interests or the vital interests of another natural person.
                    </p>
                    
                    <h3>8. Your rights</h3>
                    <p>
                        <span class="font-weight-bold">8.1</span> In this Section 8, we have listed the rights that you have under data protection law.
                    </p>
                    <p>
                        <span class="font-weight-bold">8.2</span> Your principal rights under data protection law are:
                        
                        <ul class="pl-3">
                            <li>
                                the right to access - you can ask for copies of your personal data;
                            </li>
                            <li>
                                the right to rectification - you can ask us to rectify inaccurate personal data and to complete incomplete personal data;
                            </li>
                            <li>
                                the right to erasure - you can ask us to erase your personal data;
                            </li>
                            <li>
                                the right to restrict processing - you can ask us to restrict the processing of your personal data;
                            </li>
                            <li>
                                the right to object to processing - you can object to the processing of your personal data;
                            </li>
                            <li>
                                the right to data portability - you can ask that we transfer your personal data to another organisation or to you;
                            </li>
                            <li>
                                the right to complain to a supervisory authority - you can complain about our processing of your personal data; and
                            </li>
                            <li>
                                the right to withdraw consent - to the extent that the legal basis of our processing of your personal data is consent, you can withdraw that consent.
                            </li>
                        </ul>
                    </p>
                    <p>
                        <span class="font-weight-bold">8.3</span> These rights are subject to certain limitations and exceptions. You can learn more about the rights of data subjects by visiting https://ico.org.uk/for-organisations/guide-to-data-protection/guide-to-the-general-data-protection-regulation-gdpr/individual-rights/. 
                    </p>
                    <p>
                        <span class="font-weight-bold">8.4</span> You may exercise any of your rights in relation to your personal data [by written notice to us, using the contact details set out below]. 
                    </p>
                    
                    
                    <h3>9. About cookies</h3>
                    <p>
                        <span class="font-weight-bold">9.1</span> A cookie is a file containing an identifier (a string of letters and numbers) that is sent by a web server to a web browser and is stored by the browser. The identifier is then sent back to the server each time the browser requests a page from the server.
                    </p>
                    <p>
                        <span class="font-weight-bold">9.2</span> Cookies may be either "persistent" cookies or "session" cookies: a persistent cookie will be stored by a web browser and will remain valid until its set expiry date, unless deleted by the user before the expiry date; a session cookie, on the other hand, will expire at the end of the user session, when the web browser is closed.
                    </p>
                    <p>
                        <span class="font-weight-bold">9.3</span> Cookies may not contain any information that personally identifies a user, but personal data that we store about you may be linked to the information stored in and obtained from cookies.
                    </p>
                    
                    
                    <h3>10. Cookies that we use</h3>
                    <p>
                        <span class="font-weight-bold">10.1</span> We use cookies for the following purposes:
                        <ul class="pl-3">
                            <li>
                                [authentication and status - we use cookies [to identify you when you visit our website and as you navigate our website, and to help us determine if you are logged into our website][ (cookies used for this purpose are: [identify cookies])]];
                            </li>
                            <li>
                                [shopping cart - we use cookies to [maintain the state of your shopping cart as you navigate our website][ (cookies used for this purpose are: [identify cookies])]];
                            </li>
                            <li>
                                [personalisation - we use cookies [to store information about your preferences and to personalise our website for you][ (cookies used for this purpose are: [identify cookies])]];
                            </li>
                            <li>
                                [security - we use cookies [as an element of the security measures used to protect user accounts, including preventing fraudulent use of login credentials, and to protect our website and services generally][ (cookies used for this purpose are: [identify cookies])]];
                            </li>
                            <li>
                                [advertising - we use cookies [to help us to display advertisements that will be relevant to you][ (cookies used for this purpose are: [identify cookies])]];
                            </li>
                            <li>
                                [analysis - we use cookies [to help us to analyse the use and performance of our website and services][ (cookies used for this purpose are: [identify cookies])]]; and
                            </li>
                            <li>
                                [cookie consent - we use cookies [to store your preferences in relation to the use of cookies more generally][ (cookies used for this purpose are: [identify cookies])]]. [additional list items]
                            </li>
                        </ul>
                    </p>
                    
                    
                    <h3>11. Cookies used by our service providers</h3>
                    <p>
                        <span class="font-weight-bold">11.1</span> Our service providers use cookies and those cookies may be stored on your computer when you visit our website.
                    </p>
                    <p>
                        <span class="font-weight-bold">11.2</span> We use Google Analytics. Google Analytics gathers information about the use of our website by means of cookies. The information gathered is used to create reports about the use of our website. You can find out more about Google's use of information by visiting https://www.google.com/policies/privacy/partners/ and you can review Google's privacy policy at https://policies.google.com/privacy.[ The relevant cookies are: [identify cookies].]
                    </p>
                    <p>
                        <span class="font-weight-bold">11.3</span> We use [identify service provider] to [specify service]. This service uses cookies for [specify purpose(s)]. You can view the privacy policy of this service provider at [URL].[ The relevant cookies are: [identify cookies].]
                    </p>
                    
                    <h3>12. Managing cookies</h3>
                    <p>
                        <span class="font-weight-bold">12.1</span> Most browsers allow you to refuse to accept cookies and to delete cookies. The methods for doing so vary from browser to browser, and from version to version. You can however obtain up-to-date information about blocking and deleting cookies via these links:
                        <ul class="pl-3">
                            <li>
                                https://support.google.com/chrome/answer/95647 (Chrome);
                            </li>
                            <li>
                                https://support.mozilla.org/en-US/kb/enable-and-disable-cookies-website-preferences (Firefox);
                            </li>
                            <li>
                                https://help.opera.com/en/latest/security-and-privacy/ (Opera);
                            </li>
                            <li>
                                https://support.microsoft.com/en-gb/help/17442/windows-internet-explorer-delete-manage-cookies (Internet Explorer);
                            </li>
                            <li>
                                https://support.apple.com/en-gb/guide/safari/manage-cookies-and-website-data-sfri11471/mac (Safari); and
                            </li>
                            <li>
                                https://privacy.microsoft.com/en-us/windows-10-microsoft-edge-and-privacy (Edge).
                            </li>
                        </ul>
                    </p>
                    <p>
                        <span class="font-weight-bold">12.2</span> Blocking all cookies will have a negative impact upon the usability of many websites.
                    </p>
                    <p>
                        <span class="font-weight-bold">12.3</span> If you block cookies, you will not be able to use all the features on our website.
                    </p>
                    
                    
                    <h3>13. Amendments</h3>
                    <p>
                        <span class="font-weight-bold">13.1</span> We may update this policy from time to time by publishing a new version on our website.
                    </p>
                    <p>
                        <span class="font-weight-bold">13.2</span> You should check this page occasionally to ensure you are happy with any changes to this policy.
                    </p>
                    <p>
                        <span class="font-weight-bold">13.3</span> We [may] OR [will] notify you of [changes] OR [significant changes] to this policy [by email].
                    </p>
                    
                    
                    <h3>14. Amendments</h3>
                    <p>
                        <span class="font-weight-bold">14.1</span> This website is owned and operated by [name].
                    </p>
                    <p>
                        <span class="font-weight-bold">14.2</span> We are registered in [England and Wales] under registration number [number], and our registered office is at [address].
                    </p>
                    <p>
                        <span class="font-weight-bold">14.3</span> Our principal place of business is at [address].
                    </p>
                    <p>
                        <span class="font-weight-bold">14.4</span> You can contact us:
                        <ul class="pl-3">
                            <li>
                                [by post, to [the postal address given above]];
                            </li>
                            <li>
                                [using our website contact form];
                            </li>
                            <li>
                                [by telephone, on [the contact number published on our website]]; or
                            </li>
                            <li>
                                [by email, using [the email address published on our website]].

                            </li>
                        </ul>
                    </p>
                    
                    
                    <h3>15. Data protection officer</h3>
                    <p>
                        <span class="font-weight-bold">15.1</span> Our data protection officer's contact details are: [contact details].
                    </p>
                    
                    
                    <p>
                        <a href="#top">Back to top</a>
                    </p>
                </div>
            </div>
        </div>
    </section>


</div>
<!-- content close -->

@stop
@section("js")
<script>
    $(document).on('click','a', function(event) {
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
            window.location.hash = hash;
          });
        }
    });
</script>
@endsection
