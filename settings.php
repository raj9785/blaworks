<?php

Configure::write("Color.company", "#a78f85");
Configure::write("Color.indivitual", "#7d7a85");
Configure::write("FrontText.index_about_icam", "Lorem ipsum dolor sit Et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam.ptatem quia voluptas sit aspernatur aut odited...
Lorem ipsum dolor sit Et quasi architecto beatae vitae dicta sunt explicabo.
Lorem ipsum dolor sit Et quasi architecto beatae vitae dicta sunt explicabo.");
Configure::write("FrontText.index_our_fleet", "Lorem ipsum dolor sit Et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam.ptatem quia voluptas sit aspernatur aut odited... Lorem ipsum dolor sit Et quasi architecto beatae vitae dicta sunt explicabo. ");
Configure::write("FrontText.index_we_are1", "T (212) 555 55 00<br>
                                                    Email: demo@demo.com");
Configure::write("FrontText.index_we_are2", "Your Company LTD<br>
                                                    Street nr 100, 4536534, Chicago, US");
Configure::write("Payment.name", "paypal");
Configure::write("Requester.email_note", "Test data goes here ");
Configure::write("Requester.email_note_1", "Test data goes here ");
Configure::write("Site.BookingPrefix", "ICBCP");
Configure::write("Site.check", "1");
Configure::write("Site.companyorder", "Your 30 days trial period has been expired. Please pay first to access tracking and to view orders");
Configure::write("Site.contactaddress", "12341 Lorem ipsum , dolor sit amet");
Configure::write("Site.contactemail", "info@kargoexpress.com");
Configure::write("Site.contacteusmail", "contact@jobsite.com");
Configure::write("Site.contactphone", "123-4567-890");
Configure::write("Site.Copyright_text", "&copy;2016 Super Cabz Global Private Limited. All rights reserved ");
Configure::write("Site.days", "1");
Configure::write("Site.email", array('no-reply@jobsite.com' => 'Job Site'));
Configure::write("Site.emailbooking", array('bookings@supercabz.com' => 'Super Cabz'));
Configure::write("Site.facebook_url", "http://facebook.com");
Configure::write("Site.gift_a_ride", "10");
Configure::write("Site.google_url", "http://www.google.com");
Configure::write("Site.km", "300");
Configure::write("Site.linkedIn_url", "https://www.linkedin.com");
Configure::write("Site.map_refresh", "5");
Configure::write("Site.min_bal", "200");
Configure::write("Site.newsletter", "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.");
Configure::write("Site.package_allow", "1");
Configure::write("Site.package_deduction_type", "Present");
Configure::write("Site.Paypalemailid", "bharat.xtreem@gmail.com");
Configure::write("Site.Paypalmode", "test");
Configure::write("Site.pin_interest_url", "http://www.pininterest.com");
Configure::write("Site.ra", "Company");
Configure::write("Site.rss_url", "http://www.google.com");
Configure::write("Site.se", "");
Configure::write("Site.shipmentco2", "10kg");
Configure::write("Site.Taxi.dispatchsetting", "");
Configure::write("Site.timeformat", "24H");
Configure::write("Site.title", "SkillsHaat");
Configure::write("Site.twitter_url", "https://twitter.com/");
Configure::write("Site.viamichelinapikey", "RESTGP20140415082355509408953616");
Configure::write("Site.youtube_url", "http://www.youtube.com");
Configure::write("SiteText.localactservice", "Local Rental Active Service");
Configure::write("SiteText.outactservice", "Outstation Active Service");
Configure::write("SiteText.prempart", "Premium Partner Text");
Configure::write("SiteText.promote", "Premium Partner Text");
Configure::write("SMTP.smtphost", "");
Configure::write("Social.facebook", "www.facebook.com");
Configure::write("Social.google", "www.google.com");
Configure::write("Social.rss", "www.google.com");
Configure::write("Social.tweeter", "www.tweeter.com");
Configure::write("Supplier.email_note", "Test data goes here ");
Configure::write("Supplier.email_note_1", "Test data goes here ");
Configure::write("Advance.Fare", "25");
$path = $_SERVER['HTTP_HOST'];
Configure::write("Site.domain", $path);
if ($path == '192.168.1.253:81' || $path == 'localhost') {
    Configure::write("Site.Facebook.App.ID", "808196229278049");
    Configure::write("Site.Linkedin.appid", "75u0cfvgttbqa3");
    Configure::write("Site.Linkedin.secret", "eq4SOuDLRV0dOUGh");
} elseif ($path == 'developers.brsoftech.com') {
    Configure::write("Site.Facebook.App.ID", "354108458093016");
    Configure::write("Site.Linkedin.appid", "75lad56iiw74r0");
    Configure::write("Site.Linkedin.secret", "UNXUrJXWDbdIQL3s");
}elseif ($path == 'beta.supercabz.com') {
    Configure::write("Site.Facebook.App.ID", "678773045638714");
    Configure::write("Site.Linkedin.appid", "75lad56iiw74r0");
    Configure::write("Site.Linkedin.secret", "UNXUrJXWDbdIQL3s");
} else {
    Configure::write("Site.Facebook.App.ID", "1485384831778604");
    Configure::write("Site.Linkedin.appid", "75ofc285wvvoza");
    Configure::write("Site.Linkedin.secret", "JDGO98gCpyTsK0UN");
}
