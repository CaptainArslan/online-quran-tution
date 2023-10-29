<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Country;
use App\Models\Faq;
use App\Models\HomeVideo;
use App\Models\Inquiry;
use App\Models\InquirySchedule;
use App\Models\Plan;
use App\Models\Review;
use App\Models\Subscription;
use App\Models\Testimonial;
use App\Traits\PayPalPlansApi;
use App\Traits\SaveTutor;
use App\Models\TutorReviews;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use function GuzzleHttp\Promise\settle;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  use SaveTutor;
  use VerifiesEmails;
  use PayPalPlansApi;

  public function index()
  {
    $total_tutors = User::where('role', 'tutor')->count();
    $total_students = User::where('role', 'student')->count();
    $faqs = Faq::all();
    $avg = Testimonial::where('status', 1)->avg('rating');
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();
    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $videos = HomeVideo::all();
    $total_testimonials = Testimonial::all()->random(3);

    return view('index', get_defined_vars());
  }

  public function for_kids()
  {
    $title = 'Highly Qualified Quran Teachers | Quran Classes For Kids With Tajweed ';
    $schema = '<script type="application/ld+json">
                {
                  "@context" : "http://schema.org",
                  "@type" : "Product",
                  "name" : "Quran For Kids",
                  "description": "We have several highly qualified Quran teachers to help your kids learn Quran online with Tajweed concepts and from basics to end reading it accurately and fluently.",
                  "provider" : {
                    "@type" : "Website",
                    "name" : "Online Quran Tuition",
                    "sameAs" : "https://www.onlinequrantuition.co.uk/quran-for-kids"
                   },
                 "review": {
                    "@type": "Review",
                    "reviewRating": {
                      "@type": "Rating",
                      "ratingValue": "4",
                      "bestRating": "5"
                    "author": {
                      "@type": "Person",
                      "name": "Adam Hussain"
                    }
                  },
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.9",
                    "reviewCount": "197"
                  }
                 }
                 
                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran For Kids",
                        "item": "https://onlinequrantuition.co.uk/quran-for-kids"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [{
                "@type": "Question",
                "name": "Can I rate or replace Quran tutor for kids?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Alhamdulillah, we are blessed with the best Quran teachers for online Quran classes for kids. We have chosen Quran tutors for children according to their Islamic qualification and experience to ensure providing excellent Quran teaching services during a session. But upon dissatisfaction we surely allow you to replace Quran tutor for kids to the one recommended by you or get a full refund"
                }
              },{
                "@type": "Question",
                "name": "Can I rate or replace Quran tutor for kids?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "As a parent, it is pretty easy to check your kid’s performance. We allow you to watch and listen to your kids’ online Quran classes and check their growth via monthly evaluations. This is one of the best options available to keep an eye on kids reading and Quran recitation practices."
                }
              },{
                "@type": "Question",
                "name": "What is the method of joining online Quran classes for kids?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "The process of joining online kids’ Quran classes is very simple and effortless. However, we recommend you to have a Laptop or smartphone to take a class online. Firstly, you have to create your account on the online software recommended by Quran tutors for kids near me. Once the account is created, the tutor will call you at a decided time, and upon receiving the call, the Quran lesson starts to proceed. The tutor will share his/her screen and open the digital Quran to start the lesson. At the start of the class, your Quran teacher will revise the previous lesson, listen to your recitation, and highlight the mistakes on the digital Quran to help you fix your mistakes and learn Quran recitation and reading accurately and fluently."
                }
              },{
                "@type": "Question",
                "name": "Is it possible to check out online Quran classes for kids as a free trial class?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes, we provide you with the opportunity of trial classes to check out our way of teaching the Quran and the validity of our online Quran classes for kids. We permit you to book a one-day free trial class, and upon satisfaction, you can register yourself for a regular session. Note: There is no fee for registration"
                }
              }]
            }
            </script>';
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Nottingham online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Nottingham don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Nottingham to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Nottingham because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Nottingham online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Nottingham. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Nottingham can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Nottingham Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $p2h = "Our Best Quran teachers";
    $p2 = "Every Muslim parent desires their kids to remembers Quran to get the reward from Allah in the world and hereafter. This course may take about three or more years; otherwise, the duration depends on the intellectuality of students. But our Quran teachers Leeds try their best to fill student's hearts with the light of the Quran. In addition to listening to daily Quran lessons, we also have arranged Quran worksheets in PDF form for better practice.";

    $description = 'We have several highly qualified Quran teachers to help your kids learn Quran online with Tajweed concepts and from basics to end reading it accurately and fluently.';
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $minititle = '';
    $headings1 = 'Are you searching for ';
    $headings2 = 'Online Quran classes for kids?';
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');
    $sectionBody = 'Stop beating the dead horse and get your kids registered with us. <br>
                        We have several highly qualified Quran teachers to help your kids learn Quran online with Tajweed concepts and from basics to end reading it accurately and fluently. In addition, we allow you to book a one-on-one Quran class for kids if they are hesitant to learn with others, followed by a flexible schedule and a competitive price plan. Furthermore, our online staff is well aware of online tools to deliver an interactive Quran lesson for kids during a session and consists of both male and female English-speaking Quran teachers for children. <br>
                        As a new visitor, we allow you to enroll your kid in Quran for kids’ one-day free trial class and check our services. <br>
                        So what are you waiting for? <br>
                        Book your trial class and start learning now ';

    $faqs = [
      [
        'question' => 'Can I rate or replace Quran tutor for kids?',
        'answer' => 'Alhamdulillah, we are blessed with the best Quran teachers for online Quran classes for kids. We have chosen Quran tutors for children according to their Islamic qualification and experience to ensure providing excellent Quran teaching services during a session. But upon dissatisfaction we surely allow you to replace Quran tutor for kids to the one recommended by you or get a full refund',
      ],
      [
        'question' => 'Can I rate or replace Quran tutor for kids?',
        'answer' => 'As a parent, it is pretty easy to check your kid’s performance. We allow you to watch and listen to your kids’ online Quran classes and check their growth via monthly evaluations. This is one of the best options available to keep an eye on kids reading and Quran recitation practices.',
      ],
      [
        'question' => 'What is the method of joining online Quran classes for kids?',
        'answer' => 'The process of joining online kids’ Quran classes is very simple and effortless. However, we recommend you to have a Laptop or smartphone to take a class online. 
                Firstly, you have to create your account on the online software recommended by Quran tutors for kids near me. Once the account is created, the tutor will call you at a decided time, and upon receiving the call, the Quran lesson starts to proceed. The tutor will share his/her screen and open the digital Quran to start the lesson. At the start of the class, your Quran teacher will revise the previous lesson, listen to your recitation, and highlight the mistakes on the digital Quran to help you fix your mistakes and learn Quran recitation and reading accurately and fluently.
                ',
      ],
      [
        'question' => 'Is it possible to check out online Quran classes for kids as a free trial class?',
        'answer' => 'Yes, we provide you with the opportunity of trial classes to check out our way of teaching the Quran and the validity of our online Quran classes for kids. We permit you to book a one-day free trial class, and upon satisfaction, you can register yourself for a regular session.
                    Note: There is no fee for registration
                    ',
      ],
    ];

    $meta = 'Online Quran classes for kids, Quran learning for kids, Quran recitation for kids, Quran teacher for children, Quran for kids, Kids reading Quran, Quran For Children, Quran 4 kids';
    $videos = HomeVideo::all();

    return view('subpages.forkids', get_defined_vars());
  }

  public function madrasauk()
  {
    $title = 'Highly Qualified Quran Teachers | Online Madrasa UK ';
    $schemafaq = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How can I register myself in online Madrassah classes?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "The registration method of Madrassah classes in the UK is quite simple and easy. To join a one-day free trial class, you need to fill out the booking form with complete and correct information, including full name, the contact number, email address, and message (optional), and submit it to us. After the submission, we will get back to you as soon as possible within 24 hours for registration confirmation and to answer your queries."
    }
  },{
    "@type": "Question",
    "name": "Why are online Madrassah classes better than local Madrassahs?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Several reasons make online Madrassah classes better than local Madrassahs. One of the notable benefits is that you do not have to go out to a local Madrassah which saves your time and allows you to learn Quran lessons with Tajweed concepts with the well-versed Madrassah teachers. In addition to this, you can record your Quran lessons and can play them later whenever you need to revise them. Moreover, besides male teachers, girls can avail the specific option of booking a Female Quran tutor near me option as well for their ease. And to reduce the Quran course fee burden from your shoulders, online Madrassah offers cheap Quran teachings and allows you to submit Quran lesson fees at a reasonable monthly price plan."
    }
  },{
    "@type": "Question",
    "name": "Can I get a tutor’s replacement if I am dissatisfied with his/her performance?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "For sure, you can, if you are not satisfied with the teaching method of your Quran teacher at online Madrassah, discuss the matter with us. We will pay heed to the reason provided by you for the Quran tutor’s replacement, and if it is a valid reason, we will process your request and surely change your Madrassah teacher online with the one recommended by you."
    }
  },{
    "@type": "Question",
    "name": "Can I quit a Madrassah class online after a trial?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, for sure, you are free to quit online Madrassah any time. You can quit it right after the trial class as well if you are not dissatisfied with the Madrassah teacher’s performance."
    }
  }]
}
</script>';
    $schema = '<script type="application/ld+json">
        
        {
          "@context": "http://schema.org",
          "@type" : "Product",
          "name" : "Online Madrasa UK",
          "description": " We are offering an online Madrassah teaching facility to you with our highly qualified Islamic teachers to enable you and your kids to learn and read Quran proficiently.",
          "provider" : {
            "@type" : "Website",
            "name" : "Online Quran Tuition",
            "sameAs" : "https://www.onlinequrantuition.co.uk/online-madrasa-uk"
           },
         "review": {
            "@type": "Review",
            "reviewRating": {
              "@type": "Rating",
              "ratingValue": "4",
              "bestRating": "5"
            },
            "author": {
              "@type": "Person",
              "name": "Adam Hussain"
            }
          },
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "197"
          }
         }
         
         }
        </script>
        <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Online Madrasa UK",
                        "item": "https://onlinequrantuition.co.uk/online-madrasa-uk"
                      }]
                    }
                 </script>';
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Nottingham online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Nottingham don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Nottingham to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Nottingham because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Nottingham online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Nottingham. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Nottingham can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Nottingham Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $p2h = "Our Best Quran teachers";
    $p2 = "Every Muslim parent desires their kids to remembers Quran to get the reward from Allah in the world and hereafter. This course may take about three or more years; otherwise, the duration depends on the intellectuality of students. But our Quran teachers Leeds try their best to fill student's hearts with the light of the Quran. In addition to listening to daily Quran lessons, we also have arranged Quran worksheets in PDF form for better practice.";
    $description = 'We have several highly qualified Quran teachers to help your kids learn Quran online with Tajweed concepts and from basics to end reading it accurately and fluently.';
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $minititle = 'Find a tutor to learn Quran online.';
    $headings1 = 'Do you want to learn Quran online ';
    $headings2 = 'from the best online Madrassah in the UK?';
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');
    $sectionBody = 'Well, the worrisome time is over. We are offering an online Madrassah teaching facility to you with our highly qualified Islamic teachers to enable you and your kids to learn and read Quran proficiently. In our online Madrassah classes, we have English-speaking Male and Female Quran teachers who are well aware of online tools to deliver an interactive Quran Lesson during a session.<br>
                    The most amazing part of online Quran Academy UK is that we provide one-on-one Quran classes to individuals to avoid hesitation, and instead of yearly, we allow you to pay a month-to-month online Madrassah fee.<br>
                    Furthermore, to satisfy you with our services, we allow you to take a 1-day free trial class to evaluate our teaching criteria and join our regular session upon satisfaction.<br>
                    So, hurry up and book now!
                    ';

    $faqs = [
      [
        'question' => 'How can I register myself in online Madrassah classes?',
        'answer' => 'The registration method of Madrassah classes in the UK is quite simple and easy. To join a one-day free trial class, you need to fill out the booking form with complete and correct information, including full name, the contact number, email address, and message (optional), and submit it to us. After the submission, we will get back to you as soon as possible within 24 hours for registration confirmation and to answer your queries.',
      ],
      [
        'question' => 'Why are online Madrassah classes better than local Madrassahs?',
        'answer' => 'Several reasons make online Madrassah classes better than local Madrassahs. One of the notable benefits is that you do not have to go out to a local Madrassah which saves your time and allows you to learn Quran lessons with Tajweed concepts with the well-versed Madrassah teachers.
                            In addition to this, you can record your Quran lessons and can play them later whenever you need to revise them. Moreover, besides male teachers, girls can avail the specific option of booking a Female Quran tutor near me option as well for their ease. And to reduce the Quran course fee burden from your shoulders, online Madrassah offers cheap Quran teachings and allows you to submit Quran lesson fees at a reasonable monthly price plan.
                            ',
      ],
      [
        'question' => 'Can I get a tutor’s replacement if I am dissatisfied with his/her performance?',
        'answer' => 'For sure, you can, if you are not satisfied with the teaching method of your Quran teacher at online Madrassah, discuss the matter with us. We will pay heed to the reason provided by you for the Quran tutor’s replacement, and if it is a valid reason, we will process your request and surely change your Madrassah teacher online with the one recommended by you.
                ',
      ],
      [
        'question' => 'Can I quit a Madrassah class online after a trial?',
        'answer' => 'Yes, for sure, you are free to quit online Madrassah any time. You can quit it right after the trial class as well if you are not dissatisfied with the Madrassah teacher’s performance.',
      ],
    ];

    $meta = 'We are offering an online Madrassah teaching facility to you with our highly qualified Islamic teachers to enable you and your kids to learn and read Quran proficiently.';
    $videos = HomeVideo::all();

    return view('subpages.forkids', get_defined_vars());
  }

  public function islamiclessons()
  {
    $title = 'Highly Qualified Quran Teachers | Islamic Lessons For Kids ';
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Nottingham online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Nottingham don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Nottingham to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Nottingham because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Nottingham online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Nottingham. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Nottingham can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Nottingham Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $p2h = "Our Best Quran teachers";
    $p2 = "Every Muslim parent desires their kids to remembers Quran to get the reward from Allah in the world and hereafter. This course may take about three or more years; otherwise, the duration depends on the intellectuality of students. But our Quran teachers Leeds try their best to fill student's hearts with the light of the Quran. In addition to listening to daily Quran lessons, we also have arranged Quran worksheets in PDF form for better practice.";
    $schemafaq = '<script type="application/ld+json">
          
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "What is the method of taking Islamic lessons for kids online?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Once you are registered with us, and set up the system to join our online short Islamic courses. Our Quran tutor will call you on a recommended app at a selected time according to the schedule. You have to receive the call instantly, and upon receiving the call live session will start, and he/she will share his/her screen to show a digital Islamic lesson book on the screen, which both tutor and student can see and start delivering the lecture."
    }
  },{
    "@type": "Question",
    "name": "How can I register myself for Islamic lesson classes?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "It is a very easy process to enroll in short Islamic courses. Firstly, you have to fill the registration form available online and submit it to us. After receiving the form, our online staff will get back to you as soon as possible within 24 hours through the contact number or email address provided by you for registration confirmation.<br> Alongside, our Islamic teachers will guide you about the installation and usage of recommended apps to join online Islamic lessons with ease."
    }
  },{
    "@type": "Question",
    "name": "Is there any fee for booking a free trial class at an Islamic school UK?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "No, there is no fee or other charges for booking a trial class. You can register yourself free of cost and evaluate our short Islamic courses. But once the trial is over and you want to join our regular session, you need to submit a small fee/hadiyah"
    }
  },{
    "@type": "Question",
    "name": "How can I take online Islamic lessons if I am not a computer expert?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "For joining our online Islamic lessons for kids, you don’t need to be a computer expert. Once you are registered with us, our online staff and tutors will guide you about the installation and usage of the recommended tool, and within few minutes, you will be able to join our short Islamic course session."
    }
  }]
}
</script>
<script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Islamic Lessons For Kids",
                        "item": "https://onlinequrantuition.co.uk/islamic-lessons-for-kids"
                      }]
                    }
                 </script>
';
    $schema = '<script type="application/ld+json">
                {
                  "@context" : "http://schema.org",
                  "@type" : "Product",
                  "name" : "Islamic Lessons For Kids ",
                  "description": "We have a group of highly qualified and English-speaking Quran tutors for kids who mainly focus on Short Islamic courses for children to help them gain basic knowledge of Islamic studies and Quran knowledge with interpretations at a competitive monthly price plan.",
                  "provider" : {
                    "@type" : "Website",
                    "name" : "Online Quran Tuition",
                    "sameAs" : "https://www.onlinequrantuition.co.uk/islamic-lessons-for-kids"
                   },
                 "review": {
                    "@type": "Review",
                    "reviewRating": {
                      "@type": "Rating",
                      "ratingValue": "4",
                      "bestRating": "5"
                    },
                    "author": {
                      "@type": "Person",
                      "name": "Adam Hussain"
                    }
                  },
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.9",
                    "reviewCount": "197"
                  }
                 }
                 
                 }
                </script>
                ';
    $description = 'We have a group of highly qualified and English-speaking Quran tutors for kids who mainly focus on Short Islamic courses for children to help them gain basic knowledge of Islamic studies and Quran knowledge with interpretations at a competitive monthly price plan';
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $minititle = 'Find a tutor to learn Quran online.';
    $headings1 = 'Are you the one searching';
    $headings2 = 'for an online Islamic School UK?';
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');
    $sectionBody = 'Well, don’t worry. We are here to cater your needs related to Islamic lessons for kids.
                    We have a group of highly qualified and English-speaking Quran tutors for kids who are mainly focusing on Short Islamic courses for children to help them gain basic knowledge of Islamic studies and Quran knowledge with interpretations at a competitive monthly price plan. Furthermore, we allow you to book a one-on-one session to avoid hesitation and get all the needed attention during a session of Islamic lessons for kids online. To resolve a matter of every student, alongside males, we have female tutors available on our Islamic website for children as well so that female kids can learn Islamic lessons to the fullest.
                    Additionally, to evaluate Islamic lessons for kids, we offer you a one-day free trial class. So hurry up and book yours now!';
    $faqs = [
      [
        'question' => 'What is the method of taking Islamic lessons for kids online?',
        'answer' => 'Once you are registered with us, and set up the system to join our online short Islamic courses. Our Quran tutor will call you on a recommended app at a selected time according to the schedule. You have to receive the call instantly, and upon receiving the call live session will start, and he/she will share his/her screen to show a digital Islamic lesson book on the screen, which both tutor and student can see and start delivering the lecture.',
      ],
      [
        'question' => 'How can I register myself for Islamic lesson classes?',
        'answer' => 'It is a very easy process to enroll in short Islamic courses. Firstly, you have to fill the registration form available online and submit it to us. After receiving the form, our online staff will get back to you as soon as possible within 24 hours through the contact number or email address provided by you for registration confirmation.<br>
                            Alongside, our Islamic teachers will guide you about the installation and usage of recommended apps to join online Islamic lessons with ease.
                            ',
      ],
      [
        'question' => 'Is there any fee for booking a free trial class at an Islamic school UK?',
        'answer' => 'No, there is no fee or other charges for booking a trial class. You can register yourself free of cost and evaluate our short Islamic courses. But once the trial is over and you want to join our regular session, you need to submit a small fee/hadiyah
                ',
      ],
      [
        'question' => 'How can I take online Islamic lessons if I am not a computer expert?',
        'answer' => 'For joining our online Islamic lessons for kids, you don’t need to be a computer expert. Once you are registered with us, our online staff and tutors will guide you about the installation and usage of the recommended tool, and within few minutes, you will be able to join our short Islamic course session.',
      ],
    ];

    $meta = "Islamic lesson for kids online, Islamic lessons for Kids, Islamic websites for children's, Islamic studies for kids, Short Islamic courses, Online Islamic School UK";
    $videos = HomeVideo::all();

    return view('subpages.forkids', get_defined_vars());
  }

  public function skypeclasses()
  {
    $title = 'Highly Qualified Quran Teachers | Skype Quran Classes ';
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Nottingham online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Nottingham don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Nottingham to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Nottingham because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Nottingham online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Nottingham. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Nottingham can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Nottingham Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $p2h = "Our Best Quran teachers";
    $p2 = "Every Muslim parent desires their kids to remembers Quran to get the reward from Allah in the world and hereafter. This course may take about three or more years; otherwise, the duration depends on the intellectuality of students. But our Quran teachers Leeds try their best to fill student's hearts with the light of the Quran. In addition to listening to daily Quran lessons, we also have arranged Quran worksheets in PDF form for better practice.";
    $schemafaq = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How can I register myself for online Skype Quran Classes?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "To register yourself with us for Quran courses via Skype, including Tajweed, recitation, and memorization, you simply have to fill the booking form available at our site and submit it to us. Once the booking process is over, our online staff will contact you via email or the contact number provided by you for booking confirmation. After that, our Quran tutors will help you learn online software tools for joining Quran interactive sessions with ease. There is no registration fee. You only have to submit a small fee/hadiyah when you will join our regular session."
    }
  },{
    "@type": "Question",
    "name": "How many Quran services are available at learning Quran online via Skype?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "We offer your several online Quran Skype lessons, including o Quran recitation o Quran memorization o Tajweed-ul-Quran o Quran translation These are the online Quran lessons delivered via Skype to enable you to learn Quran despite your location. In addition to this, you can ask our English-speaking and highly qualified Quran tutors for other Islamic courses as well."
    }
  },{
    "@type": "Question",
    "name": "Is it mandatory to submit the fee for the whole course Skype Quran course at once?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "No, if it is hard for you to submit the whole course fee, then don’t worry. We got your back. You can submit the course fee at a reasonable monthly price plan. Our Skype Quran classes are very cheap, and every person can afford them easily. In addition, we do not bound you to submit a fee per course or on a monthly basis. You can do whatever is feasible for you."
    }
  },{
    "@type": "Question",
    "name": "Is there a female Quran tutor available for teaching Skype Quran lessons?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, Alhamdulillah, we are blessed with a large group of well-versed Quran tutors, including both male and female teachers. We understand that girls are hesitant to take online Skype Quran lessons from male Quran tutors; thus, we provide a female tutor, specifically available for teaching Islamic sisters and kids through Skype and discussing girl-related issues online."
    }
  }]
}
</script>
<script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Skype Quran Classes",
                        "item": "https://onlinequrantuition.co.uk/skype-quran-classes"
                      }]
                    }
                 </script>';
    $schema = '<script type="application/ld+json">
        {
          "@context" : "http://schema.org",
          "@type" : "Product",
          "name" : "Skype Quran Classes",
          "description": "We have highly qualified and English-speaking Quran tutors for delivering Online Quran teaching on Skype with a 100% satisfaction guarantee.",
          "provider" : {
            "@type" : "Website",
            "name" : "Online Quran Tuition",
            "sameAs" : "https://www.onlinequrantuition.co.uk/skype-quran-classes"
           },
         "review": {
            "@type": "Review",
            "reviewRating": {
              "@type": "Rating",
              "ratingValue": "4",
              "bestRating": "5"
            },
            "author": {
              "@type": "Person",
              "name": "Adam Hussain"
            }
          },
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "197"
          }
         }
         
         }
        </script>';
    $description = 'We have highly qualified and English-speaking Quran tutors for delivering Online Quran teaching on Skype with a 100% satisfaction guarantee';
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $minititle = 'Find a tutor to learn Quran online.';
    $headings1 = 'Want to learn';
    $headings2 = 'Quran Majeed online via skype?';
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');
    $sectionBody = 'If yes, then don’t worry. We got you covered in this regard and provide you the opportunity to take Skype Quran lessons with the best Quran tutors at a reasonable monthly price plan.<br>
 Our staff is diligently working to facilitate you and provide you with various short Islamic courses, Skype Quran lessons, and one-on-one sessions. We provide Quran services for all students without any age discrimination to help them learn Quran from basics to end it reading fluently and accurately. We have highly qualified and English-speaking Quran tutors for delivering Skype Quran teachings with a 100% satisfaction guarantee.<br>
 Furthermore, our online Skype Quran sessions allow you to decide the class timings according to your availability so that no hindrance occurs during your learn Quran online Skype session.<br>
So, get yourself registered for a free Skype trial class to evaluate our teaching methodology and join our regular session upon satisfaction.
';
    $faqs = [
      [
        'question' => 'How can I register myself for online Skype Quran Classes?',
        'answer' => 'To register yourself with us for Quran courses via Skype, including Tajweed, recitation, and memorization, you simply have to fill the booking form available at our site and submit it to us. Once the booking process is over, our online staff will contact you via email or the contact number provided by you for booking confirmation. After that, our Quran tutors will help you learn online software tools for joining Quran interactive sessions with ease.
There is no registration fee. You only have to submit a small fee/hadiyah when you will join our regular session.
',
      ],
      [
        'question' => 'How many Quran services are available at learning Quran online via Skype?',
        'answer' => 'We offer your several online Quran Skype lessons, including
                            o	Quran recitation
                            o	Quran memorization
                            o	Tajweed-ul-Quran
                            o	Quran translation
                        These are the online Quran lessons delivered via Skype to enable you to learn Quran despite your location. In addition to this, you can ask our English-speaking and highly qualified Quran tutors for other Islamic courses as well.
',
      ],
      [
        'question' => 'Is it mandatory to submit the fee for the whole course Skype Quran course at once?',
        'answer' => 'No, if it is hard for you to submit the whole course fee, then don’t worry. We got your back. You can submit the course fee at a reasonable monthly price plan. Our Skype Quran classes are very cheap, and every person can afford them easily. 
                        In addition, we do not bound you to submit a fee per course or on a monthly basis. You can do whatever is feasible for you.',
      ],
      [
        'question' => 'Is there a female Quran tutor available for teaching Skype Quran lessons?',
        'answer' => 'Yes, Alhamdulillah, we are blessed with a large group of well-versed Quran tutors, including both male and female teachers. We understand that girls are hesitant to take online Skype Quran lessons from male Quran tutors; thus, we provide a female tutor, specifically available for teaching Islamic sisters and kids through Skype and discussing girl-related issues online.',
      ],
    ];

    $meta = 'Learn Quran online Skype, Skype Quran classes, Skype Quran lessons, Online Quran teaching on Skype, Learn Quran online Skype,  Quran Majeed teaching online';
    $videos = HomeVideo::all();

    return view('subpages.forkids', get_defined_vars());
  }

  public function tajweedclasses()
  {
    $title = 'Highly Qualified Quran Teachers | Online Quran Classes With Tajweed';
    $schemafaq = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How can I register myself for online Tajweed ul Quran courses?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "To register yourself with us for Tajweed lessons is very easy and simple. Firstly, you have to fill the booking form available at our site by providing all the correct information and submit it to us. Once the booking process is completed, our online staff will contact you via email or the contact number provided by you on the booking form for registration confirmation. After that, our Tajweed-ul-Quran tutors will guide you about installing and using the recommended app for joining interactive Tajweed sessions with ease"
    }
  },{
    "@type": "Question",
    "name": "Are there any age limits for joining online Tajweed classes?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Fortunately, we have no exclusions related to age groups for taking online Tajweed lessons. Students of all age groups are free to join our online Tajweed courses. If you are hesitant to join a class of Quran with Tajweed session with others. In that case, we provide you the opportunity to book a one-on-one Quran Tajweed course in which a single tutor will teach a solo student to avoid hesitation and interruption."
    }
  },{
    "@type": "Question",
    "name": "Are parents get reported about the kid’s performance during a Quran with Tajweed class??",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, we know the concern of parents and provide you the opportunity to get reported about your kid’s performance during a Tajweed class by a Quran tutor. On a monthly basis, our Quran teachers will inform you about your kid’s performance so that you can analyze that where he/she is standing and ensure that he/she will work hard to raise the progress graph."
    }
  },{
    "@type": "Question",
    "name": "Is there a female Tajweed-ul-Quran tutor near me available for online Tajweed lessons?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, Alhamdulillah, we are blessed with a large group of well-versed Tajweed-ul-Quran tutors, including both Male and female teachers. We understand that girls are hesitant to join online Tajweed classes with male tutors; thus, we provide a female tutor near me option specifically available for our Islamic sisters and kids. They will help the girl students to learn Quran with Tajweed and resolve every matter faced by a student during an online Tajweed class."
    }
  }]
}
</script>
<script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Tajweed Classes",
                        "item": "https://onlinequrantuition.co.uk/tajweed-classes"
                      }]
                    }
                 </script>';
    $schema = '<script type="application/ld+json">
                        {
                          "@context" : "http://schema.org",
                          "@type" : "Product",
                          "name" : "Online Quran Classes With Tajweed",
                          "description": " All of our Tajweed-ul-Quran teachers can speak English fluently and are well aware of online tools to deliver an interactive online Tajweed course without interruptions during a session ",
                          "provider" : {
                            "@type" : "Website",
                            "name" : "Tajweed Classes",
                            "sameAs" : "https://www.onlinequrantuition.co.uk/tajweed-classes"
                           },
                         "review": {
                            "@type": "Review",
                            "reviewRating": {
                              "@type": "Rating",
                              "ratingValue": "4",
                              "bestRating": "5"
                            },
                            "author": {
                              "@type": "Person",
                              "name": "Adam Hussain"
                            }
                          },
                          "aggregateRating": {
                            "@type": "AggregateRating",
                            "ratingValue": "4.9",
                            "reviewCount": "197"
                          }
                         }
                         
                         }
                        </script>
                        ';
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Nottingham online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Nottingham don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Nottingham to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Nottingham because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Nottingham online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Nottingham. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Nottingham can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Nottingham Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $p2h = "Our Best Quran teachers";
    $p2 = "Every Muslim parent desires their kids to remembers Quran to get the reward from Allah in the world and hereafter. This course may take about three or more years; otherwise, the duration depends on the intellectuality of students. But our Quran teachers Leeds try their best to fill student's hearts with the light of the Quran. In addition to listening to daily Quran lessons, we also have arranged Quran worksheets in PDF form for better practice.";
    $description = 'All of our Tajweed-ul-Quran teachers can speak English fluently and are well aware of online tools to deliver an interactive online Tajweed course without interruptions during a session';
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();

    $minititle = 'Online Tajweed course';
    $headings1 = 'Are you looking for a ';
    $headings2 = 'Tajweed classes near me opportunity?';
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');
    $sectionBody = 'Stay connected with us because we are offering one-on-one Quran with Tajweed sessions with our highly trained and certified Quran tutors to let you learn Quran proficiently with Tajweed concepts. All of our Tajweed-ul-Quran teachers can speak English fluently and are well aware of online tools to deliver an interactive online Tajweed course without interruptions during a session. Besides male tutors, we provide you female tutor near me option to teach our Islamic sisters Quran with Tajweed. Furthermore, we allow you to decide your class timings according to your availability, so nothing that you can learn Quran on a hectic day with ease. To cater your satisfaction concerns, we are allowing 1-day free trial of Tajweed lessons, and once you are satisfied with our teaching method, you can join our regular session.<br>
            So, what are you waiting for? Book your Tajweed course now!';
    $faqs = [
      [
        'question' => 'How can I register myself for online Tajweed ul Quran courses?',
        'answer' => 'To register yourself with us for Tajweed lessons is very easy and simple. Firstly, you have to fill the booking form available at our site by providing all the correct information and submit it to us. Once the booking process is completed, our online staff will contact you via email or the contact number provided by you on the booking form for registration confirmation. After that, our Tajweed-ul-Quran tutors will guide you about installing and using the recommended app for joining interactive Tajweed sessions with ease',
      ],
      [
        'question' => 'Are there any age limits for joining online Tajweed classes?',
        'answer' => 'Fortunately, we have no exclusions related to age groups for taking online Tajweed lessons. Students of all age groups are free to join our online Tajweed courses. 
                            If you are hesitant to join a class of Quran with Tajweed session with others. In that case, we provide you the opportunity to book a one-on-one Quran Tajweed course in which a single tutor will teach a solo student to avoid hesitation and interruption.',
      ],
      [
        'question' => 'Are parents get reported about the kid’s performance during a Quran with Tajweed class??',
        'answer' => 'Yes, we know the concern of parents and provide you the opportunity to get reported about your kid’s performance during a Tajweed class by a Quran tutor. On a monthly basis, our Quran teachers will inform you about your kid’s performance so that you can analyze that where he/she is standing and ensure that he/she will work hard to raise the progress graph.',
      ],
      [
        'question' => 'Is there a female Tajweed-ul-Quran tutor near me available for online Tajweed lessons?',
        'answer' => 'Yes, Alhamdulillah, we are blessed with a large group of well-versed Tajweed-ul-Quran tutors, including both Male and female teachers. We understand that girls are hesitant to join online Tajweed classes with male tutors; thus, we provide a female tutor near me option specifically available for our Islamic sisters and kids. They will help the girl students to learn Quran with Tajweed and resolve every matter faced by a student during an online Tajweed class.',
      ],
    ];

    $meta = 'tajweed lessons, online tajweed course, tajweed course, online tajweed classes, tajweed classes near me, quran tajweed course, quran with tajweed';
    $videos = HomeVideo::all();

    return view('subpages.forkids', get_defined_vars());
  }

  public function hifzquran()
  {
    $title = 'Highly Qualified Quran Teachers | Online Quran Hifz Program';
    $schemafaq = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How to book a free class or a regular Hifz Quran course?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "It is very easy to book a one-day free trial class or a regular Hifz program with us. At first, you have to go to our site, fill the booking form, and submit it to us. Our online staff will get back to you within 24 hours for registration confirmation. In addition to this, your Quran tutor guides you about installing and using online software tools. Note: There is no registration fee for booking a trial class."
    }
  },{
    "@type": "Question",
    "name": "Is it possible to replace the Hifz-e-Quran tutor near me after registration?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, it is possible. We provide you the full opportunity to get a free tutor replacement if you are not satisfied with the performance or teaching method of your Hifz-e-Quran tutor. If there will be an issue with the Quran tutor, you can discuss it with us. In that case, we will take notice of the issue and pay attention to the reason behind the replacement request. If it is a valid reason, we will provide you the opportunity to get your current Hifz-e-Quran teacher replaced by the one recommended by you."
    }
  },{
    "@type": "Question",
    "name": "Do you have expert Islamic teachers for the Hifz-e-Quran program?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, Alhamdulillah, we are blessed with the best teachers. All Quran teachers near you are highly qualified, experienced, certified, well-trained, and professional to offer you online Quran Lessons. In addition to this, we have both Male and Female certified teachers for boys and girls to avoid any hesitation and trouble during interactive class sessions. Furthermore, do not worry about the background of your Quran memorization course teacher because we have already checked it, and everything is good to go."
    }
  },{
    "@type": "Question",
    "name": "Can I get a full refund upon cancellation of the Hifz Quran course?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, if you are not satisfied with your Quran teacher and want to cancel a booking, we offer you a 100% money-back guarantee. You can discuss the issue with us. We will take notice of your problem, and if your reason is valid, then we will give you a full refund."
    }
  }]
}
</script>
<script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Hifz Program",
                        "item": "https://onlinequrantuition.co.uk/quran-hifz-program"
                      }]
                    }
                 </script>';
    $schema = '<script type="application/ld+json">
                    {
                      "@context" : "http://schema.org",
                      "@type" : "Product",
                      "name" : "Online Quran Hifz Program",
                      "description": " Our Hafiz-e-Quran teachers are here to deliver an interactive online Hifz program via online sessions to help you memorize or hifz Quran accurately.",
                      "provider" : {
                        "@type" : "Website",
                        "name" : "Quran Hifz Program",
                        "sameAs" : "https://www.onlinequrantuition.co.uk/quran-hifz-program"
                       },
                     "review": {
                        "@type": "Review",
                        "reviewRating": {
                          "@type": "Rating",
                          "ratingValue": "4",
                          "bestRating": "5"
                        },
                        "author": {
                          "@type": "Person",
                          "name": "Adam Hussain"
                        }
                      },
                      "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "4.9",
                        "reviewCount": "197"
                      }
                     }
                     
                     }
                    </script>
                    ';
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Nottingham online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Nottingham don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Nottingham to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Nottingham because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Nottingham online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Nottingham. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Nottingham can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Nottingham Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $p2h = "Our Best Quran teachers";
    $p2 = "Every Muslim parent desires their kids to remembers Quran to get the reward from Allah in the world and hereafter. This course may take about three or more years; otherwise, the duration depends on the intellectuality of students. But our Quran teachers Leeds try their best to fill student's hearts with the light of the Quran. In addition to listening to daily Quran lessons, we also have arranged Quran worksheets in PDF form for better practice.";
    $description = 'Our Hafiz-e-Quran teachers are here to deliver an interactive online Hifz program via online sessions to help you memorize or hifz Quran accurately.';
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();

    $minititle = 'Hifz-e-Quran program';
    $headings1 = 'Are to struggling to find ';
    $headings2 = 'Hifz Quran classes near me?';

    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');
    $sectionBody = 'Don’t worry; our Hafiz-e-Quran teachers are here to deliver an interactive Quran Hifz program via online sessions to help you memorize Quran accurately. Alhamdulillah, we are blessed with a large group of highly qualified and professional male and female Hafiz-e-Quran teachers to enable you to memorize Quran from basics to the end proficiently with an Arabic accent. Our online staff communicates in the English language to make you understand things during an online Hifz course easily and provide you one-on-one Quran memorization sessions at a fantastic month-to-month pricing plan. Furthermore, to satisfy you with our services, we provide you with an opportunity to book a one-day free trial and a free tutor replacement or a full refund if you are dissatisfied.
        
        So, what are you waiting for? Register yourself now in our online Hifz classes and start learning.
        ';

    $faqs = [
      [
        'question' => 'How to book a free class or a regular Hifz Quran course?',
        'answer' => 'It is very easy to book a one-day free trial class or a regular Hifz program with us. At first, you have to go to our site, fill the booking form, and submit it to us. Our online staff will get back to you within 24 hours for registration confirmation.
                     In addition to this, your Quran tutor guides you about installing and using online software tools. 
                    Note: There is no registration fee for booking a trial class.
                    ',
      ],
      [
        'question' => 'Is it possible to replace the Hifz-e-Quran tutor near me after registration?',
        'answer' => 'Yes, it is possible. We provide you the full opportunity to get a free tutor replacement if you are not satisfied with the performance or teaching method of your Hifz-e-Quran tutor. 
                        If there will be an issue with the Quran tutor, you can discuss it with us. In that case, we will take notice of the issue and pay attention to the reason behind the replacement request. If it is a valid reason, we will provide you the opportunity to get your current Hifz-e-Quran teacher replaced by the one recommended by you.
                        
                        ',
      ],
      [
        'question' => 'Do you have expert Islamic teachers for the Hifz-e-Quran program?',
        'answer' => 'Yes, Alhamdulillah, we are blessed with the best teachers. All Quran teachers near you are highly qualified, experienced, certified, well-trained, and professional to offer you online Quran Lessons. In addition to this, we have both Male and Female certified teachers for boys and girls to avoid any hesitation and trouble during interactive class sessions. Furthermore, do not worry about the background of your Quran memorization course teacher because we have already checked it, and everything is good to go.',
      ],
      [
        'question' => 'Can I get a full refund upon cancellation of the Hifz Quran course?',
        'answer' => 'Yes, if you are not satisfied with your Quran teacher and want to cancel a booking, we offer you a 100% money-back guarantee. You can discuss the issue with us. We will take notice of your problem, and if your reason is valid, then we will give you a full refund.',
      ],
    ];
    $meta = 'quran hifz classes near me, quran memorization online, online hifz program, online hifz course, hifz classes near me, hifz quran, quran hifz classes ';
    $videos = HomeVideo::all();

    return view('subpages.forkids', get_defined_vars());
  }

  public function teach_with_us()
  {
    return view('teach_with_us');
  }

  public function add_teacher(Request $request)
  {
    $id = $request->id;
    $this->add_tutor($request);
    if ($id == 0) {
      return redirect()->back()->with('message', 'You have been successfully registered as a tutor.');
    } else {
      return redirect()->back()->with('message', 'Tutor Updated successfully');
    }
  }

  public function enroll($plan_id = 0)
  {
    return view('enroll', get_defined_vars());
  }

  public function pricing()
  {
    $plans = Plan::where('is_private', 0)->get();

    return view('pricing', get_defined_vars());
  }

  public function courses()
  {
    return view('courses');
  }

  public function how_it_works()
  {
    $faqs = Faq::all();

    return view('how_it_works', get_defined_vars());
  }

  public function terms()
  {
    return view('terms');
  }

  public function privacy()
  {
    return view('privacy');
  }

  public function privacy_policy()
  {
    return view('privacy_policy');
  }

  public function login()
  {
    // Logout any previous user if loged in
    if (Auth::check()) {
      Auth::logout();
    }

    return view('login');
  }

  public function check_user()
  {
    if (!Auth::check()) {
      return redirect('admin/login');
    }
    $user = Auth::user();

    if ($user->role === 'admin' || $user->role === 'manager') {
      return redirect()->route('admin.dashboard');
    }
    /* if ($user->role === "manager") {
            return redirect('admin/shared/dashboard');
            //return route('payment_manager/dashboard');
        }*/
    if ($user->role === 'tutor') {
      return redirect('tutor/appointments');
    }

    if ($user->role === 'student') {
      return redirect('student/dashboard');
    }
  }

  public function getLocation()
  {
    $url = 'http://api.ipinfodb.com/v3/ip-city/?key=345f70aec9a0975ea4290c4cf8c4276dbf8ce326c3946825467d68ea27bb185d&format=json';

    $s = curl_init();
    curl_setopt($s, CURLOPT_URL, $url);
    curl_setopt($s, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($s);
    curl_close($s);
    $r = json_decode($res);

    if ($r->statusCode == 'OK') {
      return $r;
    }

    return 'FAILED';
  }

  public function blogs($tag = null)
  {
    if (!$tag == null) {
      $blogs = Blog::where(function ($query) use ($tag) {
        $query->orWhere('meta_keywords', 'like', '%' . $tag . '%')->where('visibility', 'showed');
      })->paginate(10);
    } else {
      $blogs = Blog::where('visibility', 'showed')->paginate(10);
    }

    return view('blogs', get_defined_vars());
  }

  public function blog_detail(Request $request, $id, $slug = null)
  {
    $blog = Blog::find($id);
    $recent_blogs = Blog::orderBy('id', 'desc')->take(5)->get();

    return view('blog-details', get_defined_vars());
  }

  public function testimonials()
  {
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC')->paginate(10);

    $total_testimonials = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->get();

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $videos = HomeVideo::all();

    return view('testimonials', get_defined_vars());
  }

  public function checkSub($id)
  {
    $client = new \GoCardlessPro\Client([
      'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
      'environment'  => \GoCardlessPro\Environment::SANDBOX,
    ]);

    dd($client->subscriptions()->get($id));
  }

  public function emailUpdate(Request $request)
  {
    $request->validate([
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    ]);

    User::where('id', auth()->user()->id)->update(['email' => $request->email]);
    $user = User::where('id', auth()->user()->id)->first();
    $user->sendEmailVerificationNotification();

    return redirect()->back()->with('success', 'Email has been updated Please verify your email');
  }

  public function leedslocation()
  {
    $title = 'Best Online Quran Teachers In Leeds';
    $hero = 'Best Online Quran Teachers In Leeds';
    $schema = '<script type="application/ld+json">
                {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Leeds, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Leeds",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script> 
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Leeds",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-leeds"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
            {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How will I take Leeds Quran classes online?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "You have to install Skype/Zoom or another app that your Quran teacher near me recommends. Sign up on that app for taking live audio/video Quran classes. The teacher will call you at your decided time; you have to receive the call for starting your Quran classes."
    }
  },{
    "@type": "Question",
    "name": "What makes us the best Leeds Quran Madrassa online from others?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "First of all, we are providing highly affordable price plans for a month to month. Also, students can take free trial Quran classes online for three days. On our platform, you will learn Quran from a highly qualified and professional Quran teacher near me. Classes are so interactive and easily accessible for kids as well as adults."
    }
  },{
    "@type": "Question",
    "name": "How can I register in Leeds Quran classes online?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "You need to scroll down and seek the free trial Classes toolbar. Click on \" Take 3 days free trial\". After clicking on it, you will see a contact form. Fill it by writing all requirements like your name and contact info along with any message. Now, send it and wait for at least 24 hours. Our agent will surely contact you to guide you further."
    }
  },{
    "@type": "Question",
    "name": "Is it possible to replace a Quran teacher?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "If you don\'t understand your Quran lessons from your Quran teacher near me or have any other issues, don\'t worry! You can tell our agents; they will indeed resolve your issue by replacing your current Quran teacher with your recommended one. But you need to mention the reason behind the replacement of your Quran teacher."
    }
  },{
    "@type": "Question",
    "name": "Can I select timing for Quran classes online?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, we allow our students to decide the suitable timing when they\'re available for taking Quran classes online in Leeds. In the beginning, students can discuss with their teacher about class timing and decide that time which would be suitable for both of them."
    }
  }]
}

            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Leeds, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Nowadays, online Quran learning has become more popular because people are busy with their jobs or other activities. People in Leeds have local Quran Madrassas, but they are all very far from their homes. People are afraid of sending their kids alone to far off Leeds Madrassas. Therefore, they prefer online Quran classes in Leeds.Holy Quran is the book that is obligatory for all Muslims to learn Quran and recite it with a pleased tone. If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Leeds, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010.";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah! We have highly qualified Quran teachers who teach Quran 
        in a peaceful environment to connect students with Quran learning online, still the end. They are very cooperative and can understand and resolve the issues of students. Our Quran teachers include Hafiz-e-Quran, Tajweed-Ul-Quran, and Nazra-e-Quran teachers.In addition to a male teacher, our site also has an organized female Quran teacher near me in Leeds. They are all certified and experienced in teaching Quran online to thousands of students. They know how to encompass the Quran teaching in student's minds to achieve the best results. No doubt, our students always show 100% good results in exams for Quran courses.
";
    $c1h = 'Quran Reading';
    $c1 = "Quran Reading course includes learning Arabic/Quran language from basic to the completion of Quran. If you are looking for a Quran teacher near me for your kids, you can join our one on one Quran classes online in Leeds. Don't worry about Quran, teacher! Because highly qualified Quran teachers are available for these courses. Register your kids with carefree and get the opportunity of learning the Quran online with a single Quran tutor in Leeds.";
    $c2h = 'Quran Memorization';
    $c2 = "Every Muslim parent desires their kids to remembers Quran to get the reward from Allah in the world and hereafter. This course may take about three or more years; otherwise, the duration depends on the intellectuality of students. But our Quran teachers Leeds try their best to fill student's hearts with the light of the Quran. In addition to listening to daily Quran lessons, we also have arranged Quran worksheets in PDF form for better practice. ";
    $c3h = 'Tajweed Quran';
    $c3 = "Tajweed-Ul-Quran refers to read Quran with pleased and accurate pronunciation. Some people read Quran without Tajweed rules. But mistakes in heavier sounds, lighter sounds, and other mistakes change the meaning of the word. These mistakes change the translation of the Quran. Sometimes it may be wrong. Therefore, it's necessary to improve your Quran reading. If you want to learn Tajweed Al Quran, then join our Leeds Tajweed classes.";
    $r1h = 'Month to month Classes';
    $r1 = "Some needy people can't afford the yearly fee for Registration. Therefore, we've set monthly fee plans for joining our month-to-month Quran classes. It would be easy for everyone to learn Quran online in Leeds with well-versed Quran teachers.";
    $r2h = 'One on one Quran classes';
    $r2 = "Some aged women or men hesitate to learn along with kids or younger ones. Therefore, we've organized one-on-one Quran classes online for such kinds of students. Now they can learn Quran online in Leeds with a single personal Quran teacher near me.";
    $r3h = 'Schedule flexibility';
    $r3 = "Plus point of our site is that we are allowing selecting the timing by your own decision. We don't have any fixed timing for Quran classes online. You can tell your teacher when you will be available for taking Quran classes quickly. She/He will call you at your selected time for class.";
    $r4h = 'Certified Quran teachers';
    $r4 = "There's a lot of blessings of Allah that we have the world's best Quran teachers for teaching Quran online in Leeds. They are all professionals, certified, and experienced in Quran teaching. Our Quran teachers Leeds help our students to clear all their concepts about their Quran lessons.";
    $r5h = 'Female Quran teacher';
    $r5 = "Some students don't be satisfied with learning Quran from Qari-e-Quran teachers. Therefore, we have arranged a female Quran teacher near me for girls and ladies. Now. Islamic sisters can quickly learn Quran online In Leeds with a female Quran teacher near me.";
    $r6h = 'Interactive Classes';
    $r6 = "We've used advanced but handy tools to make our classes interactive for everyone. Kids can learn Quran from our online Quran classes quickly because we've made our Quran classes online accessible and handy for them. You can take your Quran class on any device like Laptop, Mobile, and tablet.";
    $faqs = [
      [
        'question' => 'How will I take Leeds Quran classes online?',
        'answer' => 'You have to install Skype/Zoom or another app that your Quran teacher near me recommends. Sign up on that app for taking live audio/video Quran classes. The teacher will call you at your decided time; you have to receive the call for starting your Quran classes.',
      ],
      [
        'question' => 'What makes us the best Leeds Quran Madrassa online from others?',
        'answer' => 'First of all, we are providing highly affordable price plans for a month to month. Also, students can take free trial Quran classes online for three days. On our platform, you will learn Quran from a highly qualified and professional Quran teacher near me. Classes are so interactive and easily accessible for kids as well as adults.',
      ],
      [
        'question' => 'How can I register in Leeds Quran classes online? ',
        'answer' => "You need to scroll down and seek the free trial Classes toolbar. Click on ' Take 3 days free trial'. After clicking on it, you will see a contact form. Fill it by writing all requirements like your name and contact info along with any message. Now, send it and wait for at least 24 hours. Our agent will surely contact you to guide you further",
      ],
      [
        'question' => 'Is it possible to replace a Quran teacher? ',
        'answer' => "If you don't understand your Quran lessons from your Quran teacher near me or have any other issues, don't worry! You can tell our agents; they will indeed resolve your issue by replacing your current Quran teacher with your recommended one. But you need to mention the reason behind the replacement of your Quran teacher.",
      ],
      [
        'question' => 'Can I select timing for Quran classes online?',
        'answer' => "Yes, we allow our students to decide the suitable timing when they're available for taking Quran classes online in Leeds. In the beginning, students can discuss with their teacher about class timing and decide that time which would be suitable for both of them. ",
      ],
    ];

    $meta = 'Online Quran classes in Leeds, Quran learning in Leeds, Quran recitation in Leeds, Quran teacher in Leeds, Quran in Leeds, Leeds reading Quran';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function derbylocation()
  {
    $title = 'Best Online Quran Teachers In Derby';
    $hero = 'Best Online Quran Teachers In Derby';
    $schema = '<script type="application/ld+json">
                {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Derby, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Derby",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  }
                }
                </script> 
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Derby",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-derby"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
            {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How will I take Quran classes online in Derby?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "You will take our Quran classes online in Derby on any device like a computer, laptop, or mobile with a good internet connection. You need to sign up for an account on Skype or Zoom. The teacher will call you on that account either video or audio. You\'ll accept the call to start an online call, and the teacher will deliver the lecture by sharing pdf book on screen."
    }
  },{
    "@type": "Question",
    "name": "Which textbooks are needed for reading Quran lessons?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "At Derby online Quran Academy, all textbooks about Quran lessons are digital and present in pdf. You don\'t need to buy books for prices. Instead, the teacher will send this pdf book to every student free of cost. Besides, we give pdf worksheets for practice to every student free of cost."
    }
  },{
    "@type": "Question",
    "name": "If I want to change Quran teacher, what we need to do?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "If you face any problem in learning Quran with your teacher, then you must tell us. You need to mention the reason for replacing your Quran teacher near me. If the reason is valid, our instructor will surely change your current Islamic teacher with a teacher."
    }
  },{
    "@type": "Question",
    "name": "As I can\'t afford the yearly Quran course, what thing I have to do?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "If you can\'t afford the yearly fee, then don\'t worry! We also have a month-on-month Quran class for students. You can submit month to month payment for registration in our monthly Quran classes. We imposed this criterion especially for those who face economic problems in Derby."
    }
  },{
    "@type": "Question",
    "name": "Will I learn Quran together with other students?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Not at all; we have individual Quran classes for every student. In a one-on-one Quran class, one Islamic teacher will teach a single student online for better communication. We understand that age difference and other reasons become the cause of nervousness among students. Therefore, we take this step to avoid hesitation of the student during Quran learning."
    }
  }]
}

            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Derby, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = 'Quran learning is an obligation for all Muslims because Allah commanded them to learn and read it. If you want to get prosperity in the world and reward in the hereafter from Allah, then you should learn and read Quran with sincere attention. Many Muslims are living in Derby, but Quran Madrassas are either rare or far away from houses. Therefore, people prefer online Quran classes in Derby for learning Quran without going from anywhere.<br>
Alhamdulillah, more than a thousand students have learned and got certified by our Quran teachers. In return, our students always give positive feedback about our interactive Quran classes and Quran teachers. If you also want to learn Quran online in Derby, register now for our one-on-one online Quran classes in Derby. 
';
    $p2h = 'Expert Quran teachers';
    $p2 = "In Derby, it's difficult to find the perfect local Quran teacher near me, but here you'll find the world's best online Islamic teacher for teaching Quran professionally. It's a great blessing of Allah on us that we are rewarded with Hafiz-e-Quran, Qari-e-Quran, and Tajweed-Al-Quran teachers. They are highly qualified and expertise in teaching Quran online.<br>
Moreover, we've female Quran tutors for girls and ladies in addition to a male Quran teacher near me. Our female Quran teachers are very cooperative in dealing with every student during online Quran class. Our staff can speak English, Urdu, and Arabic for conversation with students from different countries. They are not only graduated in Quran study but also experienced in teaching Quran online. 
";
    $c1h = 'Quran Reading';
    $c1 = "It's the basic duty of a Muslim to learn and recite Quran. Allah sent Quran on Earth for guidance and forgiveness of all Muslims. This course usually includes learning Arabic to read the Quran language. Some identification and daily learning and listening will enable your kids to complete the whole Quran reading at a suitable time. If you want to see your kids read Quran with fluency, then confirm the registration of your kids in our Quran classes in Derby. ";
    $c2h = 'Quran Memorization';
    $c2 = "It's also the most meaningful practice of Quran remembrance performed by many Muslims. Allah has a great reward for Hafiz-e-Quran in the world and afterlife. We have a particular Hafiz-e-Quran teacher near me who will enable kids and adults to memorize Quran easily. If you want to memorize Quran with Tajweed rules and a 100% Arabic accent, then join our Quran classes online in Derby. ";
    $c3h = 'Tajweed Quran';
    $c3 = "Tajweed-e: Quran means to read Quran with the application of Tajweed rules. Tajweed rules include Ramooz-e-Aukaaf, Laam & Meem Sakna, heavy and light sounds, etc. Muslims in Derby desire to learn Tajweed because it is commanded by Allah to recite Quran with Tarteel. If you want to improve your Nazra-e-Quran, then join our Tajweed classes online in Derby. Efforts of our Tajweed Quran teacher and students' practice will bring valuable results at the end of the course.";
    $r1h = 'Interactive classes ';
    $r1 = "Our online Quran classes in Derby are interactive due to the use of advanced and ancient techniques. We've made our online classes easily accessible to kids and adults. As a result, students learn Quran without any interruption. ";
    $r2h = 'One on one Quran classes';
    $r2 = 'We teach Quran to students through one-on-one Quran classes online in Derby. In one-on-one class, the single student will learn Quran from a single online Islamic teacher. It will help to make learning Quran peacefully and attentively. ';
    $r3h = 'Monthly classes ';
    $r3 = "We allow the parent to submit a few Quran courses month to month. Monthly classes are specially developed for those who can't pay the year-to-year fee. Now they can register for our monthly Quran classes online in Derby. ";
    $r4h = 'Certified Quran teachers';
    $r4 = 'Alhamdulillah, we have the best Quran teachers that are certified and professional in teaching Quran. They burn their midnight oil to deliver their best for the achievement of an excellent result. As a result, our students ever exhibit good grades. ';
    $r5h = 'Female Quran teacher';
    $r5 = "In addition to male Quran teachers, we also have female Quran teachers, especially for our Islamic sisters. If you don't prefer to learn from Qari, you can learn from an online female Quran tutor near me. ";
    $r6h = 'Free trial classes';
    $r6 = 'Suppose you want to check out our process before registration, then most welcome! We allow our new visitors to join our free trial classes for three days. If you get impressed with our Quran classes online, submit the fee and start your regular session.';
    $faqs = [
      [
        'question' => 'How will I take Quran classes online in Derby?',
        'answer' => "You will take our Quran classes online in Derby on any device like a computer, laptop, or mobile with a good internet connection. You need to sign up for an account on Skype or Zoom. The teacher will call you on that account either video or audio. You'll accept the call to start an online call, and the teacher will deliver the lecture by sharing pdf book on screen. ",
      ],
      [
        'question' => 'Which textbooks are needed for reading Quran lessons?',
        'answer' => "At Derby online Quran Academy, all textbooks about Quran lessons are digital and present in pdf. You don't need to buy books for prices. Instead, the teacher will send this pdf book to every student free of cost. Besides, we give pdf worksheets for practice to every student free of cost.",
      ],
      [
        'question' => 'If I want to change Quran teacher, what we need to do?  ',
        'answer' => 'If you face any problem in learning Quran with your teacher, then you must tell us. You need to mention the reason for replacing your Quran teacher near me. If the reason is valid, our instructor will surely change your current Islamic teacher with a teacher',
      ],
      [
        'question' => "As I can't afford the yearly Quran course, what thing I have to do?",
        'answer' => "If you can't afford the yearly fee, then don't worry! We also have a month-on-month Quran class for students. You can submit month to month payment for registration in our monthly Quran classes. We imposed this criterion especially for those who face economic problems in Derby",
      ],
      [
        'question' => 'Will I learn Quran together with other students?',
        'answer' => 'Not at all; we have individual Quran classes for every student. In a one-on-one Quran class, one Islamic teacher will teach a single student online for better communication. We understand that age difference and other reasons become the cause of nervousness among students. Therefore, we take this step to avoid hesitation of the student during Quran learning. ',
      ],
    ];

    $meta = 'Online Quran classes in Derby, Quran learning in Derby, Quran recitation in Derby, Quran teacher in Derby, Quran in Derby, Derby reading Quran';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function sheffieldlocation()
  {
    $title = 'Best Online Quran Teachers In Sheffield';
    $hero = 'Best Online Quran Teachers In Sheffield';
    $schema = '<script type="application/ld+json">
        {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Sheffield, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in sheffield",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>  
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in sheffield",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-sheffield"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
            {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "Why Sheffield Quran Academy is better than other Quran Madrassas?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Our online Quran Academy in Sheffield is better than others because we have the best Quran teachers to furnish interactive learning to you and your kids. Besides, our pricing plans are so reasonable that everyone can afford them while others Quran Madrassas are very expensive. You\'ll get monthly plans and one-on-one Quran classes opportunity for better attention."
    }
  },{
    "@type": "Question",
    "name": "What is the method of registration in Sheffield Quran classes?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "If you want to take free trial classes at Sheffield Quran Academy, then you need to fill our booking form on the website by selecting the course of your choice. The booking form requires your name, phone number, email and if you have any message, you can write it also, after that you have to send it. You need to wait for only one day because our chatting agent will contact you within 24 hours for further guide."
    }
  },{
    "@type": "Question",
    "name": "How long it will take to complete the Quran memorization course?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Quran memorization course needs a lot of effort and attention of the student. Usually, the completion of the Quran memorization course takes about three or more years. Still, we try to design a course outline so that students will learn easily and effectively in a suitable period. The most important thing is that we need student\'s attention and punctuality; the rest of the activity is our teacher\'s staple."
    }
  },{
    "@type": "Question",
    "name": "What requisites are needed for taking Sheffield Quran classes online?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "There are no complicated things needed to take Sheffield Quran classes online, but you need to have a device on which you and your teacher will connect through Zoom/Skype or another application. The device may be a laptop, computer, mobile or tablet, but it would be best to have a laptop for good communication. Besides, your internet connection must be good and powerful. In addition, you should have valuable microphones for better communication."
    }
  },{
    "@type": "Question",
    "name": "Is it essential to submit a yearly fee?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Not at all; we don\'t bound you to submit the yearly or long-term fee for taking Quran classes online in Sheffield. Instead, we\'ve set monthly fee plans too for the needy people. Now, they can enrol on our month-to-month Quran classes by submitting monthly payments. It would help make it easy for the people who can not afford yearly fee plans for learning Quran online."
    }
  }]
}

            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Sheffield, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Holy Quran is the religious book of Allah that is obligatory to read for all Muslims. Allah has a great reward for the Quran reader in the world and hereafter. In Sheffield, it's very difficult to learn Quran with a local Quran tutor because Quran Madrassas are rare and far off from residential areas. Therefore, it has now become challenging for the people of Sheffield to learn the Quran locally. But you don't need to worry because now you can learn Quran in your own home by joining our Quran classes online.<br>
Yes! We are the best online Quran Academy in Sheffield that offers 100% interactive learning with the world's best Islamic online teachers. Alhamdulillah, more than twenty-five experts Quran teachers are available for teaching Quran online. About 700+ students have learned and got certified from here. We assure you to provide 100% results for our students along with moral training. 
";
    $p2h = 'Our Quran teachers';
    $p2 = "We are proud of our teachers who never leave the stone in achieving excellent results for our students. Our Quran teachers include Tajweed-Ul-Quran, Hafiz-e-Quran and Qari-e-Quran. They are all certified and experienced in teaching Quran online. Their method is not only professional but also impressive to make students enable to acquire useful learning. We've both male and female Quran teachers for reaching boys and girls separately.<br>
<h3 class='text-skin'>Male Quran teacher</h3>
<p class='text-white'>Our male Quran teachers teach Quran online in a professional way by using different advanced tools. They are all certified and hold degrees in Islamic education and Quran study. Specialized Hafiz-e-Quran teacher near me is available for the Quran memorization course. Their teaching strategy is so exquisite that all students keep bound with Quran learning till the end.</p>
<h3 class='text-skin'>Female Quran teacher</h3>
<p class='text-white'>A female Quran teacher near me is available for Islamic girls and ladies. Our female staff is so cooperative; they know how to teach students politely and friendly. They have experience teaching Quran online to more than a thousand students. All students learning from Sheffield Quran Academy always show excellent results due to expertise in Quran teachers. </p>
";
    $c1h = 'Quran Reading';
    $c1 = "Reading Quran is the basic responsibility of Muslims to get a reward from Allah in the world and on the last day. Therefore, Muslim parents ask their kids to learn Quran in their childhood. But people in Sheffield face difficulty in sending their kids alone to far off Madrassas. Thus, they seek an online Quran Academy in Sheffield that can teach Quran to their kids with full dedication and sincerity. If you're one of them, then you must join our Quran classes for Quran reading course.";
    $c2h = 'Quran Memorization';
    $c2 = 'Quran remembrance is another great practice of Islamic religion to get fame in the world and hereafter. Suppose you want to see your kids memorize Quran with the correct pronunciation. In that case, you must choose our online Quran Academy in Sheffield because we have designed this course as 114 surahs classified into 6666 verses, completed by our students in almost three years. Our highly qualified Hafiz-e-Quran teachers will teach this course with full commitment. ';
    $c3h = 'Tajweed Quran';
    $c3 = "Tajweed-Al-Quran means Quran recitation with a proficient Arabic accent. It's essential to learn for those who read Quran, but they must know it's very wrong because even a heavy or light sound mistake can change the meaning of the word in Arabic and its translation. As a result, it will change the message of Allah for us. Therefore, we should read Quran as led by Allah in a pleasant style. If you want to improve your Quran reputation, then join our Sheffield Tajweed classes. ";
    $r1h = 'Interactive classes ';
    $r1 = 'No doubt, our Sheffield Quran classes use both advanced and ancient technology to become interactive for students. You and your kids can easily access our online classes through mobile or laptop. We assure you to provide interactive Quran learning by using different tools';
    $r2h = 'Free trial classes';
    $r2 = 'We teach Quran to students through one-on-one Quran classes online in Derby. In one-on-one class, the single student will learn Quran from a single online Islamic teacher. It will help to make learning Quran peacefully and attentively. ';
    $r3h = 'Certified Quran teachers';
    $r3 = 'Our Quran teachers are all certified in Quran study and online teaching. They not only have a certification but also have experience of online Quran teaching in Sheffield. Their teaching method is so powerful that no one can be dissatisfied with them.';
    $r4h = 'Female Quran teachers';
    $r4 = "Some girls or ladies don't prefer to learn Quran from a male Quran teacher; instead, they prefer to learn from a female Quran tutor near me. Therefore, we have arranged expert female Quran teachers for teaching Islamic sisters. ";
    $r5h = 'Monthly classes';
    $r5 = "People in Sheffield desire to learn Quran, but they don't have high sources to overdo and with Quran Madrassa expenses. Therefore, we set a very reasonable fee for month-to-month that help you to afford easily. You don't need to be bound for submitting a few for the whole Quran course.";
    $r6h = 'One-on-one Classes';
    $r6 = "One-on-one Quran classes are specially designed for shy students and don't prefer to learn along with the class. People prefer individual class due to their age difference with others or some nervousness. But they don't need to worry; now, a single student can learn Quran with a single Quran teacher near me.";
    $faqs = [
      [
        'question' => 'Why Sheffield Quran Academy is better than other Quran Madrassas?',
        'answer' => "Our online Quran Academy in Sheffield is better than others because we have the best Quran teachers to furnish interactive learning to you and your kids. Besides, our pricing plans are so reasonable that everyone can afford them while others Quran Madrassas are very expensive. You'll get monthly plans and one-on-one Quran classes opportunity for better attention. ",
      ],
      [
        'question' => 'What is the method of registration in Sheffield Quran classes?',
        'answer' => 'If you want to take free trial classes at Sheffield Quran Academy, then you need to fill our booking form on the website by selecting the course of your choice. The booking form requires your name, phone number, email and if you have any message, you can write it also, after that you have to send it. You need to wait for only one day because our chatting agent will contact you within 24 hours for further guide.',
      ],
      [
        'question' => 'How long it will take to complete the Quran memorization course?',
        'answer' => "Quran memorization course needs a lot of effort and attention of the student. Usually, the completion of the Quran memorization course takes about three or more years. Still, we try to design a course outline so that students will learn easily and effectively in a suitable period. The most important thing is that we need student's attention and punctuality; the rest of the activity is our teacher's staple.",
      ],
      [
        'question' => 'What requisites are needed for taking Sheffield Quran classes online?',
        'answer' => 'There are no complicated things needed to take Sheffield Quran classes online, but you need to have a device on which you and your teacher will connect through Zoom/Skype or another application. The device may be a laptop, computer, mobile or tablet, but it would be best to have a laptop for good communication. Besides, your internet connection must be good and powerful. In addition, you should have valuable microphones for better communication. ',
      ],
      [
        'question' => 'Is it essential to submit a yearly fee? ',
        'answer' => "Not at all; we don't bound you to submit the yearly or long-term fee for taking Quran classes online in Sheffield. Instead, we've set monthly fee plans too for the needy people. Now, they can enrol on our month-to-month Quran classes by submitting monthly payments. It would help make it easy for the people who can not afford yearly fee plans for learning Quran online.",
      ],
    ];

    $meta = 'Online Quran classes in Sheffield , Quran learning in Sheffield , Quran recitation in Sheffield , Quran teacher in Sheffield , Quran in Sheffield , Sheffield  reading Quran ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function lutonlocation()
  {
    $title = 'Best Online Quran Teachers In Luton';
    $hero = 'Best Online Quran Teachers In Luton';
    $schema = '<script type="application/ld+json">
        {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Luton, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Luton",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script> 
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Luton",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-luton"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
            {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "What\'s the procedure of taking Luton Quran classes?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "It\'s very easy to take Luton Quran classes online. It would be best if you had a laptop or mobile to take a class online. After that, you have to create an account on an application recommended by your Quran teacher near me. The teacher will call you at your selected time, which is received by you to start live class. In the beginning, your Quran teacher will discuss or listen to the previous lesson, then he/she will teach the next Quran lesson."
    }
  },{
    "@type": "Question",
    "name": "Is it possible to replace the Quran teacher near me?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, it is possible! We will give you the full opportunity to change your current teacher if you\'re not satisfied with him/her. If there will be an issue with your Quran teacher, you can discuss it with us. We will pay heed to your reason behind the replacement of your teacher. If it is a valid reason, then we will replace your current teacher with your recommended one."
    }
  },{
    "@type": "Question",
    "name": "Why Luton online Quran tuition is better than other Quran centers?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Our online Quran Academy in Luton is better than other Quran Madrassas because we\'re the ones that provide online Quran learning at a very suitable price. Our less prices will not affect the quality of our services. Instead, we provided expertise and certified Quran teachers along with interactive learning to our students."
    }
  },{
    "@type": "Question",
    "name": "Is it possible to check out Luton Quran classes as a free trial?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, you can check out our process and validity of our Luton Quran classes online because we allow taking free trial classes. These free trial classes are available for three days. And the good news is that these three days trial classes are free of cost for our students."
    }
  },{
    "@type": "Question",
    "name": "What\'s the age limit of taking Luton Quran classes?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "There\'s no specific age limit for taking Luton Quran classes online. Anyone, including kids, adults and old ladies and gents, can register here for taking online Quran classes. There is no bug issue of age because there are one-on-one Quran classes in which a single student will get a single Quran teacher near me to avoid hesitation."
    }
  }]
}

            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Luton, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Holy Quran is the book of Allah that comes down the Earth for the guidance and forgiveness of Muslims. Muslims learn and read Quran to get Allah's bliss in the world and hereafter. Many Muslims live in Luton who desires to learn the Quran but can't go out of home nowadays because of COVID-19 lockdown or far off Madrassas. Therefore, we made it easy for them to learn Quran in their own home.<br>
If you want to learn Quran online without going anywhere with the best Quran teacher near me, then you've come to the right site. Because here, you'll find your all desired requirements as we have the best Quran teachers along with interactive Quran learning. Our one-on-one Quran classes would lurk your kid's interest in Quran study. Besides, you'll learn Quran from Luton Quran Academy at very reasonable prices as well as month-to-month prices. 
";
    $p2h = 'Our Quran teachers ';
    $p2 = "Alhamdulillah, we are blessed with +25 expertise Quran teachers from different countries. They are all certified and professional in teaching Quran online. Their teaching strategy is so wonderful that all students keep connected with learning till the end. All credit goes to our best Islamic teachers who try their best to achieve excellent results.<br>
Our online teaching staff includes highly qualified Hafiz-e-Quran, Tajweed-Al-Quran and Nazra-e-Quran teachers. They are all experienced in teaching online Quran courses. People who live in Luton don't need to worry about their language for communication because our online Quran tutors can speak English fluently during Quran classes. We've both male teacher for boys and female teacher for girls. 
";
    $c1h = 'Quran Reading';
    $c1 = "Quran Reading course means to learn Quran language from basics. This course is somewhat difficult for people who live in Luton because their native language is not Arabic. They need to learn from basic to end for reading Quran fluently. Course duration is more than three years but depends on the effort and intelligence of the learner. That's why it takes time to complete the whole Quran reading. If you want to see your kids read Quran accurately and fluently, then join our Luton Quran classes online.";
    $c2h = 'Quran Memorization';
    $c2 = "Quran Memorization is the remembrance of the whole Quran that is a great practice of the Islamic religion performed by Muslims to get Allah's bliss and affection.  This course includes the remembrance of 30 Surahs with Tajweed rules. Therefore, it takes almost three years to complete. If you're looking for the best Hafiz-e-Quran tutor online in Luton, then join our one-on-one Quran Memorization classes. We've established a Hafiz-e-Quran teacher near me to teach Quran online.";
    $c3h = 'Tajweed Quran';
    $c3 = "Tajweed-e-Quran means the Quran is reading along with proficient Arabic Accent. It's very important to learn because it's wrong to read Quran in a simple tone. It creates many mistakes in the translation of the Quran that can become the cause of sin. So, if you want to improve your Quran reading, then join our Luton Tajweed classes online. We have a highly qualified Tajweed Quran teacher near me who will give you a smaller concept about Tajweed Al Quran.";
    $r1h = 'Interactive Quran classes';
    $r1 = "Luton Quran classes are interactive and easily accessible from anywhere in the world. We've used different handy tools for making online classes interactive for our students. Every learning facility is available at Luton Quran Academy for the accomplishment of excellent results.";
    $r2h = 'One-on-one classes';
    $r2 = 'We provide One-on-one Quran classes, especially for those who hesitate to learn with other students because of either age difference or shyness. So join our Luton Quran classes for learning with the single best Quran teacher near me.';
    $r3h = 'Month-to-month classes';
    $r3 = "Monthly classes are available for the people who can't pay for the year to year fee. Now, they can get this golden opportunity to learn from our qualified teachers by submitting a monthly fee. After one month, you need to register and submit the monthly pricing plan again.";
    $r4h = 'Certified Quran teachers';
    $r4 = "At Luton online Quran Academy, all Quran teachers are certified that hold degrees in Islamic education and Quran study. Moreover, we've specialized teachers like Hafiz-e-Quran teacher for the Hifz-e-Quran course and Qari for teaching Quran reading.";
    $r5h = 'Female Quran teachers';
    $r5 = 'Besides male Quran teachers, female Quran teachers are also available on Luton Quran Academy online. They are very cooperative and able to deal with every matter faced by students during Quran class. In addition, a female Quran tutor near me is specifically available for Islamic sisters and kids.';
    $r6h = 'Free trial classes';
    $r6 = "One of the most important things is that we're allowing taking trial classes for three days. We give three days trial classes for free so that you will satisfy with our performance of teaching the Quran interactively.";
    $faqs = [
      [
        'question' => "What's the procedure of taking Luton Quran classes? ",
        'answer' => "It's very easy to take Luton Quran classes online. It would be best if you had a laptop or mobile to take a class online. After that, you have to create an account on an application recommended by your Quran teacher near me. The teacher will call you at your selected time, which is received by you to start live class. In the beginning, your Quran teacher will discuss or listen to the previous lesson, then he/she will teach the next Quran lesson.",
      ],
      [
        'question' => 'Is it possible to replace the Quran teacher near me?',
        'answer' => "Yes, it is possible! We will give you the full opportunity to change your current teacher if you're not satisfied with him/her. If there will be an issue with your Quran teacher, you can discuss it with us. We will pay heed to your reason behind the replacement of your teacher. If it is a valid reason, then we will replace your current teacher with your recommended one.",
      ],
      [
        'question' => 'Why Luton online Quran tuition is better than other Quran centers? ',
        'answer' => "Our online Quran Academy in Luton is better than other Quran Madrassas because we're the ones that provide online Quran learning at a very suitable price. Our less prices will not affect the quality of our services. Instead, we provided expertise and certified Quran teachers along with interactive learning to our students.",
      ],
      [
        'question' => 'Is it possible to check out Luton Quran classes as a free trial? ',
        'answer' => 'Yes, you can check out our process and validity of our Luton Quran classes online because we allow taking free trial classes. These free trial classes are available for three days. And the good news is that these three days trial classes are free of cost for our students.',
      ],
      [
        'question' => "What's the age limit of taking Luton Quran classes? ",
        'answer' => "There's no specific age limit for taking Luton Quran classes online. Anyone, including kids, adults and old ladies and gents, can register here for taking online Quran classes. There is no bug issue of age because there are one-on-one Quran classes in which a single student will get a single Quran teacher near me to avoid hesitation.",
      ],
    ];

    $meta = 'Online Quran classes in Luton , Quran learning in Luton , Quran recitation in Luton , Quran teacher in Luton , Quran in Luton , Luton  reading Quran ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function southamptonlocation()
  {
    $title = 'Best Online Quran Teachers In Southampton';
    $hero = 'Best Online Quran Teachers In Southampton';
    $schema = '<script  type="application/ld+json">
        {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Southampton, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Southampton",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>  
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Southampton",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-southampton"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
            {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "Is it necessary to submit the fee for the full course duration?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Not at all; if you don\'t want to submit your fee for your selected full Quran course, then don\'t worry! We allow you to submit your payment month to month. This monthly fee plan is especially fixed for the needy people who requested us to learn Quran online in Southampton."
    }
  },{
    "@type": "Question",
    "name": "Is Southampton Quran tuition online expansive?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Not at all; we have set very reasonable pricing plans that every ordinary person can afford. Every normal person can now learn Quran online with the best Southampton Quran tutors. In comparison to other Southampton Madrassas, our fees for courses are very low."
    }
  },{
    "@type": "Question",
    "name": "What\'s the process of registering in Southampton Quran classes?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "To register in our Southampton Quran Academy, you have to click on \"Take free trial class.\" You will find an application form. Fill it with your name and contact information. If you want to leave a message for us, you can write in the message box. After filling it, you have to send it and wait for one day. We will contact you within 24 hours for the next procedure."
    }
  },{
    "@type": "Question",
    "name": "How long will it take to remember the whole Quran?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Quran Memorization Normally takes three or more years to complete the whole Quran. But it depends on the efforts and intelligence of students. We need student\'s appearance and attention during Quran class. In this way, we will succeed in achieving the best results in a suitable period."
    }
  },{
    "@type": "Question",
    "name": "Can I record Southampton Quran lessons online?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Of course! You can record your Quran lesson during online Quran class. The benefit of recording your Quran class is that you can playback after again for practice and revision. Therefore, we let our students record live Southampton Quran classes online."
    }
  }]
}


            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Southampton, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Holy Quran is the sacred book of Allah that comes down the Earth for all Muslims to show the right path for spending life on Earth. All Muslims must learn and recite Quran accurately. It's a very wise task; therefore, it should learn from well qualified Quran tutors. <br>
If you are looking for the perfect Southampton Quran teacher near me, then you've come to the right place! You are at the platform that is the world's best Southampton Quran tuition for kids and adults. We've highly qualified and experienced Quran teachers who know the value of learning the Quran. You can join our Quran classes without hesitation. 
";
    $p2h = 'Our Quran teachers ';
    $p2 = "All efforts and credits depend on our Quran teachers, who try their best to deliver 100% students. We're blessed with Hafiz-e-Quran, Tajweed-Ul-Quran, and Nazra-e-Quran teachers. They are not only certified but also experienced in teaching Quran online to more than a thousand students. Their method of teaching is so satisfactory that students never leave the passion of Quran learning. 
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>Besides male Quran teachers, we've also female Quran tutors for Islamic sisters who teach Quran in a peaceful environment. They can speak English to conversate with students who live in Southampton. Girls and Islamic sisters can also learn Quran with highly qualified and experienced Southampton female Quran teacher.</p>";
    $c1h = 'Quran Reading';
    $c1 = "Quran Reading is the basic duty of all Muslims for getting prosperity and fame in the world and hereafter. Therefore, every Muslim parent asks their kids to learn Quran in their childhood, but nowadays, it has become popular to learn Quran online. If you're looking for the best online Quran school in Southampton for your kids, then don't miss out on our site because we have the best teachers with an interactive learning process.";
    $c2h = 'Quran Memorization';
    $c2 = "Hifz-e-Quran is the most popular act among Muslims to get Allah's affection and mercy. Many people are living in Southampton desire to remember Quran with a Hafiz-e-Quran teacher near me. Fortunately, you'll find the best Quran teachers here for interactive learning. We need your sincere attention and punctuality. At the end of the courses, you will remember the unforgettable Holy Quran.";
    $c3h = 'Tajweed Quran';
    $c3 = "Tajweed-Ul-Quran means to read Quran with proficiency. It's very important to learn because we should read Quran as commanded by Allah to read. According to Tajweed rules, when we don't read Quran, it changes the meaning of Allah's message for us. As a result, it creates fallacies and fits of anger for us from Allah. Therefore, it's necessary to learn Tajweed from a professional Quran teacher. Fortunately, you are at a place where you can take Southampton Tajweed classes with well-versed Quran teachers.";
    $r1h = 'Female Quran teacher';
    $r1 = "Some girls prefer to learn from female Quran teachers and hesitate to learn from a male teacher. Therefore, we've come up with highly qualified and professional female Quran teachers from different countries. In addition to the best Quran teachers, they are very cooperative.";
    $r2h = 'Month-to-month classes';
    $r2 = "We've arranged month-to-month Southampton Quran classes because some needy people can't afford yearly fee plans for Registration. Now, everyone can learn Quran by selecting our affordable monthly fee plans. ";
    $r3h = 'One-on-one classes';
    $r3 = 'One benefit of our Southampton Quran Academy is that we provide one-on-one Quran classes for our students. Some students are shy and feel hesitant to learn with their fellow who is not of their age. Now, they can learn Quran online with a single Southampton Quran teacher near me.';
    $r4h = 'Certified Quran teachers';
    $r4 = 'All Quran teachers online in Southampton are certified and hold degrees in Quran teaching. Moreover, they are all at least graduated in Islamic studies. Hafiz-e-Quran teachers have certification of Quran Memorization.';
    $r5h = 'Schedule flexibility';
    $r5 = 'We provide our students with schedule flexibility in taking online Quran classes. Yes! You can decide the timing by discussing it with your Quran teacher online. Your male/ female Quran teacher near me will call you either audio or video at your selected timing. ';
    $r6h = 'Interactive Classes';
    $r6 = 'We provide our students with interactive learning. Our teaching method is so impressive, especially for kids; we provide 100% coaching in addition to Quran teaching. We use such tools that are easily accessible for kids as well as adults.';
    $faqs = [
      [
        'question' => 'Is it necessary to submit the fee for the full course duration? ',
        'answer' => "Not at all; if you don't want to submit your fee for your selected full Quran course, then don't worry! We allow you to submit your payment month to month. This monthly fee plan is especially fixed for the needy people who requested us to learn Quran online in Southampton.",
      ],
      [
        'question' => 'Is Southampton Quran tuition online expansive?',
        'answer' => 'Not at all; we have set very reasonable pricing plans that every ordinary person can afford. Every normal person can now learn Quran online with the best Southampton Quran tutors. In comparison to other Southampton Madrassas, our fees for courses are very low.',
      ],
      [
        'question' => "What's the process of registering in Southampton Quran classes? ",
        'answer' => 'To register in our Southampton Quran Academy, you have to click on "Take free trial class." You will find an application form. Fill it with your name and contact information. If you want to leave a message for us, you can write in the message box. After filling it, you have to send it and wait for one day. We will contact you within 24 hours for the next procedure.',
      ],
      [
        'question' => 'How long will it take to remember the whole Quran? ',
        'answer' => "Quran Memorization Normally takes three or more years to complete the whole Quran. But it depends on the efforts and intelligence of students. We need student's appearance and attention during Quran class. In this way, we will succeed in achieving the best results in a suitable period.",
      ],
      [
        'question' => 'Can I record Southampton Quran lessons online? ',
        'answer' => 'Of course! You can record your Quran lesson during online Quran class. The benefit of recording your Quran class is that you can playback after again for practice and revision. Therefore, we let our students record live Southampton Quran classes online. ',
      ],
    ];

    $meta = 'Online Quran classes in Southampton , Quran learning in Southampton , Quran recitation in Southampton , Quran teacher in Southampton , Quran in Southampton , Southampton  reading Quran';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function londonlocation()
  {
    $title = 'Best Online Quran Teachers In London';
    $hero = 'Best Online Quran Teachers In London';
    $schema = '<script type="application/ld+json">
        {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in London, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in London",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>      
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in London",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-london"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [{
                "@type": "Question",
                "name": "What are the benefits of learning London Quran classes?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "We are the one of the most leading Quran Madrassas that offers three Quran courses at a very reasonable price without taking any registration fee. Moreover, you will learn from highly qualified and certified London Quran teachers from here. Besides, we give schedule flexibility, 24/7 availability, monthly fee charges, along with three days free trial."
                }
              },{
                "@type": "Question",
                "name": "Is it possible to replace the Quran tutor?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes, it\'s possible! If you\'re not satisfied with our online Quran teacher near me, then inform our instructor. We will surely listen to your matters and replace that teacher with your recommended Quran teacher."
                }
              },{
                "@type": "Question",
                "name": "Can I change the timing of London Quran classes?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes, you can change the timing because we provide you with one on one London Quran classes online; you can select the timing according to your availability. You need to discuss with your Quran teacher and decide the time suitable for both of you."
                }
              },{
                "@type": "Question",
                "name": "What are the requirements for taking the class?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "It\'s straightforward to take an online Quran Tajweed classes on our platform. You need to arrange a device like a computer, laptop, tablet, or mobile on which you\'ll take your Quran class. Besides, you must have a good internet connection along with microphones for better communication during Quran class."
                }
              },{
                "@type": "Question",
                "name": "What is the procedure of taking a London Quran classes?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "The Quran teacher will call you either audio or video on Zoom/Skype at your selected time. You\'ll receive that call to start your lecture. The teacher will discuss, share, or listens to the previous lesson in the first fifteen minutes. After that, he/she will deliver the following speech and share a digital book on the screen that both student and teacher can see."
                }
              }]
            }
            
            

            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in London, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Holy Quran is the sacred book gifted from Allah for all Muslims. This book has guidance, advice, and solution to problems and suggestions for all Muslims in the world. Hence, it's obligatory to learn and recite Quran with the correct pronunciation. So, every Muslim parent desire to see their kids learn Quran in their childhood. If you're looking for Quran teacher near me, then stay here!<br>
In London, Quranic centers and Madrassas are very far, and it has become challenging to go out of home because they are busy with their jobs or COVID-19 lockdown. A piece of excellent news for those who live in London and want to learn the Quran is that we offer online Quran classes at home at very reasonable prices. Come and join us! 
";
    $p2h = 'Our Quran teachers ';
    $p2 = "Alhamdulilah, we have organized the +25 best online London Quran teachers from different countries who hold degrees in Islamic education and Quran teachings. Every Islamic teacher has experience teaching the Quran online to 500+ students. Their teaching strategy is so impressive that students become connected with learning until the end of the session. Our Quran teachers include Hifz-e-Quran, Qari-e-Quran, and Tajweed Quran teachers.
";
    $c1h = 'Quran Reading';
    $c1 = 'Quran Reading is the fundamental duty of a Muslim to get love from Allah. Therefore, every parent desire to learn Quran in their childhood, but people who live in London face the problem of far off Madrassas. Now, People who live in London can learn Quran from our site named online Quran tuition. We provide one on one Quran classes with certified male and female Quran teacher.';
    $c2h = 'Quran Memorization';
    $c2 = "Quran Memorization is an act of learning the Quran by heart with complete devotion and dedication. In this course, students have to know the whole Quran classified into 30 Surahs. If you're looking for female Quran teacher near me, then join us! Our Hifz e Quran teachers teach so that students will never forget the entire Quran till the end. We provide each facility to our students for better learning. Besides, we give the students pdf exercise worksheets for practice. ";
    $c3h = 'Tajweed Quran';
    $c3 = "Tajweed Al Quran means to read Quran with the correct pronunciation. The primary mistake made by Muslims is to read Quran with a simple tone/without application of Tajweed rules, but it creates a false sense in the meaning of the word. Therefore, it's necessary to learn Quran Tajweed and recite accurately. We are offering Tajweed-Al-Quran courses online for you and your kids. We provide interactive Quran Tajweed classes along with certified Quran teachers for teaching Quran. ";
    $r1h = 'Free trial classes ';
    $r1 = "If you are confused about our online Quran classes London, then don't worry! We are offering three days trial classes for free to check out our process of Quran teaching. If you feel satisfied, then you can proceed with your regular session. ";
    $r2h = 'Monthly classes';
    $r2 = "You don't need to register for1 a year or a more extended time. Instead, our site allows you to join our online Quran class from month to month. After one month, you need to register and submit your monthly fee again. ";
    $r3h = 'Interactive classes ';
    $r3 = "We have used both ancient and advanced tools for making learning easy and helpful for our students. Our Quran classes London are of high quality without any interruption in learning Quran. Whether you are a beginner, but you'll learn from basic concepts to advanced ones from our site. ";
    $r4h = 'Easily accessible ';
    $r4 = 'Our Quran classes are easily accessible from anywhere. You can take our Quran Tajweed classes on every device, mobile, laptop, or tablet. Besides, you can record your Quran lessons and can listen to them after lectures at any time.';
    $r5h = 'Certified Quran teachers ';
    $r5 = 'We have more than twenty-five male and female Quran teachers who teach Quran with complete dedication. They struggle their best to explain minor concepts related to Quran teaching. The way they teach is awe-inspiring and engaging.  ';
    $r6h = 'Female Quran teachers';
    $r6 = 'In addition to male Quran tutors, we have also organized female Quran teachers for teaching girls and ladies. We are blessed with those London Quran teachers who burn their midnight oil to show the best results of their Quran classes.';
    $faqs = [
      [
        'question' => 'What are the benefits of learning London Quran classes?  ',
        'answer' => 'We are the one of the most leading Quran Madrassas that offers three Quran courses at a very reasonable price without taking any registration fee. Moreover, you will learn from highly qualified and certified London Quran teachers from here. Besides, we give schedule flexibility, 24/7 availability, monthly fee charges, along with three days free trial. ',
      ],
      [
        'question' => 'Is it possible to replace the Quran tutor? ',
        'answer' => "Yes, it's possible! If you're not satisfied with our online Quran teacher near me, then inform our instructor. We will surely listen to your matters and replace that teacher with your recommended Quran teacher. ",
      ],
      [
        'question' => 'Can I change the timing of London Quran classes?',
        'answer' => 'Yes, you can change the timing because we provide you with one on one London Quran classes online; you can select the timing according to your availability. You need to discuss with your Quran teacher and decide the time suitable for both of you. ',
      ],
      [
        'question' => 'What is the procedure of taking a London Quran classes?',
        'answer' => "The Quran teacher will call you either audio or video on Zoom/Skype at your selected time. You'll receive that call to start your lecture. The teacher will discuss, share, or listens to the previous lesson in the first fifteen minutes. After that, he/she will deliver the following speech and share a digital book on the screen that both student and teacher can see.",
      ],

    ];

    $meta = 'Online Quran classes in London , Quran learning in London , Quran recitation in London , Quran teacher in London , Quran in London , London  reading Quran';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function birminghamlocation()
  {
    $title = 'Best Online Quran Teachers In birmingham';
    $hero = 'Best Online Quran Teachers In birmingham';
    $schema = '<script type="application/ld+json">
          {
              "@context": "http://schema.org",
              "@type": "Product",
              "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "4.1",
                "reviewCount": "197"
              },
              "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Birmingham, you can register here without hesitation. Alhamdulillah, we havve been teaching Quran to more than a thousand students since 2010",
              "name": "Quran Teacher in Birmingham",
              "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
              "offers": {
                "@type": "Offer",
                "availability": "http://schema.org/InStock",
                "price": "4.00",
                "priceCurrency": "£"
              }
          }
                </script> 
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Birmingham",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-birmingham"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
          "@context": "https://schema.org",
          "@type": "FAQPage",
          "mainEntity": [{
            "@type": "Question",
            "name": "Is there an age limit to join Birmingham Quran classes online?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "No, there\'s no age limit for registration in our Quran classes. Instead, kids, adults, and old gents & ladies can learn Quran from Birmingham Quran Academy online. We have a single Quran teacher near me for every person."
            }
          },{
            "@type": "Question",
            "name": "Can I replace the Birmingham Quran teacher?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Yes, we let you change your Quran teacher if you\'re not satisfied with him/her. If you have any issue understanding your current Quran teacher, then discuss the Birmingham Quran Academy instructors; we will replace your teacher with another Quran online."
            }
          },{
            "@type": "Question",
            "name": "How can I enroll in Birmingham Quran classes?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "There\'s a straightforward method for Registration in Quran classes online. Scroll down the page. You will find a button named \"Take free trial classes.\" Click on it. You will see a contact form. Write your full name, email, phone number, or message (optional), and submit this contact form by pressing the button below. After that, you need to wait for one day. Our chatting agent will contact you to guide you further."
            }
          },{
            "@type": "Question",
            "name": "How long will it take to complete Birmingham Quran lessons online?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Duration depends on the efforts and punctuality of students. Usually, our kids complete Quran reading in almost two years or more. Tajweed Classes need practice having three levels. Quran Memorization takes almost three or more years. But you don\'t need to register for an extended period; instead, you can choose our monthly pricing plans."
            }
          },{
            "@type": "Question",
            "name": "Is you give any relief in fee for learning Quran online?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "We\'ve already set a very reasonable pricing plan that an ordinary person in Birmingham can afford. You\'ll find the world \'s best Quran tutors at a meager cost at Birmingham Quran Academy online. Besides, we are giving you a month-to-month Registration option for your ease."
            }
          }]
        }

            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Birmingham, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is an obligation of all Muslims to get Allah's love and mercy. Every parent desires their kids to learn Quran in their childhood. People in Birmingham have their homes far off to Islamic centers and Madrassas; they can't go out or send their kids alone to far-off places. Therefore they prefer Birmingham Quran Tuition online.<br>
If you want an affordable but perfect Quran academy, then meet us! We've come up with Quran classes online accessible for people who live in Birmingham. We are spreading the light of the Quran to Muslims all over the world. Our Quran classes are interactive, accessible, and can be recorded/playback by students.<br>
We offer three Quran courses online in Birmingham; you can select any one of your own choices. Over more than five hundred students have learned Quran from our site and shown 100% results. Now they can read Quran accurately and fluently. All credit goes to our Birmingham Quran teachers online, who try their best to achieve the best results. Let's know about our courses.
";
    $p2h = 'Quran Reading ';
    $p2 = "Quran recitation is the essential practice of the Muslim religion to get Allah's affection and happiness. As people of Birmingham speak English, therefore, it's partly challenging to learn Arabic from basic. But you don't need to worry because our Quran teachers can speak English fluently. Usually, kids learn these courses. We provide highly qualified female Quran teachers to a single student in one on one Quran class online in Birmingham. Come and join us!";
    $c1h = ' Quran Memorization';
    $c1 = "Quran Memorization is an act of remembering the whole Quran classified into 114 Surah, 6666 verses. Every Muslim parent desires their kids to memorize Quran, but foreign countries like Birmingham don't have nearby Madrassas. But now you can meet with Hafiz-e-Quran male and female Quran teacher near me for teaching this course. We use different Avenues and worksheets to achieve the best results for our students at the end of the course.";
    $c2h = 'Tajweed Quran';
    $c2 = "Tajweed-Ul-Quran means to read Quran with proficiency. A significant mistake made by people that they don't read Quran with Tajweed rules. Any single mistake in the Quran reading can become the cause of Allah's anger. Anyone who wants to improve his Quran recitation then joins our Birmingham Tajweed classes. We have highly qualified Quran teachers who will enable you and your kids to read Quran with the correct pronunciation.";
    $c3h = 'Our Quran teachers';
    $c3 = "Our Quran teachers include Hafiz-e-Quran, Tajweed-Ul-Quran, and Nazra-e-Quran teachers. They all graduated in Quran teachings from certified Madrassas and have experience teaching the Quran online. As people in Birmingham speak English, therefore, we have teachers who can converse in English fluently.
You don't need to worry about any complications; instead, our Quran teachers are very cooperative. They always hear and resolve student's issues sincerely. As a result, our students always show 100% results in exams and enlighten the name of Birmingham Quran Academy.
";
    $r1h = 'Any device, any tool ';
    $r1 = 'You can access Birmingham Quran classes from anywhere in the world. You can take our live Quran classes on any device like laptop, mobile, and tablet. We have used handy tools to make it easily accessible for people, especially for kids.';
    $r2h = 'Month-on-month classes';
    $r2 = "Some needy people in Birmingham can't afford yearly fee plans for learning Quran online. That's why we let our students get register from month to month. Don't miss out on this opportunity! Join month to  month Birmingham Quran classes online";
    $r3h = 'Interactive classes ';
    $r3 = "No doubt, our Quran classes are interactive with 100% coaching for your kids. Don't worry about any complications. It's a straightforward and easy way to take our Quran classes. You need to create an account on Skype or Zoom. The teacher will create a meeting to deliver a lecture and listen to Quran lessons on audio or video call. ";
    $r4h = ' Free trial classes';
    $r4 = 'You can check out our procedure of Birmingham Quran classes because we allow you to take free trial classes for three days. In these three days, you will learn from a single Quran teacher online. If you satisfy, then you can proceed further.';
    $r5h = 'One-on-one classes ';
    $r5 = 'One-on-one classes are specially designed for those students who are either shy or hesitate to study with over-age/lower-age mates. Now, they can learn alone with a single Quran teacher on live Skype or Zoom meeting.';
    $r6h = 'Certified Quran teacher';
    $r6 = 'Alhamdulillah, we are blessed with professional Quran teachers who know the value of teaching the Quran. They are all certified and hold degrees in Islamic education. Our Birmingham online Quran teachers include Hafiz, Qari, and Tajweed Al Quran teachers.';
    $faqs = [
      [
        'question' => 'Is there an age limit to join Birmingham Quran classes online? ',
        'answer' => "No, there's no age limit for registration in our Quran classes. Instead, kids, adults, and old gents & ladies can learn Quran from Birmingham Quran Academy online. We have a single Quran teacher near me for every person ",
      ],
      [
        'question' => 'Can I replace the Birmingham Quran teacher?',
        'answer' => "Yes, we let you change your Quran teacher if you're not satisfied with him/her. If you have any issue understanding your current Quran teacher, then discuss the Birmingham Quran Academy instructors; we will replace your teacher with another Quran online. ",
      ],
      [
        'question' => 'How can I enroll in Birmingham Quran classes?',
        'answer' => "There\'s a straightforward method for Registration in Quran classes online. Scroll down the page. You will find a button named \"Take free trial classes.\" Click on it. You will see a contact form. Write your full name, email, phone number, or message (optional), and submit this contact form by pressing the button below. After that, you need to wait for one day. Our chatting agent will contact you to guide you further.",
      ],
      [
        'question' => 'How long will it take to complete Birmingham Quran lessons online?',
        'answer' => "Duration depends on the efforts and punctuality of students. Usually, our kids complete Quran reading in almost two years or more. Tajweed Classes need practice having three levels. Quran Memorization takes almost three or more years. But you don't need to register for an extended period; instead, you can choose our monthly pricing plans.",
      ],
      [
        'question' => 'Is you give any relief in fee for learning Quran online?',
        'answer' => "We've already set a very reasonable pricing plan that an ordinary person in Birmingham can afford. You'll find the world's best Quran tutors at a meager cost at Birmingham Quran Academy online. Besides, we are giving you a month-to-month Registration option for your ease.",
      ],
    ];

    $meta = 'Online Quran classes in birmingham , Quran learning in birmingham , Quran recitation in birmingham , Quran teacher in birmingham , Quran in birmingham , birmingham  reading Quran';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function blackburnlocation()
  {
    $title = 'Best Online Quran Teachers In blackburn';
    $hero = 'Best Online Quran Teachers In blackburn';
    $schema = '<script type="application/ld+json">
     {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Blackburn, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Blackburn",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>    
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Blackburn",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-blackburn"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
            {
                       "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [{
                "@type": "Question",
                "name": "How can I register at Blackburn Quran Academy?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "It is effortless to register in our Blackburn online Quran classes. Scroll down, select a course of your choice, click on \"Take a free trial,\" and fill a contact form, including your full name, email, and phone number. You have to fill out this form and submit it. It would help you wait for 24 hours because our instructor will call you within 24 hours to guide you about following the procedure."
                }
              },{
                "@type": "Question",
                "name": "What prerequisites are required for taking Blackburn Quran classes online?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "The things needed for taking Quran classes are not complicated; instead, you must have a device like a laptop or mobile on which you\'ll take Blackburn Quran classes online. Besides, it would be best for communication if you\'ll have good speakers and microphones. After that, you need to sign on to Zoom/Skype for starting live class."
                }
              },{
                "@type": "Question",
                "name": "Is parents get reported about their kid\'s performance during Quran class?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes, all parents are get reported about their children\'s performance during Quran class by Quran teachers. Quran teachers always inform you every month for your analysis. These criteria of Blackburn Quran Academy will help you to know about your kid\'s progress with time."
                }
              },{
                "@type": "Question",
                "name": "Is it necessary to submit the fee for once time for the whole course?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Not at all; if you can not afford the yearly fee, then don\'t worry! You can submit the course fee from month to month. Our monthly pricing plan is very reasonable; every average person can afford that. We don\'t bound you to submit a few for an extended period."
                }
              },{
                "@type": "Question",
                "name": "Is there a female Islamic teacher available for teaching girls?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes, we know that females hesitate in learning from male online Quran teachers; therefore, we have arranged a highly qualified and well-versed female Quran tutor near me. Our female staff is very cooperative and helps our students to resolve every matter during Blackburn Quran classes online"
                }
              }]
            }
            
            
            
            
            

            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Blackburn, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Do you want to learn Quran online in Blackburn with the best Quran teacher near me? If you're going to learn Quran online without going to any local Madrassas or Quran centers, then don't worry! You've come to the right place because we are one of the best leading Quranic sites that offer interactive Quran learning through our online Quran classes in Blackburn.<br>
Alhamdulillah, many students have been learned Quran online and got certified by our site. Moreover, they always leave a positive review about our online Quran classes and our Islamic teachers. We've used different handy tools for types to provide easy access to kids & adults. If you want to learn Quran accurately, then we recommend you to join Blackburn Quran Academy. 
";
    $p2h = 'Our Quran teachers';
    $p2 = "We are honored to have highly qualified Quran teachers who struggle to achieve their students' excellent results. They are not only certified but also proficient in teaching Quran online. We provide a single Islamic teacher to a single student in a one-on-one class to avoid interruption. We've both male and female Quran teachers for teaching Quran to boys and girls.<br>
Our tutors include Hafiz-e-Quran, Qari-e-Quran, and Tajweed-e-Quran teachers. They are well trained in using different tools for accompanying Quran classes online without any problem to avoid wastage of time. Besides, their teaching method is so dramatic that none of the students will be dissatisfied with them. As a result, our students always show cent percent result in Quran study.
";
    $c1h = 'Quran Reading';
    $c1 = "Reading Quran is the primary obligation of all Muslims in the Islamic religion. Holy Quran is the sacred book of Allah that is present in the Arabic language. In Blackburn, people don't speak Arabic; instead, they speak English. Therefore, they need to learn Arabic, and we have the best English-speaking Islamic teachers for teaching this course. If you want your kids to learn Quran accurately then join our Blackburn Quran classes online. ";
    $c2h = 'Quran Memorization';
    $c2 = "Hifz-e-Quran is the most effective practice of memorizing the Quran performed by Muslims to get Allah's bliss in the world and hereafter. This course at Blackburn Quran Academy is about three or more years because students have to memorize 114 Surahs classified into 6666 verses. We need attention and regularity of children during Quran classes online. If you want to memorize Quran by learning with an Islamic teacher, then join us.";
    $c3h = 'Quran Tajweed';
    $c3 = "Tajweed-Al-Quran is improving and proficiency of words with Arabic accent during Quran reading. It\'s essential to learn Tajweed Quran because Allah commanded us to reduce Quran in a pleasant way and tone. Hence, we\'ve arranged a specialized Tajweed Quran teacher for teaching this Quran lesson. If you are honest with the Islamic religion, then read Quran accurately and don\'t miss out on the opportunity to join our online Blackburn Tajweed classes.";
    $r1h = 'Monthly classes';
    $r1 = "At Blackburn Quran Academy, you'll get monthly pricing plans for learning Quran online. We've designed month-to-month Quran classes online because some needy people can't afford year to year fee for learning Quran online in Blackburn.";
    $r2h = 'Interactive classes';
    $r2 = "Our online  Quran classes are interactive and easily accessible for everyone from anywhere. We've utilized many different developed and conventional tools for making our Blackburn Quran classes immersing. As a result, our students always show optimistic results in the end.";
    $r3h = 'One-on-one classes ';
    $r3 = "One-on-one classes are developed for few reluctant to learn and other people due to their age variation or uneasiness. Now you'll get one one one Quran classes at Blackburn online Quran Academy in which a single Islamic teacher will teach a single learner. ";
    $r4h = ' Certified Quran teachers';
    $r4 = 'At Blackburn online Quran tuition, all Quran teachers are certified and certified from Quran Madrassas. If you want to learn Quran with attested and professional Quran teachers near me, you must join our Quran classes online. ';
    $r5h = 'Female Quran teacherss ';
    $r5 = "Highly qualified and professional female Quran teachers are also available for those girls who don't prefer to learn from male Quran teachers. Now, our Islamic sisters can learn Quran online in Blackburn with a female Quran tutor near me. ";
    $r6h = 'Schedule Flexibility';
    $r6 = "We allow our newcomers to take our trial classes for three days. These trial Quran classes online are free of cost to check our process of instructing Quran classes online in Blackburn. We are sure that you'll impress with our interactive learning as well as Islamic teachers. ";
    $faqs = [
      [
        'question' => " What's the procedure for getting enrolled in Blackburn Quran classes online?",
        'answer' => "It's effortless to register here! Just scroll down to click on the section named \"Take free trial Classes\" After that, you'll find a contact form on the next page. Fill in appropriately with your name and contact information. Click on the submit button. Please wait for 24 hours; our representative will contact you within one day for another guide.",
      ],
      [
        'question' => ' What prerequisites are required for taking Blackburn Quran classes online? ',
        'answer' => "The things needed for taking Quran classes are not complicated; instead, you must have a device like a laptop or mobile on which you'll take Blackburn Quran classes online. Besides, it would be best for communication if you'll have good speakers and microphones. After that, you need to sign on to Zoom/Skype for starting live class.",
      ],

      [
        'question' => "Is parents get reported about their kid's performance during Quran class? ",
        'answer' => "Yes, all parents are get reported about their children's performance during Quran class by Quran teachers. Quran teachers always inform you every month for your analysis. These criteria of Blackburn Quran Academy will help you to know about your kid's progress with time.",
      ],
      [
        'question' => 'Is it necessary to submit the fee for once time for the whole course? ',
        'answer' => 'Yes, we know that females hesitate in learning from male online Quran teachers; therefore, we have arranged a highly qualified and well-versed female Quran tutor near me. Our female staff is very cooperative and helps our students to resolve every matter during Blackburn Quran classes online',
      ],

    ];

    $meta = 'Online Quran classes in Blackburn , Quran learning in Blackburn , Quran recitation in Blackburn , Quran teacher in Blackburn , Quran in Blackburn , Blackburn  reading Quran, Quran in Blackburn ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function glasgowlocation()
  {
    $title = 'Best Online Quran Teachers In Glasgow';
    $hero = 'Best Online Quran Teachers In Glasgow';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Glasgow, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Glasgow",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>   
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Glasgow",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-glasgow"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "What\'s the procedure for getting enrolled in Glasgow Quran classes online?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "It\'s effortless to register here! Just scroll down to click on the section named \"Take free trial Classes\" After that, you\'ll find a contact form on the next page. Fill in appropriately with your name and contact information. Click on the submit button. Please wait for 24 hours; our representative will contact you within one day for another guide."
    }
  },{
    "@type": "Question",
    "name": "Why Glasgow Quran tutors are better than others?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Our Quran teachers online are very professionals and cooperative. They are not only certified but also experienced in teaching Quran online to 1000+ students. The communication skills of Glasgow Quran teachers online are awe-inspiring. They are highly appreciated by more than one thousand students who have learned Quran online from them."
    }
  },{
    "@type": "Question",
    "name": "What\'s the age limit of taking Glasgow Quran classes?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "There\'s no age limit for Registration in Glasgow Quran academy for learning Quran online. Everyone, including kids, adults, older men, and women, can learn Quran online from us because we give one-on-one Quran classes to every student to learn the Quran online in a peaceful environment."
    }
  },{
    "@type": "Question",
    "name": "Is there any female Quran teacher near me available for girls?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, a female Quran teacher is available for girls and ladies. We understand that our Islamic sisters hesitate to learn Quran online from a male Quran teacher near me. Therefore we\'ve arranged for the best and experienced female Quran teacher online in Glasgow."
    }
  },{
    "@type": "Question",
    "name": "What are the requirements for learning Quran online in Glasgow?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Requirements for learning Quran online are minor that every ordinary person can afford. Students should have a laptop/tablet/mobile along with a broadband internet connection. And, they should have speakers and microphones for good communication. Besides, they all have to create an account on Zoom or Skype to take Glasgow Quran classes online."
    }
  }]
}
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Glasgow, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Holy Quran recitation is the essential part of the Muslim's religion for getting fame and success in the world and hereafter. Muslims living in Glasgow are very desirable to learn Quran but have very rare Quran Madrassas nearby. They face different problems like COVID-19 lockdown, due to which they can't go out of the home to learn Quran from a local Quran teacher. But don't worry!<br>
        You can learn Quran online in Glasgow without going to any far-off Madrassas. Instead, you need to have a good internet connection on your mobile, laptop, or another device. It has become effortless to learn Quran online because we've used such handy tools for making our Classes easily accessible to you and your kids. 
";
    $p2h = 'Our Quran teachers';
    $p2 = "If we talk about our Quranic staff, no one can compare us with Glasgow Quran teachers online. They are not only teaching Quran professionally but also very cooperative and communicate very well with everyone. Their methods of teaching are so unique that students will never be dissatisfied with them. 
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>Our male Quran teachers online in Glasgow include Hafiz-e-Quran, Nazra-e-Quran, and Tajweed-Ul-Quran teachers. They are all graduated and experienced in Quran teaching online. Don't worry about communication during Quran classes because they can speak English, Urdu, and Arabic fluently.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>In addition to male Quran teachers, we are also blessed with female Quran teachers from different countries for Islamic sisters. They are also certified and hold degrees in Quranic study and other Islamic teachings. Their communication skills are very well that students will learn Quran in a friendly environment instead of getting bored with learning during class.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "Quran reading is an obligation of all Muslims commanded by Allah. Muslims learn Quran in their childhood; therefore, this course is usually learned by children. In Glasgow, local Madrassas are far off from people's homes. They can't send their kids alone there. That's why they prefer online sites for Quran reading courses. If you're looking for the perfect Glasgow Quran Academy online, then join us!";
    $c2h = 'Quran Memorization';
    $c2 = "Hifz-e-Quran course is another act of Muslim's religion for getting the mercy of Allah. Parents desire their kids to remember the whole Quran for getting fame in the world and hereafter. So, if you're looking for an experienced and qualified Hafiz-e-Quran teacher near me, then you've come to the perfect place! You can join our Quran Memorization classes online in Glasgow.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "Tajweed is an Arabic word that is derived from Jawadda, which means accuracy and proficiency. Tajweed-Ul-Quran means to read Quran with a pleased and accurate tonne. People learn Nazra-e-Quran and read Quran in a simple tone without application of Tajweed rules. But it's essential to improve your Nazra-e-Quran. If you're looking for the best Glasgow Quran school online to improve your Quran recitation, then join our Glasgow Tajweed classes! ";
    $r1h = 'Any device, any tool ';
    $r1 = 'You can access Birmingham Quran classes from anywhere in the world. You can take our live Quran classes on any device like laptop, mobile, and tablet. We have used handy tools to make it easily accessible for people, especially for kids.';
    $r2h = 'Month-on-month classes';
    $r2 = "First of all, the benefit is that we allow you to choose a monthly pricing plan for taking our Quran classes. Because we are requested from many needy people who can't afford the yearly fee for learning Quran online in Glasgow, that's why we are providing our students with month-to-month Quran classes";
    $r3h = 'Interactive Quran classes ';
    $r3 = "Our method of teaching the Quran is so unique that we provide each facility to our students for better learning Quran online. We used advanced technology but easily accessible for everyone, especially kids. We've made learning the Quran easy through our interactive Glasgow Quran classes online for kids and adults.";
    $r4h = ' One-on-one classes';
    $r4 = "In Glasgow local Quran Madrassas, it's traditional to learn Quran combined with more than twenty students in one class, but it may lead to less attention to a specific student. Some students remain devoid of getting proper attention during Quran class. That's why we choose a one-on-one class strategy for a better understanding of students.";
    $r5h = 'Free trial classes ';
    $r5 = 'Some students are confused about the process of Glasgow Quran classes online. To overcome this matter, we let them take free trial classes for three days. If you are satisfied with our performance in three days, you can learn Quran online.';
    $r6h = 'Female Quran teacher';
    $r6 = "Glasgow Quran Academy online also have female Quran teacher for teaching Quran to kids and Islamic sisters. Some girls prefer to learn from female Quran teachers near me. Therefore, we arranged the world's best and experienced Quran teachers online.";
    $faqs = [
      [
        'question' => " What's the procedure for getting enrolled in Glasgow Quran classes online?",
        'answer' => "It's effortless to register here! Just scroll down to click on the section named \"Take free trial Classes\" After that, you'll find a contact form on the next page. Fill in appropriately with your name and contact information. Click on the submit button. Please wait for 24 hours; our representative will contact you within one day for another guide.",
      ],
      [
        'question' => 'Why Glasgow Quran tutors are better than others?',
        'answer' => 'Our Quran teachers online are very professionals and cooperative. They are not only certified but also experienced in teaching Quran online to 1000+ students. The communication skills of Glasgow Quran teachers online are awe-inspiring. They are highly appreciated by more than one thousand students who have learned Quran online from them.  ',
      ],

      [
        'question' => "What's the age limit of taking Glasgow Quran classes?",
        'answer' => "There's no age limit for Registration in Glasgow Quran academy for learning Quran online. Everyone, including kids, adults, older men, and women, can learn Quran online from us because we give one-on-one Quran classes to every student to learn the Quran online in a peaceful environment.",
      ],
      [
        'question' => 'Is there any female Quran teacher near me available for girls? ',
        'answer' => "Yes, a female Quran teacher is available for girls and ladies. We understand that our Islamic sisters hesitate to learn Quran online from a male Quran teacher near me. Therefore we've arranged for the best and experienced female Quran teacher online in Glasgow. ",
      ],
      [
        'question' => 'What are the requirements for learning Quran online in Glasgow? ',
        'answer' => 'Requirements for learning Quran online are minor that every ordinary person can afford. Students should have a laptop/tablet/mobile along with a broadband internet connection. And, they should have speakers and microphones for good communication. Besides, they all have to create an account on Zoom or Skype to take Glasgow Quran classes online.',
      ],
    ];

    $meta = 'Online Quran classes in Glasgow , Quran learning in Glasgow , Quran recitation in Glasgow , Quran teacher in Glasgow , Quran in Glasgow , Glasgow  reading Quran, Quran in Glasgow ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function newcastlelocation()
  {
    $title = 'Best Online Quran Teachers In Newcastle';
    $hero = 'Best Online Quran Teachers In Newcastle';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Newcastle, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Newcastle",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>  
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Newcastle",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-newcastle"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
              "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [{
                "@type": "Question",
                "name": "What is the timing for taking Newcastle Quran classes online?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "There\'s not any specific timing fixed for Quran classes online by our instructors. Rather, you can select timing by yourself by considering your availability for taking Quran class easily. You need to discuss with your teacher and decide that time suitable for both of you."
                }
              },{
                "@type": "Question",
                "name": "How can we register in Newcastle Quran classes?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "You can register easily in our Newcastle Quran classes by following the steps. Select the Quran course of your choice and take a free trial class. You need to fill contact form by providing your name, email, and mobile number. You can also write any message(if necessary) and send it. After sending, you have to wait. One of our instructors will contact you to inform you about the next process."
                }
              },{
                "@type": "Question",
                "name": "Why Newcastle online Quran Academy is better than other Madrassas?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Our Quran Academy online has become one of the best Quran academies because we are giving some extra services compared to other Quran Madrassas. For example, we give our students the best Islamic teachers in one-on-one classes for interactive learning. Besides, our pricing plans are so reasonable that everyone can afford to live in Newcastle."
                }
              },{
                "@type": "Question",
                "name": "Is there any age limit for joining Quran classes online in Newcastle?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Not at all; there\'s no age limit for enrollment in our Quran classes online. Everyone, either kids or adults, can learn Quran online from here. Besides, old-aged ladies and gents can also learn Quran without hesitation because we provide one-on-one Quran classes with a single Quran teacher near me for our students."
                }
              },{
                "@type": "Question",
                "name": "What is the duration of completing the whole Quran reading?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "There\'s no fixed duration for Quran lessons to complete because it normally depends on the efforts and output of students. Usually, kids learn Quran for almost two years regularly. Tajweed Quran needs practice classified into three levels. Hifz-e-Quran takes more than three years for remembrance of the complete Quran."
                }
              }]
            }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Newcastle, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Holy Quran is the sacred book of Allah revealed on Hazrat Muhammad (PBUH), having guidance, advice, and information for all Muslims till the last day. Quran recitation is a part of the Islamic religion commanded by Allah. There are many Muslims who live in Newcastle but don't have Quran Madrassas nearby. If they want to learn Quran, they can join our Quran classes online without going anywhere.<br>
We have been working as the best online Quran tuition online in Newcastle since 2010. About more than 25 expertise Quran teachers are available for teaching Quran online professionally. Alhamdulilah, 1000+ students got certified with A+ grades in Quran lessons online from our platform. If you are also looking for such an affordable but perfect Quran school for your kids, don't miss out on joining our Quran classes.
";
    $p2h = 'Our Islamic teachers';
    $p2 = "There's a lot of blessing of Allah on us that we have the world's best Quran teachers for spreading the light of Islam. Our Quran teachers are not only graduated but also have teaching experience in Quran lessons online. Our students show 100% results because of their dedicated and sincere efforts. We've male Quran teachers for boys and female Quran teachers for girls.<br>
<h3 class='text-skin'>Male Quran teachers </h3>
<p class='text-white'>Our Quran teachers include Hafiz, Tajweed, and Nazra Quran teachers online. The way they teach is so amazing that every student got good grades in the final exams. They teach professionally along with the best communication skills during Quran class. All Islamic teachers are well aware of using online teaching tools for efficient and uninterrupted learning.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>Our Female staff is very cooperative and teaches in a friendly environment to your kids. We specially organized a female Quran tutor near me for girls and ladies. Because some girls don't prefer learning from male Quran teachers online in Newcastle, don't worry about conversational language because our Quran teachers can speak English fluently. </p>
";
    $c1h = 'Quran Reading';
    $c1 = "Reading Quran is the basic responsibility of all Muslims to get fame and success in the world and hereafter. People whose native language is not Arabic such as the people of Newcastle, need to learn the Quran. Muslims learn Quran in childhood, but there's the problem of going out of kids from their home to far off Madrassas. Hence, many parents prefer online Quran learning for their kids. If you want effective and interactive Quran learning online in your own home, then join us!";
    $c2h = 'Quran Memorization';
    $c2 = "Quran remembrance is a significant act of Islamic religion. Muslims living in Newcastle wish to memorize Quran online but need the best Hafiz-e-Quran teacher near me for effective results. You don't need to worry about our platform because we have the most leading and professional Quran teachers teaching Quran memorization courses. We design Quran lessons whole Quran, including 30 surahs) in such a way that it can easily complete in almost three years.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "Tajweed-Al-Quran indicates to read Quran with precision and accuracy. If you want to improve your Quran recitation, then join our Newcastle Tajweed classes. Our Quran classes are interactive, along with the world's best Tajweed teachers online in Newcastle. This course normally needs practice. Therefore, we've arranged a pdf exercise worksheet for better practice for our students. As a result, our students can read the Quran with Tajweed rules at the end of the course.";
    $r1h = 'Interactive classes ';
    $r1 = "One of the benefits of learning the Quran from Newcastle Quran academy online is that you'll get interactive learning along with the best Quran teachers. We've used both advanced and conventional tools for making our Quran classes interactive.";
    $r2h = 'Certified Quran teachers';
    $r2 = 'All Quran teachers of our platform are certified and well-educated in Islamic teaching. They are not only certified but also have professional experience in online Quran teaching. Their teaching strategy is so impressive to keep our students engaged with continuous learning.';
    $r3h = 'Female Quran teachers ';
    $r3 = 'The good news for our Islamic sisters and ladies living in Newcastle is that they can learn Quran with a female Quran teacher near me. Because girls usually hesitate to learn Quran from male Quran teacher near me.';
    $r4h = 'Monthly classes ';
    $r4 = "Monthly Quran classes are particularly constructed for those people who are needy and face economic poem in Newcastle. Now, they don't need to register for the whole course or yearly; instead, they can register in our month-to-month Quran classes online in Newcastle.";
    $r5h = 'One on one class';
    $r5 = "Some old ladies and gents feel awkward in learning with other students due to their age difference, but they don't need to worry because we've come up with one-on-one Quran classes online in your city named Newcastle. In one-on-one classes, a single teacher will teach you.";
    $r6h = 'Free trial classes';
    $r6 = "It's necessary to check out the criteria of every Quran Academy. Still, some Quran Madrassas get payments before classes without any guarantee, but our Newcastle Quran classes online give you a chance to check out first then decide to join our classes. Yes! We give you three days of free trial classes for your satisfaction.";
    $faqs = [
      [
        'question' => 'What is the timing for taking Newcastle Quran classes online?',
        'answer' => "There's not any specific timing fixed for Quran classes online by our instructors. Rather, you can select timing by yourself by considering your availability for taking Quran class easily. You need to discuss with your teacher and decide that time suitable for both of you. ",
      ],
      [
        'question' => 'How can we register in Newcastle Quran classes? ',
        'answer' => 'You can register easily in our Newcastle Quran classes by following the steps. Select the Quran course of your choice and take a free trial class. You need to fill contact form by providing your name, email, and mobile number. You can also write any message(if necessary) and send it. After sending, you have to wait. One of our instructors will contact you to inform you about the next process. ',
      ],

      [
        'question' => 'Why Newcastle online Quran Academy is better than other Madrassas?',
        'answer' => 'Our Quran Academy online has become one of the best Quran academies because we are giving some extra services compared to other Quran Madrassas. For example, we give our students the best Islamic teachers in one-on-one classes for interactive learning. Besides, our pricing plans are so reasonable that everyone can afford to live in Newcastle.',
      ],
      [
        'question' => 'Is there any age limit for joining Quran classes online in Newcastle?',
        'answer' => "Not at all; there's no age limit for enrollment in our Quran classes online. Everyone, either kids or adults, can learn Quran online from here. Besides, old-aged ladies and gents can also learn Quran without hesitation because we provide one-on-one Quran classes with a single Quran teacher near me for our students.",
      ],
      [
        'question' => 'What is the duration of completing the whole Quran reading?',
        'answer' => "There's no fixed duration for Quran lessons to complete because it normally depends on the efforts and output of students. Usually, kids learn Quran for almost two years regularly. Tajweed Quran needs practice classified into three levels. Hifz-e-Quran takes more than three years for remembrance of the complete Quran.",
      ],
    ];

    $meta = 'Online Quran classes in Newcastle , Quran learning in Newcastle , Quran recitation in Newcastle , Quran teacher in Newcastle , Quran in Newcastle , Newcastle  reading Quran, Quran in Newcastle ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function bradfordlocation()
  {
    $title = 'Best Online Quran Teachers In Bradford';
    $hero = 'Best Online Quran Teachers In Bradford';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Bradford, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Breadford",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Breadford",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-breadford"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
              "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [{
                "@type": "Question",
                "name": "What is the timing for taking Bradford Quran classes online?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "There\'s not any specific timing fixed for Quran classes online by our instructors. Rather, you can select timing by yourself by considering your availability for taking Quran class easily. You need to discuss with your teacher and decide that time suitable for both of you."
                }
              },{
                "@type": "Question",
                "name": "How can we register in Bradford Quran classes?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "You can register easily in our Bradford Quran classes by following the steps. Select the Quran course of your choice and take a free trial class. You need to fill contact form by providing your name, email, and mobile number. You can also write any message(if necessary) and send it. After sending, you have to wait. One of our instructors will contact you to inform you about the next process."
                }
              },{
                "@type": "Question",
                "name": "Why Bradford online Quran Academy is better than other Madrassas?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Our Quran Academy online has become one of the best Quran academies because we are giving some extra services compared to other Quran Madrassas. For example, we give our students the best Islamic teachers in one-on-one classes for interactive learning. Besides, our pricing plans are so reasonable that everyone can afford to live in Bradford."
                }
              },{
                "@type": "Question",
                "name": "Is there any age limit for joining Quran classes online in Bradford?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Not at all; there\'s no age limit for enrollment in our Quran classes online. Everyone, either kids or adults, can learn Quran online from here. Besides, old-aged ladies and gents can also learn Quran without hesitation because we provide one-on-one Quran classes with a single Quran teacher near me for our students."
                }
              },{
                "@type": "Question",
                "name": "What is the duration of completing the whole Quran reading?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "There\'s no fixed duration for Quran lessons to complete because it normally depends on the efforts and output of students. Usually, kids learn Quran for almost two years regularly. Tajweed Quran needs practice classified into three levels. Hifz-e-Quran takes more than three years for remembrance of the complete Quran."
                }
              }]
            }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Bradford, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Holy Quran is the sacred book gifted from Allah for all Muslims. This book has guidance, advice, and solution to problems and suggestions for all Muslims in the world. Hence, it's obligatory to learn and recite Quran with the correct pronunciation. So, every Muslim parent desire to see their kids learn Quran in their childhood. If you're looking for Quran teacher near me, then stay here!
            In Bradford, Quranic centers and Madrassas are very far, and it has become challenging to go out of home because they are busy with their jobs or COVID-19 lockdown. A piece of excellent news for those who live in Bradford and want to learn the Quran is that we offer online Quran classes at home at very reasonable prices. Come and join us! 
            ";
    $p2h = 'Our Quran Teachers ';
    $p2 = "Alhamdulilah, we have organized the +25 best online Bradford Quran teachers from different countries who hold degrees in Islamic education and Quran teachings. Every Islamic teacher has experience teaching the Quran online to 500+ students. Their teaching strategy is so impressive that students become connected with learning until the end of the session. Our Quran teachers include Hifz-e-Quran, Qari-e-Quran, and Tajweed Quran teachers.
            <h3 class='text-skin'>Female Quran teacher</h3> 
            <p class='text-white'>Some Islamic sisters hesitate to learn from male Quran teachers. Therefore we've organized female Quran teachers who are very communal and cooperative. You don't need to worry about language for conversation; our teachers can speak English, Urdu, and Arabic. Now girls can learn Quran online from female Quran teacher near me.</p>";
    $c1h = 'Quran Reading';
    $c1 = 'Quran Reading is the fundamental duty of a Muslim to get love from Allah. Therefore, every parent desire to learn Quran in their childhood, but people who live in Bradford face the problem of far off Madrassas. Now, People who live in Bradford can learn Quran from our site named online Quran tuition. We provide one on one Quran classes with certified male and female Quran teacher.';
    $c2h = 'Quran Memorization';
    $c2 = "Quran Memorization is an act of learning the Quran by heart with complete devotion and dedication. In this course, students have to know the whole Quran classified into 30 Surahs. If you're looking for female Quran teacher near me, then join us! Our Hifz e Quran teachers teach so that students will never forget the entire Quran till the end. We provide each facility to our students for better learning. Besides, we give the students pdf exercise worksheets for practice.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "Tajweed Al Quran means to read Quran with the correct pronunciation. The primary mistake made by Muslims is to read Quran with a simple tone/without application of Tajweed rules, but it creates a false sense in the meaning of the word. Therefore, it's necessary to learn Quran Tajweed and recite accurately. We are offering Tajweed-Al-Quran courses online for you and your kids. We provide interactive Quran Tajweed classes along with certified Quran teachers for teaching Quran.";
    $r1h = 'Free trial classes';
    $r1 = "If you are confused about our online Quran classes Bradford, then don't worry! We are offering three days trial classes for free to check out our process of Quran teaching. If you feel satisfied, then you can proceed with your regular session.";
    $r2h = 'Monthly classes';
    $r2 = "You don't need to register for1 a year or a more extended time. Instead, our site allows you to join our online Quran class from month to month. After one month, you need to register and submit your monthly fee again.";
    $r3h = 'Interactive classes ';
    $r3 = "We have used both ancient and advanced tools for making learning easy and helpful for our students. Our Quran classes Bradford are of high quality without any interruption in learning Quran. Whether you are a beginner, but you'll learn from basic concepts to advanced ones from our site.";
    $r4h = ' Easily accessible ';
    $r4 = 'Our Quran classes are easily accessible from anywhere. You can take our Quran Tajweed classes on every device, mobile, laptop, or tablet. Besides, you can record your Quran lessons and can listen to them after lectures at any time.';
    $r5h = 'Certified Quran teachers ';
    $r5 = 'We have more than twenty-five male and female Quran teachers who teach Quran with complete dedication. They struggle their best to explain minor concepts related to Quran teaching. The way they teach is awe-inspiring and engaging.';
    $r6h = 'Female Quran teachers';
    $r6 = 'In addition to male Quran tutors, we have also organized female Quran teachers for teaching girls and ladies. We are blessed with those Bradford Quran teachers who burn their midnight oil to show the best results of their Quran classes.';
    $faqs = [
      [
        'question' => 'What are the benefits of learning Bradford Quran classes? ',
        'answer' => 'We are the one of the most leading Quran Madrassas that offers three Quran courses at a very reasonable price without taking any registration fee. Moreover, you will learn from highly qualified and certified Bradford Quran teachers from here. Besides, we give schedule flexibility, 24/7 availability, monthly fee charges, along with three days free trial.',
      ],
      [
        'question' => 'Is it possible to replace the Quran tutor? ',
        'answer' => "Yes, it's possible! If you're not satisfied with our online Quran teacher near me, then inform our instructor. We will surely listen to your matters and replace that teacher with your recommended Quran teacher. ",
      ],

      [
        'question' => 'Can I change the timing of Bradford Quran classes?',
        'answer' => 'Yes, you can change the timing because we provide you with one on one Bradford Quran classes online; you can select the timing according to your availability. You need to discuss with your Quran teacher and decide the time suitable for both of you. ',
      ],
      [
        'question' => 'What are the requirements for taking the class?',
        'answer' => "It's straightforward to take an online Quran Tajweed classes on our platform. You need to arrange a device like a computer, laptop, tablet, or mobile on which you'll take your Quran class. Besides, you must have a good internet connection along with microphones for better communication during Quran class. ",
      ],
      [
        'question' => 'What is the procedure of taking a Bradford Quran classes?',
        'answer' => "The Quran teacher will call you either audio or video on Zoom/Skype at your selected time. You'll receive that call to start your lecture. The teacher will discuss, share, or listens to the previous lesson in the first fifteen minutes. After that, he/she will deliver the following speech and share a digital book on the screen that both student and teacher can see.",
      ],
    ];

    $meta = 'Online Quran classes in Bradford , Quran learning in Bradford , Quran recitation in Bradford , Quran teacher in Bradford , Quran in Bradford , Bradford  reading Quran, Quran in Bradford ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function manchesterlocation()
  {
    $title = 'Best Online Quran Teachers In Manchester';
    $hero = 'Best Online Quran Teachers In Manchester';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Manchester, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Manchester",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script> 
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Manchester",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-manchester"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
              "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [{
                "@type": "Question",
                "name": "What is the timing for taking Manchester Quran classes online?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "There\'s not any specific timing fixed for Quran classes online by our instructors. Rather, you can select timing by yourself by considering your availability for taking Quran class easily. You need to discuss with your teacher and decide that time suitable for both of you."
                }
              },{
                "@type": "Question",
                "name": "How can we register in Manchester Quran classes?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "You can register easily in our Manchester Quran classes by following the steps. Select the Quran course of your choice and take a free trial class. You need to fill contact form by providing your name, email, and mobile number. You can also write any message(if necessary) and send it. After sending, you have to wait. One of our instructors will contact you to inform you about the next process."
                }
              },{
                "@type": "Question",
                "name": "Why Manchester online Quran Academy is better than other Madrassas?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Our Quran Academy online has become one of the best Quran academies because we are giving some extra services compared to other Quran Madrassas. For example, we give our students the best Islamic teachers in one-on-one classes for interactive learning. Besides, our pricing plans are so reasonable that everyone can afford to live in Manchester."
                }
              },{
                "@type": "Question",
                "name": "Is there any age limit for joining Quran classes online in Manchester?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Not at all; there\'s no age limit for enrollment in our Quran classes online. Everyone, either kids or adults, can learn Quran online from here. Besides, old-aged ladies and gents can also learn Quran without hesitation because we provide one-on-one Quran classes with a single Quran teacher near me for our students."
                }
              },{
                "@type": "Question",
                "name": "What is the duration of completing the whole Quran reading?",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "There\'s no fixed duration for Quran lessons to complete because it normally depends on the efforts and output of students. Usually, kids learn Quran for almost two years regularly. Tajweed Quran needs practice classified into three levels. Hifz-e-Quran takes more than three years for remembrance of the complete Quran."
                }
              }]
            }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Manchester, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Muslims living in Manchester desire to learn Quran, but they don't have conception or time to go out far off Madrassas. Hence, they prefer online Quran tuition in Manchester for learning or improving Quran recitation. But the question arises that which Quran website is the best for learning Quran online? Meet us! We are the best leading online Quranic website in Manchester that offers Quran classes online at a very reasonable fee.<br>
Alhamdulillah, we've successfully educated 1000+ students along with 100% grade certification. Our Quran teachers are highly expertise in Quran teaching online as well as moral training. They try their best to lighten up our student's minds with the light of the Quran. Nowadays, we have become one of the best Quran Madrassas in Manchester that offers three Quran courses online; 
";
    $p2h = 'Our Quran Teachers ';
    $p2 = "In Manchester, it's challenging to find out the best Quran teacher near me, but don't worry! We've come up with highly qualified both male and female Quran teachers online in Manchester who know the values of Quran teaching. No doubt, our Quran teachers include Hafiz-e-Quran, Qari-e-Quran, and Quran Tajweed teachers. They are all certified and expertise in teaching Quran online to kids and adults.<br>
            Besides, all teachers are well aware of Tajweed Rules. They are graduated in Islamic studies and well qualified in teaching Quran online. Moreover, all staff has an excellent grip on Arabic, English, and Urdu language. They always discern the complexities faced by students in this field. All credits go to them because our students always show 100% results due to their efforts. 
";
    $c1h = 'Quran Reading';
    $c1 = "Holy Quran is the book that was revealed on Hazrat Muhammad (PBUH) by Allah for the guidance of all Muslims. So, all Muslims' primary duty is to learn to recite the Quran with total dedication. If you want your kids to learn Quran efficiently, then get register here! We've both male and female Quran teachers for teaching this course in a peaceful environment. We assure you that your kids will learn a lot from our Quran Academy Manchester.";
    $c2h = 'Quran Memorization';
    $c2 = "Hifz-e-Quran is another act of getting a lot of Mercy from Allah. Quran remembrance requires a lot of attention and struggles of students. Besides, this course takes a long duration to remember the whole Quran. We've highly qualified Hafiz-e-Quran teachers online in Manchester to teach this course. Their method of teaching is so incredible that students never forget the entire Quran till the end. They listen to Quran lessons daily and ask students to solve practice worksheets.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "Tajweed Al. Quran implies reading Quran with the correct pronunciation. A significant mistake made by Muslims during Quran reading is that they read Quran with a modest tone. Instead, they should read Quran as Allah commanded us to read with Tajweed rules. So, if you want to improve your Quran recitation, then join Tajweed classes online in Manchester. We've experienced and well-versed Quran teachers who enable you to read Quran accurately and fluently.";
    $r1h = 'Monthly Classes';
    $r1 = "Some needy people in Manchester desire to learn Quran but can't afford the yearly fee for Quran courses. To solve this problem, we've set the monthly pricing plans for learning Quran. Now, people can take month-to-month Quran classes online in Manchester from our site.";
    $r2h = 'One-on-One classes';
    $r2 = "Some students are shy and hesitate to learn Quran along with their mates. Some aged women feel hesitant to study with kids. That's why we are offering one-on-one Quran classes for them. Every single student will learn Quran online in Manchester with a single Quran teacher for better attention.";
    $r3h = 'Interactive classes';
    $r3 = 'Our Quran classes online in Manchester are interactive because we used advanced and handy technologies for better transmission. Every student can access Quran classes from anywhere in Manchester. Besides, you can record Quran lessons online and can playback after for revision.';
    $r4h = 'Certified teachers ';
    $r4 = 'No doubt, our staff includes highly qualified Quran teachers who teach Quran online in Manchester with complete dedication. They tried their best to explain and everything about Quran lessons. Their teaching strategy is so productive that students show 100% results in exams.';
    $r5h = 'Female Quran teachers';
    $r5 = "Some girls don't like to learn Quran online from male Quran teachers. To overcome this matter, we arrange female Quran teacher near me to teach Quran online in Manchester. Now, Islamic sisters and ladies can learn Quran without any hesitation.";
    $r6h = 'Free trial classes';
    $r6 = 'If you want to check out how to teach the Quran online, we allow you to take three days of free trial classes online for students who live in Manchester. If they feel satisfied with our services, they can continue our regular Manchester Quran classes online.';
    $faqs = [
      [
        'question' => "What's the procedure of registration on Manchester online Quran classes?",
        'answer' => 'Registration in our Quran classes online is evident and precise. Select the course of your own choice and go to the free trial classes button. You will see a contact form; fill it with your name and contact information. Click the button "submit now." After that, wait for one day, you will get a response from our agent. He will guide you about how you can Quran classes online in Manchester.',
      ],
      [
        'question' => 'At which time will I take Manchester Quran classes online? ',
        'answer' => "There's no specific timing, and not already fixed by our instructors. We give our students complete schedule flexibility to take Quran classes. Students can discuss with their teachers about class timing and decide the time suitable for both student and teacher.",
      ],

      [
        'question' => 'Is online Quran Academy Manchester costly? ',
        'answer' => 'No, we are giving our students with monthly pricing plan offer. These month-to-month fee plans are so reasonable that every ordinary person can afford them. Compared to other online Quran Madrassas, we provide highly qualified teachers and interactive classes with a minimum Quran course fee. ',
      ],
      [
        'question' => 'What is the age limit for learning from us? ',
        'answer' => "There's no age limit required for learning from Manchester online Quran Academy. Kids, adults, old-aged men, and women can learn Quran online in Manchester from our platform. We have special Quran teachers for kids who teach them with 100% coaching. ",
      ],
      [
        'question' => 'What requisites are needed for taking Manchester Quran classes online?',
        'answer' => 'You should have a laptop, mobile, or tablet with a broadband Internet connection for taking online Quran classes. Also, it would help if you had an excellent speaker and microphones for good communication. Besides, you have to sign up on Skype/Zoom app to take your Quran class. ',
      ],
    ];

    $meta = 'Online Quran classes in Manchester , Quran learning in Manchester , Quran recitation in Manchester , Quran teacher in Manchester , Quran in Manchester , Manchester  reading Quran, Quran in Manchester ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function liverpoollocation()
  {
    $title = 'Best Online Quran Teachers In Liverpool';
    $hero = 'Best Online Quran Teachers In Liverpool';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Liverpool, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Liverpool",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script> 
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Liverpool",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-liverpool"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "What\'s the procedure of taking Liverpool Quran classes online?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "For taking Liverpool Quran classes, you need to have some important things, including a laptop/mobile/tablet with a broadband Internet connection, valuable speakers, and microphones for better hearing. And the most important thing is your attention and regularity."
    }
  },{
    "@type": "Question",
    "name": "Is there parents who get reported about their kid\'s performance?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes! Our Islamic teachers give monthly reports about student\'s performance during class to their parents. In this way, they will analyze their learning progress and get an idea about our services. Alhamdulillah, our students always show good results."
    }
  },{
    "@type": "Question",
    "name": "Is there any female Islamic teacher for girls?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "It has been discovered that many Islamic sisters are interrupted to learn Qur\'an from the male Quran teachers. Because they can not ask any question freely and devoid of clearing their opinions related to Quran lessons. We\'ve worked out on their issue by composing well Qualified female Quran teachers who know how to educate Quran friendly and reasonably."
    }
  },{
    "@type": "Question",
    "name": "What is the method of registration in Liverpool Quran Academy online?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "It\'s very simple to enroll in Liverpool online Quran classes. Click on \"Take free trial class.\" After finding a contact form, fill it with your avoid information and send it. Within 24 hours, our chatting agent will contact you and guide you further about taking Quran classes online."
    }
  },{
    "@type": "Question",
    "name": "Is there any fee concession possible?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "We\'ve set a very reasonable fee for learning Quran online that can be afforded by an ordinary person. Therefore, you don\'t need for fee concession. You can join our monthly pricing plans for your ease. Besides, we will give you a fee concession on the registration of third kids of the same family."
    }
  }]
}
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Liverpool, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Today's world is transformed into the world of technology. People prefer online systems for business and education. Similarly, Muslims living in Liverpool have very rare Quran Madrassas nearby. And, they can't go out to the local Quran teacher near me. Therefore, they prefer online Quran teachers in Liverpool. If you are also living in Liverpool and looking for the best Quran Academy online, then you are in the right place!<br>
We are one of the best Quran schools online in Liverpool because of our best Islamic teachers and interactive learning. In Liverpool, economic condition is normal as they can't afford the expansive fee for learning Quran online. Therefore, we provide affordable and month-to-month fee plans for people. Now, every ordinary person can learn interactive Quran learning with our best Islamic teacher in Liverpool
";
    $p2h = 'Quran Teachers';
    $p2 = "If we talk about our teachers, no one can compare them. Because they always succeed in achieving 100% results for our students. They are certified and experienced in educating Quran online to more than a thousand students. They not only teach Quran lessons but also do Islamic and moral training for you and your kids. We have both male and female Quran tutors online.
<h3 class='text-skin'>Male Quran teacher</h3>
<p class='text-white'>Our male Quran teachers are well-versed and professionals in teaching Quran online. They are not only certified but also intelligent in delivering their lecture in the best way. If you want to learn Quran with the best Quran teacher near me in Liverpool, don't miss out on meeting with our staff at our site. The way our teachers teach Quran is so influential that the lessons they teach are always remembered.</p>
<h3 class='text-skin'>Female Quran teacher</h3>
<p class='text-white'>We observe that most girls don't prefer to learn Quran from male Quran teachers. Therefore, we've arranged a female Quran teacher near me to avoid their hesitation. Now they can learn with highly qualified female Islamic teachers online in Liverpool. They teach Quran to your kids in a very friendly environment that your kids keep connected with learning regularly.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "Learn to read Quran with a precise tone on our platform as the best Quran Academy online in Liverpool. It's obligatory to learn and read Quran for all Muslims because it's the order of Allah for all Muslims in the word till the last day. In Liverpool, local Madrassas are very rare, but parents want their kids to get learning Quran. The good news for them is that their kids can learn Quran from our platform because we have the best Quran teacher with one-on-one Quran classes online in Liverpool.";
    $c2h = 'Quran Memorization';
    $c2 = "It's a great practice in Islam to learn Quran by heart. This act is the source of getting a lot of love and happiness from Allah for ourselves and our parents. Quran remembrance usually takes three or more years. Still, you'll memorize accurate and unforgettable whole Quran from here as our Islamic teachers are better than other Quran Madrassas, as proved by our student's review about our Liverpool Quran classes online. ";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "Tajweed Al Quran means reading the Quran with appropriate pronunciation, but many people learn the Quran with a simple accent. We should read Quran as commanded by Allah in Quran that \"Recite Quran in a slow, with pleasant tone and style.\" So, if you want to improve your Quran recitation, then join our Liverpool Tajweed classes online. We have got the best Quran teachers for explaining every point about Tajweed Quran and expertise in achieving students' practice by giving them to solve pdf worksheets.";
    $r1h = 'Interactive classes';
    $r1 = 'We provide interactive learning to our students for attaining good results. Our Liverpool Quran classes online are so interactive, due to which we used effective and handy tools for easy access. Both kids and adults can take our classes without any complications. ';
    $r2h = 'Best teachers ';
    $r2 = "Our Quran teachers are the world's best Islamic teachers who try their best to teach Quran effectively. They are not only certified but also experienced in tutoring Quran online. Their method of teaching the Quran is so impressive that students will never forget it till the end. ";
    $r3h = 'Female Quran teachers ';
    $r3 = 'Female Quran teacher is also available for instructing Liverpool Quran classes online. Islamic sisters and ladies ask us to learn Quran from a female Quran tutor near me because they are shy and hesitant with male Quran teachers. Now, all Islamic sisters in Liverpool can learn Quran by joining our Quran classes.';
    $r4h = 'Month to month classes';
    $r4 = "NLiverpool is a city where people face economic problems, but they wish to learn Quran. And they can't afford yearly pricing plans for learning Quran online. Therefore, we've set very reasonable prices along with month-to-month Quran classes. Now, people can register for month-to-month classes.";
    $r5h = 'One-on-one classes';
    $r5 = "Some learners don't prefer to study along with fellows or combined classes because of their age difference or shyness. Therefore, we have arranged one-on-one Quran classes online in Liverpool for effective learning. ";
    $r6h = 'Free trial classes';
    $r6 = "In today's world, it's very important to satisfy yourself before submitting payment to any site. For your satisfaction, we've organized trial classes for three days. The good news is that these three days trial classes are free for our new visitors.";
    $faqs = [
      [
        'question' => "What's the procedure of taking Liverpool Quran classes online? ",
        'answer' => 'For taking Liverpool Quran classes, you need to have some important things, including a laptop/mobile/tablet with a broadband Internet connection, valuable speakers, and microphones for better hearing. And the most important thing is your attention and regularity. ',
      ],
      [
        'question' => "Is there parents who get reported about their kid's performance? ",
        'answer' => "Yes! Our Islamic teachers give monthly reports about student's performance during class to their parents. In this way, they will analyze their learning progress and get an idea about our services. Alhamdulillah, our students always show good results.",
      ],

      [
        'question' => 'Is there any female Islamic teacher for girls?',
        'answer' => "It has been discovered that many Islamic sisters are interrupted to learn Qur'an from the male Quran teachers. Because they can not ask any question freely and devoid of clearing their opinions related to Quran lessons. We've worked out on their issue by composing well Qualified female Quran teachers who know how to educate Quran friendly and reasonably. ",
      ],
      [
        'question' => 'What is the method of registration in Liverpool Quran Academy online?',
        'answer' => "It's very simple to enroll in Liverpool online Quran classes. Click on \"Take free trial class.\" After finding a contact form, fill it with your avoid information and send it. Within 24 hours, our chatting agent will contact you and guide you further about taking Quran classes online. ",
      ],
      [
        'question' => 'Is there any fee concession possible? ',
        'answer' => "We've set a very reasonable fee for learning Quran online that can be afforded by an ordinary person. Therefore, you don't need for fee concession. You can join our monthly pricing plans for your ease. Besides, we will give you a fee concession on the registration of third kids of the same family.",
      ],
    ];

    $meta = 'Online Quran classes in Liverpool , Quran learning in Liverpool , Quran recitation in Liverpool , Quran teacher in Liverpool , Quran in Liverpool , Liverpool  reading Quran, Quran in Liverpool ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function stockportlocation()
  {
    $title = 'Best Online Quran Teachers In Stockport';
    $hero = 'Best Online Quran Teachers In Stockport';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Stockport, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in stockport",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script> 
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in stockport",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-stockport"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Does Stockport Quran Academy teach Quran physically?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "No, our Quran classes are online, which are taken by students on a computer or laptop. All books and worksheets are digital in the form of pdf. The Islamic teacher will call the student on Skype or Zoom and deliver a lecture at a specific time. The teacher listens to lesson daily online, either video or audio call."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is it necessary to take an online class on fixed timing?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "We ask our students to decide the timing of their class when they will be available and accessible for learning Quran online. Once they decide a time, they have to be online because your Quran teacher will come online on the spot. If you do not come online on time, you\'ll be responsible for missed class on your behalf."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is it possible to record live Quran classes online in Stockport?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, you can record your Quran lesson during the live class. After recording, you can playback at any time.  It will help you to listen to your lesson after the end of your online Quran class. We provide each facility to our students to make learning easy for them."
                    }
                  },{
                    "@type": "Question",
                    "name": "What things are needed to take Stockport Quran classes online?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "You need a laptop, tablet, or computer for taking Quran classes online in Stockport. Also, your internet connection must be suitable for better communication. Moreover, speakers, microphones, and your sincere attention needed during Quran class. You have to sign up on an app suggested by your Islamic teacher."
                    }
                  },{
                    "@type": "Question",
                    "name": "If I don\'t know how to use a laptop or computer, what do I do?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Suppose you are a beginner and don\'t know using computer and internet terms. Then don\'t worry!  Share this problem with our agent, and he will surely guide you about all tools and computer usage for taking your Quran class online in Stockport."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Stockport, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Holy Quran is the Book of Allah revealed on Hazrat Muhammad SAWW for all Muslims. Allah makes it obligatory to learn and read this book. If you want success in the world and hereafter, you should learn and read Quran accurately. In Stockport, it has become popular to learn Quran with an online Quran teacher near me. People don't go out of the home to Quran Madrassas for learning Quran because they are busy at their job or others.<br>
We welcome you to meet with our highly qualified Quran teachers who try their best to explain every concept about Quran lessons online. We are one of the best online Quran tuition in Stockport who provides interactive Quran learning and 100% coaching for your kids. Besides, our pricing plans for each Quran course are very reasonable, that everyone can afford these prices. Join us to get a good experience! 
";
    $p2h = 'Expert Quran teachers ';
    $p2 = 'Alhamdulillah, our Quran teachers are all professionals and aware of using IT tools for teaching online efficiently. We are blessed with +25 expert Quran teachers, including Hafiz-e-Quran, Tajweed-Al-Quran, and Nazra-e-Quran tutors. They are all certified from Quran Madrassas or Islamic centres. The way they teach is certainly outstandingly appreciated by every student.<br>
Our online Quran academy in Stockport also has a female Quran tutor and a male Quran teacher near me. Our female Quran teachers are well trained who know the importance of teaching the Quran to Muslims. They deal with every matter of students politely and effectively. Hence our students learning from them always show A+ grades in Quran study at the end of the session. 
';
    $c1h = 'Quran Reading';
    $c1 = "Holy Quran is the Book of Allah, and its reading is obligatory for all Muslims to get Allah's bliss and love. This course is about learning the basic concepts of the Arabic language, such as shapes of Arabic letters and their standard forms and how to read during the verse, and when we need to stop during Quran reading. If you want to see your kids learn and read Quran precisely, then confirm the registration of your kids in our one-on-one Quran classes online in Stockport.";
    $c2h = 'Quran Memorization';
    $c2 = 'Hifz-e-Quran is an act of memorizing the Quran with total devotion and dedication. Learning Quran by heart is the most effective practice in Islam and is the cause of becoming the crown of parents on Judgement. This course covers the remembrance of the whole Quran along with Tajweed rules. We have a special qualified Hafiz-e-Quran teacher near me for teaching this course online. If you also want to get this opportunity to become successful in the world and hereafter, then join our interactive Quran classes online in Stockport.';
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "Tajweed is an Arabic word that comes from Jawadda, which means proficiency and precision. Tajweed Al Quran means recitation of Quran with accuracy and exact pronunciation. According to Tajweed rules, we should read Quran because Allah commanded us to read Quran with an exact Arabic accent. This course includes all small to significant concepts of Tajweed you'll learn from a special qualified Tajweed Quran teacher. Hence, don't think more! Join our online Tajweed classes in Stockport.";
    $r1h = 'Interactive classes';
    $r1 = "One of the most fantastic facts about our online Quran academy in Stockport that our classes don't feed up the student's fir learning. Instead, students keep engaged with learning because we've used many interactive tools for making our classes incredible for kids and adults.";
    $r2h = 'One-on-one classes';
    $r2 = 'Our Quran classes are one-on-one because we prefer to teach our students in a peaceful environment. Therefore, we allow our students to learn individually with a single Quran teacher near me. ';
    $r3h = 'Monthly classes ';
    $r3 = "At Stockport online Quran Academy, you can learn the Quran month to month. We set this opportunity especially for those who can't afford yearly prices. Now, they can take our monthly Quran classes online in Stockport.";
    $r4h = 'Certified Quran teachers';
    $r4 = 'Alhamdulillah, All Quran teachers are certified and hold degrees in Islamic education from certified Quran Madrassas. They have certification in Quran study and have experience certificate of online teaching of Quran to more than a thousand students. ';
    $r5h = 'Female Quran teachers ';
    $r5 = "If you are looking for an online female Quran tutor near me for your sisters and kids, you are at the right place. We also have female Quran teachers for Islamic sisters and ladies because we know they don't learn from male teachers.";
    $r6h = 'Free trial classes';
    $r6 = 'We allow people who are new on our site to get free trial classes for three days. If they satisfy with our Quran classes online in Stockport, then join our monthly regular Quran classes.';
    $faqs = [
      [
        'question' => 'Does Stockport Quran Academy teach Quran physically? ',
        'answer' => 'No, our Quran classes are online, which are taken by students on a computer or laptop. All books and worksheets are digital in the form of pdf. The Islamic teacher will call the student on Skype or Zoom and deliver a lecture at a specific time. The teacher listens to lesson daily online, either video or audio call. ',
      ],
      [
        'question' => 'Is it necessary to take an online class on fixed timing? ',
        'answer' => "We ask our students to decide the timing of their class when they will be available and accessible for learning Quran online. Once they decide a time, they have to be online because your Quran teacher will come online on the spot. If you do not come online on time, you'll be responsible for missed class on your behalf.",
      ],

      [
        'question' => 'Is it possible to record live Quran classes online in Stockport?',
        'answer' => 'Yes, you can record your Quran lesson during the live class. After recording, you can playback at any time.  It will help you to listen to your lesson after the end of your online Quran class. We provide each facility to our students to make learning easy for them. ',
      ],
      [
        'question' => 'What things are needed to take Stockport Quran classes online? ',
        'answer' => 'You need a laptop, tablet, or computer for taking Quran classes online in Stockport. Also, your internet connection must be suitable for better communication. Moreover, speakers, microphones, and your sincere attention needed during Quran class. You have to sign up on an app suggested by your Islamic teacher.',
      ],
      [
        'question' => "If I don't know how to use a laptop or computer, what do I do? ",
        'answer' => "Suppose you are a beginner and don't know using computer and internet terms. Then don't worry!  Share this problem with our agent, and he will surely guide you about all tools and computer usage for taking your Quran class online in Stockport.",
      ],
    ];

    $meta = 'Online Quran classes in Stockport , Quran learning in Stockport , Quran recitation in Stockport , Quran teacher in Stockport , Quran in Stockport , Stockport  reading Quran, Quran in Stockport ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function nottinghamlocation()
  {
    $title = 'Best Online Quran Teachers In Nottingham';
    $hero = 'Best Online Quran Teachers In Nottingham';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Nottingham, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in nottingham",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in nottingham",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-nottingham"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Are our online Quran classes affordable for the people of Nottingham?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, our pricing plan is so reasonable that everyone can afford easily for learning Quran. It has become popular to learn Quran online, and many sites teach the Quran online in Nottingham, but they are expensive. In comparison to others, we consider that learning Quran is good deeds in front of Allah. Therefore, we set meager prices for every course."
                    }
                  },{
                    "@type": "Question",
                    "name": "What is the age limit for taking Nottingham Quran classes online?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "There\'s no age limit for learning or reading Quran from Nottingham Quran Academy online. Everyone can, whatever their ages can register here. Kids, adults, olds men, and women now can join Nottingham Quran classes to get interactive learning with the world\'s best Islamic teacher"
                    }
                  },{
                    "@type": "Question",
                    "name": "How can we enroll in Nottingham online Quran Academy?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Enrollment in our Nottingham Quran Academy is elementary and easy. First, you will take free trial classes for three days by contacting us. Then, you need to fill out our booking form by providing your name, phone number, email, or any message if you have, and send it. After that, you need to wait for about twenty-four hours. After that, we will contact you to guide you further."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is there any online female Quran teacher near me available?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, a female Quran teacher online is available on our site for teaching girls. Many Islamic sisters don\'t like to learn from male Quran teachers online, but they don\'t need to worry! They can learn Quran online in Nottingham with a highly qualified and experienced female Quran tutor near me."
                    }
                  },{
                    "@type": "Question",
                    "name": "Are there Islamic teachers are certified? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, there\'s no doubt about their certification and experience because we have taken all details with their learning, teaching, and experience certificates about them. They have good communication skills and are very cooperative to deal with every matter of students. Their teaching strategy is dominating over their certification because our students always show excellent results"
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Nottingham, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Nottingham, Quran Madrassas are rare. Therefore, Muslims in Nottingham prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Nottingham. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Nottingham.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Nottingham online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Nottingham don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Nottingham to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Nottingham because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Nottingham online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Nottingham. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Nottingham can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Nottingham Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'Are our online Quran classes affordable for the people of Nottingham?',
        'answer' => 'Yes, our pricing plan is so reasonable that everyone can afford easily for learning Quran. It has become popular to learn Quran online, and many sites teach the Quran online in Nottingham, but they are expensive. In comparison to others, we consider that learning Quran is good deeds in front of Allah. Therefore, we set meager prices for every course.',
      ],
      [
        'question' => 'What is the age limit for taking Nottingham Quran classes online?',
        'answer' => "There's no age limit for learning or reading Quran from Nottingham Quran Academy online. Everyone can, whatever their ages can register here. Kids, adults, olds men, and women now can join Nottingham Quran classes to get interactive learning with the world's best Islamic teacher.",
      ],

      [
        'question' => 'How can we enroll in Nottingham online Quran Academy?',
        'answer' => 'Enrollment in our Nottingham Quran Academy is elementary and easy. First, you will take free trial classes for three days by contacting us. Then, you need to fill out our booking form by providing your name, phone number, email, or any message if you have, and send it. After that, you need to wait for about twenty-four hours. After that, we will contact you to guide you further.',
      ],
      [
        'question' => 'Is there any online female Quran teacher near me available? ',
        'answer' => "Yes, a female Quran teacher online is available on our site for teaching girls. Many Islamic sisters don't like to learn from male Quran teachers online, but they don't need to worry! They can learn Quran online in Nottingham with a highly qualified and experienced female Quran tutor near me.",
      ],
      [
        'question' => 'Are there Islamic teachers are certified? ',
        'answer' => "Yes, there's no doubt about their certification and experience because we have taken all details with their learning, teaching, and experience certificates about them. They have good communication skills and are very cooperative to deal with every matter of students. Their teaching strategy is dominating over their certification because our students always show excellent results.",
      ],
    ];

    $meta = 'Online Quran classes in nottingham , Quran learning in nottingham , Quran recitation in nottingham , Quran teacher in nottingham , Quran in nottingham , nottingham  reading Quran, Quran in nottingham ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function bristollocation()
  {
    $title = 'Best Online Quran Teachers In Bristol';
    $hero = 'Best Online Quran Teachers In Bristol';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Bristol, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Bristol",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Bristol",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Bristol"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "How can I register in Bristol Quran Academy? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "You can register yourself in Bristol Quran classes by following some steps. First of all, select the course that suits you and take free trial classes by filling a contact form. Contact form requires your contact information like your name, phone number and email etc. After providing this detail, send this contact form and wait for 24 hours. One of our instructor will contact you to guide further."
                    }
                  },{
                    "@type": "Question",
                    "name": "How long it will take to complete Quran reading course for kids?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Quran Reading course is somewhat difficult for the people of Bristol because their native language is not Arabic. They need to learn Arabic language along with Arabic Accent from basic to advanced. This course is usually taken by kids. Therefore, kids take more time according to their IQ level. But, almost more than three to four years are needed to complete whole Quran."
                    }
                  },{
                    "@type": "Question",
                    "name": "Can I replace Bristol online Quran tutor with another one?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, everyone has right to change there current teacher on Bristol Quran Academy online. Because some students have different mind level of understanding, they need to mention reason for replacement of teacher. We will surely replace your current teacher with your recommended one."
                    }
                  },{
                    "@type": "Question",
                    "name": "What is the procedure of taking Bristol Quran classes? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "It\'s very simple to take Bristol Quran classes because you can take it without going anywhere. You need to have a laptop or mobile with good internet connection. Besides, you should have good speakers and microphones for your better contact with you Quran teacher near me."
                    }
                  },{
                    "@type": "Question",
                    "name": "What\'s age limit for enrolling in Bristol online Quran tuition?  ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Age limit is not required on Bristol Quran Academy because we allow everyone to join our Quran classes online. Student of any age such as children, adults, boys, men and women of old ages can also learn Quran online from here because there\'s no need of hesitation because we are giving individual Quran classes for every student."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Bristol, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Bristol, Quran Madrassas are rare. Therefore, Muslims in Bristol prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Bristol. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Bristol.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Bristol online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Bristol don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Bristol to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Bristol because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Bristol online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Bristol. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Bristol can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Bristol Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'How can I register in Bristol Quran Academy?  ',
        'answer' => 'You can register yourself in Bristol Quran classes by following some steps. First of all, select the course that suits you and take free trial classes by filling a contact form. Contact form requires your contact information like your name, phone number and email etc. After providing this detail, send this contact form and wait for 24 hours. One of our instructor will contact you to guide further. ',
      ],
      [
        'question' => 'How long it will take to complete Quran reading course for kids? ',
        'answer' => 'Quran Reading course is somewhat difficult for the people of Bristol because their native language is not Arabic. They need to learn Arabic language along with Arabic Accent from basic to advanced. This course is usually taken by kids. Therefore, kids take more time according to their IQ level. But, almost more than three to four years are needed to complete whole Quran.',
      ],

      [
        'question' => 'Can I replace Bristol online Quran tutor with another one?',
        'answer' => 'Yes, everyone has right to change there current teacher on Bristol Quran Academy online. Because some students have different mind level of understanding, they need to mention reason for replacement of teacher. We will surely replace your current teacher with your recommended one',
      ],
      [
        'question' => 'What is the procedure of taking Bristol Quran classes?  ',
        'answer' => "It's very simple to take Bristol Quran classes because you can take it without going anywhere. You need to have a laptop or mobile with good internet connection. Besides, you should have good speakers and microphones for your better contact with you Quran teacher near me.",
      ],
      [
        'question' => "What's age limit for enrolling in Bristol online Quran tuition?",
        'answer' => "Age limit is not required on Bristol Quran Academy because we allow everyone to join our Quran classes online. Student of any age such as children, adults, boys, men and women of old ages can also learn Quran online from here because there's no need of hesitation because we are giving individual Quran classes for every student.",
      ],
    ];

    $meta = 'Online Quran classes in Bristol , Quran learning in Bristol , Quran recitation in Bristol , Quran teacher in Bristol , Quran in Bristol , Bristol  reading Quran, Quran in Bristol ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function cardifflocation()
  {
    $title = 'Best Online Quran Teachers In Cardiff';
    $hero = 'Best Online Quran Teachers In Cardiff';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Cardiff, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in v",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Cardiff",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Cardiff"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Why Cardiff online Quran classes are better than local Madrassas?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "There is a lot of benefit of taking online Quran classes. First of all, you don\'t need to go out to a local Quran teacher near me. Instead, you\'ll learn Quran with the best Islamic teacher in your own home. Moreover, you can record your Quran lessons and playback after when you\'ll need them for revision. Besides, it will not enable to face the problem of transportation."
                    }
                  },{
                    "@type": "Question",
                    "name": "Will their kids, adults, and old students take a class together?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Not at all; all students will not learn together; instead, we offer one-on-one Quran classes online in Cardiff. In one-on-one Quran classes, a single Islamic teacher will teach a single student. We developed these classes to create better interaction between students and Quran teachers online."
                    }
                  },{
                    "@type": "Question",
                    "name": "What is the method of registration in Cardiff Quran classes?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Registration method in Cardiff Quran classes is simple and easy. To take free trial classes for three days, you need to fill out our booking form by providing some information. Contact information includes your name, phone number, email address, message (optional), and send. After sending, you have to wait for 24 hours; we\'ll contact you within one day."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is there a female Quran tutor available for girls?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, a female Quran tutor near me is also available for teaching female students. Girls and ladies stumble in learning Quran with male Quran teachers, but they don\'t need to worry. Now, our Islamic sisters can learn Quran with female Quran tutors online in Cardiff. Besides, our female Quran teachers are highly qualified for teaching Quran online."
                    }
                  },{
                    "@type": "Question",
                    "name": "What is the age limit for taking Cardiff Quran classes?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "There\'s no age limit for learning Quran in Islam. Similarly, there\'s no age limit for learning Quran from our Cardiff Quran Academy online. Everyone including, male, female, kids, adults, and older, can learn Quran from our site. They don\'t need to hesitate because we have one-on-one Quran classes for every student."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Cardiff, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Cardiff, Quran Madrassas are rare. Therefore, Muslims in Cardiff prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Cardiff. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Cardiff.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Cardiff online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Cardiff don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Cardiff to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Cardiff because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Cardiff online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Cardiff. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Cardiff can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Cardiff Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'Why Cardiff online Quran classes are better than local Madrassas?  ',
        'answer' => "There is a lot of benefit of taking online Quran classes. First of all, you don't need to go out to a local Quran teacher near me. Instead, you'll learn Quran with the best Islamic teacher in your own home. Moreover, you can record your Quran lessons and playback after when you'll need them for revision. Besides, it will not enable to face the problem of transportation",
      ],
      [
        'question' => 'Will their kids, adults, and old students take a class together?  ',
        'answer' => 'Not at all; all students will not learn together; instead, we offer one-on-one Quran classes online in Cardiff. In one-on-one Quran classes, a single Islamic teacher will teach a single student. We developed these classes to create better interaction between students and Quran teachers online.',
      ],

      [
        'question' => 'What is the method of registration in Cardiff Quran classes?',
        'answer' => "Registration method in Cardiff Quran classes is simple and easy. To take free trial classes for three days, you need to fill out our booking form by providing some information. Contact information includes your name, phone number, email address, message (optional), and send. After sending, you have to wait for 24 hours; we'll contact you within one day.",
      ],
      [
        'question' => 'Is there a female Quran tutor available for girls? ',
        'answer' => "Yes, a female Quran tutor near me is also available for teaching female students. Girls and ladies stumble in learning Quran with male Quran teachers, but they don't need to worry. Now, our Islamic sisters can learn Quran with female Quran tutors online in Cardiff. Besides, our female Quran teachers are highly qualified for teaching Quran online.",
      ],
      [
        'question' => 'What is the age limit for taking Cardiff Quran classes? ',
        'answer' => "There's no age limit for learning Quran in Islam. Similarly, there's no age limit for learning Quran from our Cardiff Quran Academy online. Everyone including, male, female, kids, adults, and older, can learn Quran from our site. They don't need to hesitate because we have one-on-one Quran classes for every student. ",
      ],
    ];

    $meta = 'Online Quran classes in Cardiff , Quran learning in Cardiff , Quran recitation in Cardiff , Quran teacher in Cardiff , Quran in Cardiff , Cardiff  reading Quran, Quran in Cardiff ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function islingtonlocation()
  {
    $title = 'Best Online Quran Teachers In Islington';
    $hero = 'Best Online Quran Teachers In Islington';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Islington, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in v",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Islington",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Islington"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "What is a method of taking Islington Quran classes? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Your Quran teacher will call you either video or audio on your selected class time. You\'ll receive that call and start your one-on-one class. In the first five minutes, your teacher will discuss and ask about the previous Quran lesson. After that, the Quran teacher near me will teach the next lesson by sharing a digital book on the screen that both teacher and student can see."
                    }
                  },{
                    "@type": "Question",
                    "name": "If I missed any Quran class, what will be happened?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "If you miss any one of our Islington Quran classes online, you must inform your teacher of the reason for missing your class. Your teacher will find a suitable timing for covering your missed class. If you do not report as soon as possible, we will not be responsible for conducting Quran classes for your previous lessons."
                    }
                  },{
                    "@type": "Question",
                    "name": "If an Islamic teacher will not available during class time, will I have to wait for an online class?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "If you call your Quran teacher and do not receive it, you need to wait for just five minutes. After that, you can call us to inform us about this problem. We will contact your Quran teacher and resolve this matter. Stay carefree with Islington Quran academy for taking online Quran classes."
                    }
                  },{
                    "@type": "Question",
                    "name": "Do I need to buy some books for learning Quran lessons?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "You don\'t need to buy any textbooks, etc. instead, we have our own digital Quran lesson book in the form of pdf. Your teacher will send you that book online and teach the Quran from that book by sharing this book on screen."
                    }
                  },{
                    "@type": "Question",
                    "name": "If I face any problem with my Quran teacher, what we have to do? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": If you face any difficulty learning from your Quran teacher near me, call us to inform us about the matter. We will replace your Quran teacher with another one who will guide you better. You need to tell your true reason for changing your online Quran teacher. According to your request, we will resolve your issue."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Islington, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Islington, Quran Madrassas are rare. Therefore, Muslims in Islington prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Islington. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Islington.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Islington online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Islington don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in  to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Islington because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Islington online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Islington. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Islington can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Cardiff Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'What is a method of taking Islington Quran classes?  ',
        'answer' => "Your Quran teacher will call you either video or audio on your selected class time. You'll receive that call and start your one-on-one class. In the first five minutes, your teacher will discuss and ask about the previous Quran lesson. After that, the Quran teacher near me will teach the next lesson by sharing a digital book on the screen that both teacher and student can see.",
      ],
      [
        'question' => 'If I missed any Quran class, what will be happened?  ',
        'answer' => 'If you miss any one of our Islington Quran classes online, you must inform your teacher of the reason for missing your class. Your teacher will find a suitable timing for covering your missed class. If you do not report as soon as possible, we will not be responsible for conducting Quran classes for your previous lessons.',
      ],

      [
        'question' => 'If an Islamic teacher will not available during class time, will I have to wait for an online class?',
        'answer' => 'If you call your Quran teacher and do not receive it, you need to wait for just five minutes. After that, you can call us to inform us about this problem. We will contact your Quran teacher and resolve this matter. Stay carefree with Islington Quran academy for taking online Quran classes.',
      ],
      [
        'question' => 'Do I need to buy some books for learning Quran lessons?  ',
        'answer' => "You don't need to buy any textbooks, etc. instead, we have our own digital Quran lesson book in the form of pdf. Your teacher will send you that book online and teach the Quran from that book by sharing this book on screen. ",
      ],
      [
        'question' => 'If I face any problem with my Quran teacher, what we have to do?  ',
        'answer' => 'If you face any difficulty learning from your Quran teacher near me, call us to inform us about the matter. We will replace your Quran teacher with another one who will guide you better. You need to tell your true reason for changing your online Quran teacher. According to your request, we will resolve your issue. ',
      ],
    ];

    $meta = 'Online Quran classes in Islington , Quran learning in Islington , Quran recitation in Islington , Quran teacher in Islington , Quran in Islington , Islington  reading Quran, Quran in Islington ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function barkinglocation()
  {
    $title = 'Best Online Quran Teachers In Barking';
    $hero = 'Best Online Quran Teachers In Barking';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Barking, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Barking",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Barking",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Barking"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Can I get a fee concession to take Quran classes online?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "If you see our pricing plans for registration in Barking online Quran classes, you\'ll be shocked because our pricing plans are very reasonable and affordable. Pricing is so minimum that every ordinary person can afford it, and he doesn\'t need to get concessions. Besides, we provide monthly pricing plans for needy people who face economic problems. But we give relief in fee on registration of third child of the same family."
                    }
                  },{
                    "@type": "Question",
                    "name": "How can I enroll in Barking Quran classes online?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "It\'s simple and easy to enrol in Quran classes online in Barking as you have to take free trial classes for three days. First, you need to fill out our contact form by giving some contact data. Contact data includes name, phone number, and email address. After writing these requisite, send this form. Then, we will contact you by either calling or sending an email to inform you about your registration confirmation. Besides, our agent will guide you through the following process."
                    }
                  },{
                    "@type": "Question",
                    "name": "Can I replace my teacher with a Quran teacher near me?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Of course, if you\'re not satisfied with your Quran teacher near me, then inform us. It would be best if you mentioned the reason for replacing your teacher. If it is valid, we will pay the need to your request, and we will surely change your Quran teacher with your recommended one. We always listen and resolve every matter of our students related to Barking Quran classes online."
                    }
                  },{
                    "@type": "Question",
                    "name": "What do I need for taking Quran classes online in Barking? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "You need to have a device like a laptop/mobile to take your online Quran class. Also, it would help if you had valuable microphones and speakers for better interaction with your Islamic teacher. After having these kings, you have to sign up on applications recommended by your Quran teachers such as Zoom/Skype or any other."
                    }
                  },{
                    "@type": "Question",
                    "name": "What is the procedure of taking online Quran classes on mobile?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "The teacher will video or audio call you on the recommended app at your selected time. You gave to received that call on the spot. Then, an Islamic teacher will talk about or listen to the previous Quran lesson for revision. After that, he/she will start delivering the lecture of that day either on audio or video call. Besides, the teacher also shares a screen to show a digital pdf Quran lesson book on the screen, which both teacher and student can watch."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Barking, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Barking, Quran Madrassas are rare. Therefore, Muslims in Barking prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Barking. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Barking.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Barking online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Barking don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Barking to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Barking because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Barking online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Barking. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Barking can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Barking Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'Can I get a fee concession to take Quran classes online? ',
        'answer' => "If you see our pricing plans for registration in Barking online Quran classes, you'll be shocked because our pricing plans are very reasonable and affordable. Pricing is so minimum that every ordinary person can afford it, and he doesn't need to get concessions. Besides, we provide monthly pricing plans for needy people who face economic problems. But we give relief in fee on registration of third child of the same family. ",
      ],
      [
        'question' => 'How can I enroll in Barking Quran classes online?',
        'answer' => "It's simple and easy to enrol in Quran classes online in Barking as you have to take free trial classes for three days. First, you need to fill out our contact form by giving some contact data. Contact data includes name, phone number, and email address. After writing these requisite, send this form. Then, we will contact you by either calling or sending an email to inform you about your registration confirmation. Besides, our agent will guide you through the following process. ",
      ],

      [
        'question' => 'Can I replace my teacher with a Quran teacher near me?',
        'answer' => "Of course, if you're not satisfied with your Quran teacher near me, then inform us. It would be best if you mentioned the reason for replacing your teacher. If it is valid, we will pay the need to your request, and we will surely change your Quran teacher with your recommended one. We always listen and resolve every matter of our students related to Barking Quran classes online.",
      ],
      [
        'question' => 'What do I need for taking Quran classes online in Barking?  ',
        'answer' => 'You need to have a device like a laptop/mobile to take your online Quran class. Also, it would help if you had valuable microphones and speakers for better interaction with your Islamic teacher. After having these kings, you have to sign up on applications recommended by your Quran teachers such as Zoom/Skype or any other.',
      ],
      [
        'question' => 'What is the procedure of taking online Quran classes on mobile? ',
        'answer' => 'The teacher will video or audio call you on the recommended app at your selected time. You gave to received that call on the spot. Then, an Islamic teacher will talk about or listen to the previous Quran lesson for revision. After that, he/she will start delivering the lecture of that day either on audio or video call. Besides, the teacher also shares a screen to show a digital pdf Quran lesson book on the screen, which both teacher and student can watch.',
      ],
    ];

    $meta = 'Online Quran classes in Barking , Quran learning in Barking , Quran recitation in Barking , Quran teacher in Barking , Quran in Barking , Barking  reading Quran, Quran in Barking ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function leicesterlocation()
  {
    $title = 'Best Online Quran Teachers In Leicester';
    $hero = 'Best Online Quran Teachers In Leicester';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Leicester, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Leicester",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Leicester",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Leicester"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Why Leicester Quran Academy is better than other Quran Madrassas? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "It\'s the main gist that why our Quran Academy is better than others. Let\'s clear that we have the world\'s best Quran teacher near me, along with interactive learning. Moreover, we provide One-on-one Quran classes for the individual student. Besides, our pricing plans are very reasonable that everyone can afford the month to month."
                    }
                  },{
                    "@type": "Question",
                    "name": "How can I enrol in Leicester Quran classes online? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Enrolment in our Leicester Quran classes is very easy. You need to fill a contact form by providing your information such as your name, phone number and email address. After filling these section, send it and wait for a while, at least 24 hours. Within 24 hours, our agent will contact you to guide you further about online Quran classes"
                    }
                  },{
                    "@type": "Question",
                    "name": "Is there individual Quran classes available? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, some people hesitate in learning with others due to age difference or shyness. Therefore, we have organized individual classes for a single student. In one-on-one Quran classes, the single student will learn from a single Quran teacher near me. In this way, the student will learn attentively and effectively."
                    }
                  },{
                    "@type": "Question",
                    "name": "Can I record Quran lessons during Leicester Quran classes?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, our Quran teachers allow students to record live Quran lessons. It would help them to playback after and revise the previous lesson at any time. The recorded Quran lesson will help you after your Quran course at Leicester online Quran Academy."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is it necessary to submit the fee for a year or more? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Not at all, people in Leicester who can\'t afford year to year fee, they can register for a month to month Quran classes. Monthly Quran classes are available for every ordinary person. Now, they can submit the monthly fee for taking month-on-month Quran classes online in Leicester."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Leicester, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Leicester, Quran Madrassas are rare. Therefore, Muslims in Leicester prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Leicester. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Leicester.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Leicester online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Leicester don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Leicester to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Leicester because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Leicester online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Leicester. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Leicester can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Leicester Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'Why Leicester Quran Academy is better than other Quran Madrassas?  ',
        'answer' => "It's the main gist that why our Quran Academy is better than others. Let's clear that we have the world's best Quran teacher near me, along with interactive learning. Moreover, we provide One-on-one Quran classes for the individual student. Besides, our pricing plans are very reasonable that everyone can afford the month to month.",
      ],
      [
        'question' => 'How can I enrol in Leicester Quran classes online? ',
        'answer' => 'Enrolment in our Leicester Quran classes is very easy. You need to fill a contact form by providing your information such as your name, phone number and email address. After filling these section, send it and wait for a while, at least 24 hours. Within 24 hours, our agent will contact you to guide you further about online Quran classes. ',
      ],

      [
        'question' => 'Is there individual Quran classes available? ',
        'answer' => 'Yes, some people hesitate in learning with others due to age difference or shyness. Therefore, we have organized individual classes for a single student. In one-on-one Quran classes, the single student will learn from a single Quran teacher near me. In this way, the student will learn attentively and effectively.',
      ],
      [
        'question' => 'Can I record Quran lessons during Leicester Quran classes? ',
        'answer' => 'Yes, our Quran teachers allow students to record live Quran lessons. It would help them to playback after and revise the previous lesson at any time. The recorded Quran lesson will help you after your Quran course at Leicester online Quran Academy.',
      ],
      [
        'question' => 'Is it necessary to submit the fee for a year or more?  ',
        'answer' => "Not at all, people in Leicester who can't afford year to year fee, they can register for a month to month Quran classes. Monthly Quran classes are available for every ordinary person. Now, they can submit the monthly fee for taking month-on-month Quran classes online in Leicester.",
      ],
    ];

    $meta = 'Online Quran classes in Leicester , Quran learning in Leicester , Quran recitation in Leicester , Quran teacher in Leicester , Quran in Leicester , Leicester  reading Quran, Quran in Leicester ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function walthamstowlocation()
  {
    $title = 'Best Online Quran Teachers In Walthamstow';
    $hero = 'Best Online Quran Teachers In Walthamstow';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Walthamstow, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Walthamstow",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Walthamstow",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Walthamstow"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "What is the method of Registration in Walthamstow Quran Academy?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "It\'s important to register yourself to Walthamstow online Quran academy before taking online Quran classes. Follow some steps like filling out a booking form which requires your name, phone number, and email address. Send it and wait for one day. Our chatting agent will contact you within 24 hours for guidance on the next procedure."
                    }
                  },{
                    "@type": "Question",
                    "name": "What is the age limit for taking Walthamstow online Quran classes?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "We do not fix any age limit for taking Quran classes on our platform as Allah doesn\'t oblige the specific age for learning Quran. Everyone can learn Quran whatever their ages are eligible. Adults, kids, and older can take our Quran classes online in Walthamstow. We need your passion for learning and your attention during Walthamstow\'s online Quran classes."
                    }
                  },{
                    "@type": "Question",
                    "name": "How can we take online Quran classes in Walthamstow? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "It\'s very simple to take Walthamstow online Quran classes because you must have a laptop or mobile with a good internet connection on which you\'ll take the course. Also, valuable speakers and microphones are needed for better communication. After that, please create your account and say it to your Islamic teacher. She will call you either audio or video, you have to receive for starting class."
                    }
                  },{
                    "@type": "Question",
                    "name": " Do the female Quran teachers teach Quran online in Walthamstow to girls?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, we have a female Quran tutor near me for teaching girls and ladies who don\'t like to learn from Qari. Therefore, they can join our one-on-one Quran classes online in Walthamstow to read Quran with a female Quran teacher online without any tension or hesitation. Our female Quran teachers are so communal and cooperative."
                    }
                  },{
                    "@type": "Question",
                    "name": "Why Walthamstow online Quran tuition is better than other sites?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Walthamstow online Quran tuition is better than others because we teach the Quran with the best Quran teachers and interactive Quran learning at highly affordable pricing. We allow parents to submit a month-to-month fee. Besides, one-on-one classes are available for everyone in which you\'ll get full schedule flexibility for taking your online course. "
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Walthamstow, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Walthamstow, Quran Madrassas are rare. Therefore, Muslims in Walthamstow prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Walthamstow. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Walthamstow.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Walthamstow online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Walthamstow don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Walthamstow to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Barking because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Walthamstow online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Walthamstow. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Walthamstow can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Walthamstow Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'What is the method of Registration in Walthamstow Quran Academy? ',
        'answer' => "It's important to register yourself to Walthamstow online Quran academy before taking online Quran classes. Follow some steps like filling out a booking form which requires your name, phone number, and email address. Send it and wait for one day. Our chatting agent will contact you within 24 hours for guidance on the next procedure.",
      ],
      [
        'question' => 'What is the age limit for taking Walthamstow online Quran classes?',
        'answer' => "We don't fix any age limit for taking Quran classes on our platform as Allah doesn't oblige the specific age for learning Quran. Everyone can learn Quran whatever their ages are eligible. Adults, kids, and older can take our Quran classes online in Walthamstow. We need your passion for learning and your attention during Walthamstow's online Quran classes.",
      ],

      [
        'question' => 'How can we take online Quran classes in Walthamstow? ',
        'answer' => "It's very simple to take Walthamstow online Quran classes because you must have a laptop or mobile with a good internet connection on which you'll take the course. Also, valuable speakers and microphones are needed for better communication. After that, please create your account and say it to your Islamic teacher. She will call you either audio or video, you have to receive for starting class.",
      ],
      [
        'question' => 'Do the female Quran teachers teach Quran online in Walthamstow to girls? ',
        'answer' => "Yes, we have a female Quran tutor near me for teaching girls and ladies who don't like to learn from Qari. Therefore, they can join our one-on-one Quran classes online in Walthamstow to read Quran with a female Quran teacher online without any tension or hesitation. Our female Quran teachers are so communal and cooperative. ",
      ],
      [
        'question' => 'Why Walthamstow online Quran tuition is better than other sites?  ',
        'answer' => "Walthamstow online Quran tuition is better than others because we teach the Quran with the best Quran teachers and interactive Quran learning at highly affordable pricing. We allow parents to submit a month-to-month fee. Besides, one-on-one classes are available for everyone in which you'll get full schedule flexibility for taking your online course.",
      ],
    ];

    $meta = 'Online Quran classes in Walthamstow , Quran learning in Walthamstow , Quran recitation in Walthamstow , Quran teacher in Walthamstow , Quran in Walthamstow , Walthamstow  reading Quran, Quran in Walthamstow. ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function croydonlocation()
  {
    $title = 'Best Online Quran Teachers In Croydon ';
    $hero = 'Best Online Quran Teachers In Croydon ';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Croydon, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Croydon",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Croydon",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Croydon"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Is there any change in schedule for memorization of the Quran?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "No, we can\'t distinguish between our students; all of them are equal in our institution. So all of the students, whether they are for Quran learning or memorization, have the same schedule. Schedule for taking Croydon online Quran classes will be selected by students. "
                    }
                  },{
                    "@type": "Question",
                    "name": "Will I get the trial classes the same as regular classes?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, those who want to get free trial classes will be a part of our regular classes, so they will experience how we teach them. In these trial classes, we want to tell the newcomers that we will educate them the same after enrolling in our Croydon Quran Academy."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is there any difference between monthly fees and annual fees?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "We divide the annual fees into equal monthly payments as we don\'t want to charge any extra charges in monthly surcharges. Most people think that in monthly classes we charge more than usual, but it\'s not true. "
                    }
                  },{
                    "@type": "Question",
                    "name": "Do female classes are scheduled according to the institution? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "The female classes have female teachers, and they are the same as regular classes in which you can also schedule your lesson whenever you want to or when you find time for yourself. In female courses, we don\'t involve any male islamic teacher or staff while any female attends the class."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is it better to attend online Quran teaching classes than physical?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, in this Covid pandemic, you should attend online teaching classes because you can\'t be able to go out to follow the physical lesson. Even physical lecture is a lot more dangerous for you these days and can be even fatal."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Croydon, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Croydon, Quran Madrassas are rare. Therefore, Muslims in Croydon prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Croydon. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Croydon.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Croydon online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Croydon don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Croydon to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Croydon because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Croydon online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Croydon. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Croydon can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Croydon Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'Is there any change in schedule for memorization of the Quran?',
        'answer' => "No, we can't distinguish between our students; all of them are equal in our institution. So all of the students, whether they are for Quran learning or memorization, have the same schedule. Schedule for taking Croydon online Quran classes will be selected by students.",
      ],
      [
        'question' => 'Will I get the trial classes the same as regular classes?',
        'answer' => 'Yes, those who want to get free trial classes will be a part of our regular classes, so they will experience how we teach them. In these trial classes, we want to tell the newcomers that we will educate them the same after enrolling in our Croydon Quran Academy.',
      ],

      [
        'question' => 'Is there any difference between monthly fees and annual fees?',
        'answer' => "We divide the annual fees into equal monthly payments as we don't want to charge any extra charges in monthly surcharges. Most people think that in monthly classes we charge more than usual, but it's not true.",
      ],
      [
        'question' => 'Do female classes are scheduled according to the institution? ',
        'answer' => "The female classes have female teachers, and they are the same as regular classes in which you can also schedule your lesson whenever you want to or when you find time for yourself. In female courses, we don't involve any male islamic teacher or staff while any female attends the class.",
      ],
      [
        'question' => 'Is it better to attend online Quran teaching classes than physical?',
        'answer' => "Yes, in this Covid pandemic, you should attend online teaching classes because you can't be able to go out to follow the physical lesson. Even physical lecture is a lot more dangerous for you these days and can be even fatal.",
      ],
    ];

    $meta = 'Online Quran classes in Croydon, Quran learning in Croydon , Quran recitation in Croydon , Quran teacher in Croydon , Quran in Croydon , Croydon  reading Quran, Quran in Croydon ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function halifaxlocation()
  {
    $title = 'Best Online Quran Teachers In Halifax';
    $hero = 'Best Online Quran Teachers In Halifax';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Halifax, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Halifax",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Halifax",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Halifax"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "What are the basic things needed to take the class? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "There isn\'t a need for any particular thing to attend the class. To take the course, you must have a laptop or smartphone with an Internet connection. Try to use a strong internet connection so you will not get any problem during class."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is there any male workers or staff in female sessions?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "There is no male teacher in the female session. We have hired female Quran teachers in Halifax only for female students as we don\'t like to compromise with female privacy, and we have strictly told the male teachers not to go to the female classes. "
                    }
                  },{
                    "@type": "Question",
                    "name": "Are these trial classes for female too?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, these trial classes are for both male and female. Both of them can attend trial classes to learn about the nature of our teachers and the way of teaching "
                    }
                  },{
                    "@type": "Question",
                    "name": "Can I attend class at any time? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "No, for this, you have to set a tour schedule with your teacher. As there are combined classes and they are on a fixed time. So to attend the course when you needed for this, you have to contact your teacher and tell him the reason. Then both of you can the time of the class on which you both agreed."
                    }
                  },{
                    "@type": "Question",
                    "name": "What to do if I\'m not comfortable with my teacher?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "We have a team of Quran teachers in Halifax, and all of them are cooperative and caring. Still, if you have any problem with your teacher and don\'t want to carry your study of the Quran with him, you can contact our administration and tell them your situation. If they find it reasonable, then they will change your teacher."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Halifax, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Halifax, Quran Madrassas are rare. Therefore, Muslims in Halifax prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Halifax. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Halifax.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Halifax online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Halifax don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Halifax to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Halifax because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Halifax online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Halifax. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Croydon can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Halifax Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'What are the basic things needed to take the class? ',
        'answer' => "There isn't a need for any particular thing to attend the class. To take the course, you must have a laptop or smartphone with an Internet connection. Try to use a strong internet connection so you will not get any problem during class.",
      ],
      [
        'question' => 'Is there any male workers or staff in female sessions?',
        'answer' => 'Yes, those who want to get free trial classes will be a part of our regular classes, so they will experience how we teach them. In these trial classes, we want to tell the newcomers that we will educate them the same after enrolling in our Croydon Quran Academy.',
      ],

      [
        'question' => 'Are these trial classes for female too?',
        'answer' => 'Yes, these trial classes are for both male and female. Both of them can attend trial classes to learn about the nature of our teachers and the way of teaching. ',
      ],
      [
        'question' => 'Can I attend class at any time?',
        'answer' => 'No, for this, you have to set a tour schedule with your teacher. As there are combined classes and they are on a fixed time. So to attend the course when you needed for this, you have to contact your teacher and tell him the reason. Then both of you can the time of the class on which you both agreed. ',
      ],
      [
        'question' => "What to do if I'm not comfortable with my teacher?",
        'answer' => "We have a team of Quran teachers in Halifax, and all of them are cooperative and caring. Still, if you have any problem with your teacher and don't want to carry your study of the Quran with him, you can contact our administration and tell them your situation. If they find it reasonable, then they will change your teacher.",
      ],
    ];

    $meta = 'Online Quran classes in Halifax, Quran learning in Halifax , Quran recitation in Halifax , Quran teacher in Halifax , Quran in Halifax , Halifax  reading Quran, Quran in Halifax ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function oldhamlocation()
  {
    $title = 'Best Online Quran Teachers In Oldham';
    $hero = 'Best Online Quran Teachers In Oldham';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Oldham, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Oldham",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Oldham",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Oldham"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "How to enroll in Oldham online Quran classes?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "To enroll yourself in online Quran classes in Oldham, first, you have filled the registration form with your complete information. You have to give us your contact information with your phone number and email on the registration form. After submitting your registration form, please wait for a while, and our team will contact you soon."
                    }
                  },{
                    "@type": "Question",
                    "name": "People of what age can enroll themselves in online Quran learning classes?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "We welcome people of every age to join our online learning classes in Oldham and learn to read the Quran precisely. Anyone can enroll himself or his kids in our institution at any time and starts learning the Quran. We have both male and female Quran tutor near me to teach Quran online"
                    }
                  },{
                    "@type": "Question",
                    "name": "What to do if I miss my class? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "If you missed your class due to any inconvenience or any other problem, then report to your teacher as soon as possible and tell him why you missed the class. After which your Islamic teacher will reschedule your class and teach you at another time which he finds suitable. "
                    }
                  },{
                    "@type": "Question",
                    "name": "How to attend the Oldham online Quran learning classes? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "It would be best to have a laptop or mobile phone with a robust Internet connection to attend your class. With this, a microphone and speakers are also needed to interact with your teacher and learn more by telling all of your queries to your teacher. "
                    }
                  },{
                    "@type": "Question",
                    "name": "What If I have a problem with my teacher? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "If you have a problem with your Quran teacher near me and don\'t want to carry on with him, you can also change your teacher. But for this, you have to tell us the exact reason. After this, we will replace your teacher and select a new teacher to start your learning from where you left by hoping that this will be a good teacher for you."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Oldham, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Oldham, Quran Madrassas are rare. Therefore, Muslims in Oldham prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Oldham. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Oldham.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Oldham online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Oldham don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Oldham to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Oldham because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Oldham online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Oldham. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Oldham can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Oldham Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'How to enroll in Oldham online Quran classes?',
        'answer' => 'To enroll yourself in online Quran classes in Oldham, first, you have filled the registration form with your complete information. You have to give us your contact information with your phone number and email on the registration form. After submitting your registration form, please wait for a while, and our team will contact you soon.',
      ],
      [
        'question' => 'People of what age can enroll themselves in online Quran learning classes?',
        'answer' => 'We welcome people of every age to join our online learning classes in Oldham and learn to read the Quran precisely. Anyone can enroll himself or his kids in our institution at any time and starts learning the Quran. We have both male and female Quran tutor near me to teach Quran online.',
      ],

      [
        'question' => 'What to do if I miss my class?',
        'answer' => 'If you missed your class due to any inconvenience or any other problem, then report to your teacher as soon as possible and tell him why you missed the class. After which your Islamic teacher will reschedule your class and teach you at another time which he finds suitable.',
      ],
      [
        'question' => 'How to attend the Oldham online Quran learning classes? ',
        'answer' => 'It would be best to have a laptop or mobile phone with a robust Internet connection to attend your class. With this, a microphone and speakers are also needed to interact with your teacher and learn more by telling all of your queries to your teacher.',
      ],
      [
        'question' => 'What If I have a problem with my teacher? ',
        'answer' => "If you have a problem with your Quran teacher near me and don't want to carry on with him, you can also change your teacher. But for this, you have to tell us the exact reason. After this, we will replace your teacher and select a new teacher to start your learning from where you left by hoping that this will be a good teacher for you.",
      ],
    ];

    $meta = 'Online Quran classes in Oldham, Quran learning in Oldham , Quran recitation in Oldham , Quran teacher in Oldham , Quran in Oldham , Oldham  reading Quran, Quran in Oldham ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function oxfordlocation()
  {
    $title = 'Best Online Quran Teachers In Oxford';
    $hero = 'Best Online Quran Teachers In Oxford';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Oxford, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Oxford",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Oxford",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Oxford"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Can I learn individual Quran classes online in Oxford?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, you can learn Quran online in Oxford by joining our individual Quran classes. We give one-on-one Quran classes online for everyone. We know that people of different ages enroll in our Oxford Quran classes. Therefore we provide a single eacher to the single student at one time class."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is it possible to exchange my Islamic teacher?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "If you are not satisfied with the Quran teacher, you must inform us about this problem. You need to mention the reason for replacing your online Quran teacher. We will pay heed to your request and surely return your teacher to another Islamic teacher to teach the Quran online."
                    }
                  },{
                    "@type": "Question",
                    "name": "How will I register at Oxford Quran Academy? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "It\'s simple to register in Oxford online Quran Academy. To take free trial classes, you need to fill a booking form after selecting any Quran course from our site. The booking form requires your name, mobile number, and email address. You can also write any message and send it, then wait for 24 hours. Our envoy will call you to verify your signup and guide you about the process of taking the class. "
                    }
                  },{
                    "@type": "Question",
                    "name": "Are trial classes of Oxford online Quran tuition-free of cost?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "To be satisfied with our online Quran classes in Oxford. Yes, we give trial classes for new visitors to our website. The good news is that these trial classes are for everyone—no need to pay for taking our Oxford Quran classes online for three days."
                    }
                  },{
                    "@type": "Question",
                    "name": "Can we record Quran lessons during Oxford online Quran classes? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, we allow our students to record and playback their Quran lessons online. We know that recording and playback after class will help our students to revise their assignments whenever they need. Besides, it would help our students to practice for their Quran lesson."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Oxford, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Oxford, Quran Madrassas are rare. Therefore, Muslims in Oxford prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Oxford. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Oxford.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Oxford online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Oxford don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Oxford to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Oxford because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Oxford online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Oxford. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Oxford can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Oxford Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'Can I learn individual Quran classes online in Oxford?',
        'answer' => 'Yes, you can learn Quran online in Oxford by joining our individual Quran classes. We give one-on-one Quran classes online for everyone. We know that people of different ages enroll in our Oxford Quran classes. Therefore we provide a single eacher to the single student at one time class.',
      ],
      [
        'question' => ' Is it possible to exchange my Islamic teacher?',
        'answer' => 'If you are not satisfied with the Quran teacher, you must inform us about this problem. You need to mention the reason for replacing your online Quran teacher. We will pay heed to your request and surely return your teacher to another Islamic teacher to teach the Quran online.',
      ],

      [
        'question' => 'How will I register at Oxford Quran Academy?',
        'answer' => "It's simple to register in Oxford online Quran Academy. To take free trial classes, you need to fill a booking form after selecting any Quran course from our site. The booking form requires your name, mobile number, and email address. You can also write any message and send it, then wait for 24 hours. Our envoy will call you to verify your signup and guide you about the process of taking the class.",
      ],
      [
        'question' => 'Are trial classes of Oxford online Quran tuition-free of cost? ',
        'answer' => 'To be satisfied with our online Quran classes in Oxford. Yes, we give trial classes for new visitors to our website. The good news is that these trial classes are for everyone—no need to pay for taking our Oxford Quran classes online for three days.',
      ],
      [
        'question' => 'Can we record Quran lessons during Oxford online Quran classes?  ',
        'answer' => 'Yes, we allow our students to record and playback their Quran lessons online. We know that recording and playback after class will help our students to revise their assignments whenever they need. Besides, it would help our students to practice for their Quran lesson.',
      ],
    ];

    $meta = 'Online Quran classes in Oxford, Quran learning in Oxford , Quran recitation in Oxford , Quran teacher in Oxford , Quran in Oxford , Oxford  reading Quran, Quran in Oxford ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function readinglocation()
  {
    $title = 'Best Online Quran Teachers In Reading';
    $hero = 'Best Online Quran Teachers In Reading';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Reading, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Reading",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Reading",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Reading"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Is it possible to take online Quran classes on mobile?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, if you don\'t have a laptop then don\'t worry! It\'s not necessary to take online classes on a laptop. You can also take your online Quran classes in Reading on mobile. You need to have a good internet connection. Install applications like Skype/Zoom on your mobile and stay coordinated with your Quran teacher near me."
                    }
                  },{
                    "@type": "Question",
                    "name": "What\'s the teaching strategy of  Quran Academy online in Reading?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Teaching strategy is simple and easy because we\'ve made our classes easy for everyone, especially kids. The Islamic teacher Will make call you at the class time which you\'d selected. You will receive the call, either audio or video, and start your live Quran class. The teacher will deliver the lesson during this call, along with sharing a digital book on screen. He/She also listen to Quran lesson daily."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is there any age limit needed for enrollment in Reading Quran Academy online?  ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "No, there\'s no specific age needed for learning Quran. Similarly, everyone, including kids, adults and olds, can learn Quran from our site anytime. Our Quran classes online in Reading are easily accessible for everyone with a good internet connection, whatever their ages are for learning Quran. "
                    }
                  },{
                    "@type": "Question",
                    "name": "What is a method of registration in Quran classes online in Reading?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "The registration method is simple as you have to go to take free trial classes for three days. For this, you have to fill out our booking form by giving valid information about you and your kids. The information contains your name, email address, and phone number. After completing this, send this booking form and wait for one day. Our representative will contact you to confirm your registration and guide you further."
                    }
                  },{
                    "@type": "Question",
                    "name": "How can we report to you about any problem related to online Quran classes? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "You don\'t need to compromise for any problem related to our online Quran classes in Reading. You have to call us and tell us about any problem with your Quran teacher near me or our services. We will certainly resolve your issue."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Reading, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Reading, Quran Madrassas are rare. Therefore, Muslims in Reading prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Reading. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Reading.</p>
";
    $c1h = 'Quran Reading';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Reading online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Reading don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Reading to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Reading because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Reading online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Reading. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Reading can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Reading Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'Is it possible to take online Quran classes on mobile?',
        'answer' => "Yes, if you don't have a laptop then don't worry! It's not necessary to take online classes on a laptop. You can also take your online Quran classes in Reading on mobile. You need to have a good internet connection. Install applications like Skype/Zoom on your mobile and stay coordinated with your Quran teacher near me.",
      ],
      [
        'question' => "What's the teaching strategy of  Quran Academy online in Reading?",
        'answer' => "Teaching strategy is simple and easy because we've made our classes easy for everyone, especially kids. The Islamic teacher Will make call you at the class time which you'd selected. You will receive the call, either audio or video, and start your live Quran class. The teacher will deliver the lesson during this call, along with sharing a digital book on screen. He/She also listen to Quran lesson daily.",
      ],

      [
        'question' => 'Is there any age limit needed for enrollment in Reading Quran Academy online?',
        'answer' => "No, there's no specific age needed for learning Quran. Similarly, everyone, including kids, adults and olds, can learn Quran from our site anytime. Our Quran classes online in Reading are easily accessible for everyone with a good internet connection, whatever their ages are for learning Quran.",
      ],
      [
        'question' => 'What is a method of registration in Quran classes online in Reading? ',
        'answer' => 'The registration method is simple as you have to go to take free trial classes for three days. For this, you have to fill out our booking form by giving valid information about you and your kids. The information contains your name, email address, and phone number. After completing this, send this booking form and wait for one day. Our representative will contact you to confirm your registration and guide you further.',
      ],
      [
        'question' => 'How can we report to you about any problem related to online Quran classes? ',
        'answer' => "You don't need to compromise for any problem related to our online Quran classes in Reading. You have to call us and tell us about any problem with your Quran teacher near me or our services. We will certainly resolve your issue.",
      ],
    ];

    $meta = 'Online Quran classes in Reading, Quran learning in Reading , Quran recitation in Reading , Quran teacher in Reading , Quran in Reading , Reading  reading Quran, Quran in Reading ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function shipleylocation()
  {
    $title = 'Best Online Quran Teachers In Shipley';
    $hero = 'Best Online Quran Teachers In Shipley';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Shipley, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Shipley",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Shipley",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Shipley"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Is there any physical procedure for enrolling in this institution?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "It’s easier for you to apply online from our website, and you don’t have to go anywhere for an application. All the instructions related to the application are on our website, and if you still get any problems, contact our helpline."
                    }
                  },{
                    "@type": "Question",
                    "name": "Is there any need for personal information documents for the application process? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "No, we don’t need any personal documents. All we need is your basic info and contact number with email, which you have to write on your application form to enrol yourself in our online Quran classes in Shipley."
                    }
                  },{
                    "@type": "Question",
                    "name": "What if my chemistry doesn’t match with the teacher?  ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "If you feel any difficulty or your chemistry doesn’t match with your teacher, you cannot understand him. Then contact us and tell us all of your problems. If we find it reasonable, we will change your Quran teacher near me, and you will carry on with your new teacher. "
                    }
                  },{
                    "@type": "Question",
                    "name": "Are these courses for specific people or people of every age can apply?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Our online Quran tuition in Shipley is for people of every age. It doesn’t matter whether you are a kid, adult, or old age; you can enrol yourself here and start learning the Quran quickly within no time. "
                    }
                  },{
                    "@type": "Question",
                    "name": "Will it be comfortable for females to enrol themselves?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": ".Yes, it is comfortable for all females to enroll in our institution as we have special female teachers. The privacy of females is kept here, and they will not be offended at all; moreover, we take special care of all the females. "
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Shipley, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Shipley, Quran Madrassas are rare. Therefore, Muslims in Shipley prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Shipley. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p> 
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Shipley.</p>
";
    $c1h = 'Quran Shipley';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Shipley online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Shipley don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Shipley to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Shipley because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Shipley online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Shipley. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Shipley can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Shipley Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'Is there any physical procedure for enrolling in this institution?',
        'answer' => 'It’s easier for you to apply online from our website, and you don’t have to go anywhere for an application. All the instructions related to the application are on our website, and if you still get any problems, contact our helpline. ',
      ],
      [
        'question' => 'Is there any need for personal information documents for the application process?',
        'answer' => 'No, we don’t need any personal documents. All we need is your basic info and contact number with email, which you have to write on your application form to enrol yourself in our online Quran classes in Shipley.',
      ],

      [
        'question' => 'What if my chemistry doesn’t match with the teacher?',
        'answer' => 'If you feel any difficulty or your chemistry doesn’t match with your teacher, you cannot understand him. Then contact us and tell us all of your problems. If we find it reasonable, we will change your Quran teacher near me, and you will carry on with your new teacher.',
      ],
      [
        'question' => 'Are these courses for specific people or people of every age can apply?',
        'answer' => 'Our online Quran tuition in Shipley is for people of every age. It doesn’t matter whether you are a kid, adult, or old age; you can enrol yourself here and start learning the Quran quickly within no time. ',
      ],
      [
        'question' => 'Will it be comfortable for females to enrol themselves? ',
        'answer' => 'Yes, it is comfortable for all females to enroll in our institution as we have special female teachers. The privacy of females is kept here, and they will not be offended at all; moreover, we take special care of all the females.',
      ],
    ];

    $meta = 'Online Quran classes in Shipley, Quran learning in Shipley , Quran recitation in Shipley , Quran teacher in Shipley , Quran in Shipley , Shipley  reading Quran, Quran in Shipley ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function stokeonlocation()
  {
    $title = 'Best Online Quran Teachers In Stoke on Trent';
    $hero = 'Best Online Quran Teachers In Stoke on Trent';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Stoke on Trent, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Stoke on Trent",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Stoke on Trent",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Stoke-on-Trent"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "Is there any option of replacing the Quran teacher? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, if the student will not be satisfied with his online Quran teacher, he has the right to change the teacher. Every student has a different IQ level and different ways of learning them. Therefore, it possible that some teacher\'s methods won\'t suit some students for learning Quran. But they don\'t need to worry! They need to mention the reason and problem; our instructor will surely replace the teacher with an Islamic teacher recommended by the student."
                    }
                  },{
                    "@type": "Question",
                    "name": "What\'s the age required for taking Stoke on Trent Quran classes online?  ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "As we see by Islamic rule, there\'s no age limit for learning the Quran. Everyone can learn Quran at any age period. We have one-on-one classes for every student to learn Quran effectively. Similarly, we allow all people of any age, kids, adults, and women, and men can learn Quran from our online Quran Academy in Stock on Trent."
                    }
                  },{
                    "@type": "Question",
                    "name": "How long will it take to complete the Quran Reading course duration? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Children mostly take Quran reading courses. They have to learn the Quran language from basic. Once they identify all Arabic letters and their joints, they will able to read the whole verse easily. Usually, it takes two or three years to complete the reading of the entire Quran. Besides, the duration depends upon students\' punctuality, attention, efforts, and interest in learning."
                    }
                  },{
                    "@type": "Question",
                    "name": "Will you give Quran lessons worksheets for practice?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, we provide free worksheets of related Quran lessons. These worksheets are in the form of pdf, which includes some practice work for students. After delivering the lecture at Stock on Trent Quran Academy, the Islamic teacher asks students to solve this worksheet for homework and check it regularly.  "
                    }
                  },{
                    "@type": "Question",
                    "name": "How will inform about any problem to Stoke on Trent Quran Academy?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "If you have any problems related to Quran teachers or Quran classes, you can inform us. We will fix every problem related to our online Quran Academy in Stoke on Trent. You can call us or send an email to tell us about your situation. Our instructors will pay heed to your request and try to solve it as soon as possible. "
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Stoke on Trent, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Stoke on Trent, Quran Madrassas are rare. Therefore, Muslims in Stoke on Trent prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Shipley. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Stoke on Trent.</p>
";
    $c1h = 'Quran Stoke on Trent';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Stoke on Trent online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Stoke on Trent Trent don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Stoke on Trent to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Stoke on Trent because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Stoke on Trent online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Stoke on Trent. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Shipley can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Shipley Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'Is there any option of replacing the Quran teacher?',
        'answer' => "Yes, if the student will not be satisfied with his online Quran teacher, he has the right to change the teacher. Every student has a different IQ level and different ways of learning them. Therefore, it possible that some teacher's methods won't suit some students for learning Quran. But they don't need to worry! They need to mention the reason and problem; our instructor will surely replace the teacher with an Islamic teacher recommended by the student. ",
      ],
      [
        'question' => "What's the age required for taking Stoke on Trent Quran classes online? ",
        'answer' => "As we see by Islamic rule, there's no age limit for learning the Quran. Everyone can learn Quran at any age period. We have one-on-one classes for every student to learn Quran effectively. Similarly, we allow all people of any age, kids, adults, and women, and men can learn Quran from our online Quran Academy in Stock on Trent.",
      ],

      [
        'question' => 'How long will it take to complete the Quran Reading course duration?',
        'answer' => "Children mostly take Quran reading courses. They have to learn the Quran language from basic. Once they identify all Arabic letters and their joints, they will able to read the whole verse easily. Usually, it takes two or three years to complete the reading of the entire Quran. Besides, the duration depends upon students' punctuality, attention, efforts, and interest in learning.",
      ],
      [
        'question' => 'Will you give Quran lessons worksheets for practice?',
        'answer' => 'Yes, we provide free worksheets of related Quran lessons. These worksheets are in the form of pdf, which includes some practice work for students. After delivering the lecture at Stock on Trent Quran Academy, the Islamic teacher asks students to solve this worksheet for homework and check it regularly. ',
      ],
      [
        'question' => 'How will inform about any problem to Stoke on Trent Quran Academy? ',
        'answer' => 'If you have any problems related to Quran teachers or Quran classes, you can inform us. We will fix every problem related to our online Quran Academy in Stoke on Trent. You can call us or send an email to tell us about your situation. Our instructors will pay heed to your request and try to solve it as soon as possible.',
      ],
    ];

    $meta = 'Online Quran classes in Stoke on Trent, Quran learning in Stoke on Trent, Quran recitation in Stoke on Trent, Quran teacher in Stoke on Trent, Quran in Stoke on Trent, Stoke on Trent reading Quran , Quran in Stoke on Trent';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function sloughlocation()
  {
    $title = 'Best Online Quran Teachers In Slough';
    $hero = 'Best Online Quran Teachers In Slough';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Slough, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Slough",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Slough",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Slough"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "How do Quran teachers teach Quran online in Slough?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "The method of teaching the Quran by our Quran teacher near me is simple. Your Quran tutor makes a call to begin your online class at your selected juncture. Students pick up the teacher\'s call (video or audio) to begin one-on-one class. In the initial five minutes, the teacher listens and talks about the previous lesson. After that, the teacher conveys Quran lessons through call and share screen to illustrate a digital book."
                    }
                  },{
                    "@type": "Question",
                    "name": "Are there online Quran teachers skilled? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Alhamdulillah, our Quran teachers are qualified and skilled in aspects of online Quran teaching. They are graduated in Quran and Islamic studies and well receptive to Tajweed Rules. Moreover, their excellent grip on the English language enables them to conversate fluently with students during Quran class. They are well-groomed in teaching Quran online and can understand the complexities with students in this field."
                    }
                  },{
                    "@type": "Question",
                    "name": "What is the success story of the online Quran Academy in Slough?  ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Alhamdulillah, we\'ve prospered in teaching Quran online to 1000+ students. We are working as the best online Quran academy in Slough for ten years. We are highly admired by students and parents of kids certified from here. Their parents are very gratified because they observe a lot of difference in their children than earlier. They confided that their kids had become an ethical soul after learning from here."
                    }
                  },{
                    "@type": "Question",
                    "name": "How to Register in Slough Quran Academy online? ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Registration for our online Quran classes in Slough is straightforward and lenient. Enroll yourself by clicking the button to take a free trial class for three days. A registration form will open; fill this contact form with your full name and contact data. After filling enrollment form, click on Submit. After submitting your filled form, our preceptor contacts you to instruct the subsequent system for taking your classes."
                    }
                  },{
                    "@type": "Question",
                    "name": "Are online Quran classes in Slough costly?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "No, we offer Quran courses at adequate fees that every average person can afford. Our pricing plans don\'t influence the quality of our Quran classes. Instead, we give each faculty to our students for the comfort of learning. Get to and join our highly affordable online Quran classes in Slough with highly experienced online Islamic teachers."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Slough, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Slough, Quran Madrassas are rare. Therefore, Muslims in Slough prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Slough. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Slough.</p>
";
    $c1h = 'Quran Slough';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Slough online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Slough don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Slough to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Slough because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Slough online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Slough. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Slough can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Slough Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'How do Quran teachers teach Quran online in Slough? ',
        'answer' => "The method of teaching the Quran by our Quran teacher near me is simple. Your Quran tutor makes a call to begin your online class at your selected juncture. Students pick up the teacher's call (video or audio) to begin one-on-one class. In the initial five minutes, the teacher listens and talks about the previous lesson. After that, the teacher conveys Quran lessons through call and share screen to illustrate a digital book. ",
      ],
      [
        'question' => 'Are there online Quran teachers skilled?',
        'answer' => 'No, we don’t need any personal documents. All we need is your basic info and contact number with email, which you have to write on your application form to enrol yourself in our online Quran classes in Shipley.',
      ],

      [
        'question' => 'What is the success story of the online Quran Academy in Slough?',
        'answer' => 'Alhamdulillah, our Quran teachers are qualified and skilled in aspects of online Quran teaching. They are graduated in Quran and Islamic studies and well receptive to Tajweed Rules. Moreover, their excellent grip on the English language enables them to conversate fluently with students during Quran class. They are well-groomed in teaching Quran online and can understand the complexities with students in this field.',
      ],
      [
        'question' => 'How to Register in Slough Quran Academy online? ',
        'answer' => 'Registration for our online Quran classes in Slough is straightforward and lenient. Enroll yourself by clicking the button to take a free trial class for three days. A registration form will open; fill this contact form with your full name and contact data. After filling enrollment form, click on Submit. After submitting your filled form, our preceptor contacts you to instruct the subsequent system for taking your classes.',
      ],
      [
        'question' => 'Are online Quran classes in Slough costly? ',
        'answer' => "No, we offer Quran courses at adequate fees that every average person can afford. Our pricing plans don't influence the quality of our Quran classes. Instead, we give each faculty to our students for the comfort of learning. Get to and join our highly affordable online Quran classes in Slough with highly experienced online Islamic teachers.",
      ],
    ];

    $meta = 'Online Quran classes in Slough, Quran learning in Slough , Quran recitation in Slough , Quran teacher in Slough , Quran in Slough , Slough  reading Quran, Quran in Slough ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }

  public function wakefieldlocation()
  {
    $title = 'Best Online Quran Teachers In Wakefield';
    $hero = 'Best Online Quran Teachers In Wakefield';
    $schema = '<script type="application/ld+json">
      {
                  "@context": "http://schema.org",
                  "@type": "Product",
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.1",
                    "reviewCount": "197"
                  },
                  "description": "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Wakefield, you can register here without hesitation. Alhamdulillah, we have been teaching Quran to more than a thousand students since 2010",
                  "name": "Quran Teacher in Wakefield",
                  "image": "https://www.onlinequrantuition.co.uk/images/logo.png",
                  "offers": {
                    "@type": "Offer",
                    "availability": "http://schema.org/InStock",
                    "price": "4.00",
                    "priceCurrency": "£"
                  } 

                 }
                </script>
                <script type="application/ld+json">
                    {
                      "@context": "https://schema.org",
                      "@type": "BreadcrumbList",
                      "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "https://www.onlinequrantuition.co.uk"
                      },{
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Quran Teacher in Wakefield",
                        "item": "https://onlinequrantuition.co.uk/quran-teacher-Wakefield"
                      }]
                    }
                 </script>
                ';

    $schemafaq = '<script type="application/ld+json">
           {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "How can we enroll in Wakefield online Quran classes?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "It\'s effortless and straightforward to enroll in the online Quran Academy in Wakefield. Choose a Quran course of your own choice and commence to take free trial classes. For this, you\'ll have to fill contact form with your name, email address, and phone number, along with any message. After sending this contact form, you\'ll have to wait for at least 24 hrs. Our chatting agent will surely contact you within 24 hrs as soon as possible to guide you further."
                    }
                  },{
                    "@type": "Question",
                    "name": "What is a method of taking Wakefield Quran classes?  ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "You\'ll have to sign up for an account on an application recommended by your Quran teacher near me, such as Skype/Zoom or others. The teacher will start the meeting and send the meeting link to you. You\'ll click on that link to enter The teacher will discuss and listen to previous Quran lessons either on video or audio call. After that, the teacher will deliver the next Quran lesson by sharing a digital book in the form of a pdf on screen."
                    }
                  },{
                    "@type": "Question",
                    "name": " Do we need to purchase any textbooks for taking Quran lessons?  ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Not at all; we don\'t ask our students to purchase any book locally related to our Quran lesson. Your Islamic teacher will send you a text related to your Quran course from which you\'ll learn your Quran lesson. This book will be digital, in the form of pdf, and free of cost for every student in Wakefield."
                    }
                  },{
                    "@type": "Question",
                    "name": "Can we get a fee concession for taking Quran classes in Wakefield?  ",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Question for fee concession should not arise because we have set very reasonable and affordable pricing plans for every related Quran course. Besides, we develop monthly Quran classes for the economically poor and can\'t afford yearly fees. "
                    }
                  },{
                    "@type": "Question",
                    "name": "Can we record the Quran lesson of Wakefield online Quran Academy?",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "Yes, you can record your Quran lesson in online Quran classes and playback after that. We know that it will help you to revise your Quran lesson after the course. Therefore, we don\'t restrict our students from recording their lessons in online Quran classes."
                    }
                  }]
                }
            </script>';
    $description = "If you want to learn Quran online and looking for the perfect but affordable Quran Tuition in Wakefield, you can register here without hesitation. Alhamdulillah, we've been teaching Quran to more than a thousand students since 2010";
    $review = Testimonial::where('status', 1)->where('rating', 5)
      ->orWhere('rating', 4)->orWhere('rating', 3)->orWhere('rating', 2)
      ->orWhere('rating', 1)->count();

    $total_testimonials = Testimonial::all()->random(3);

    $avg = Testimonial::where('status', 1)->avg('rating');

    $star5 = Testimonial::where('status', 1)->where('rating', 5)->count();
    $star4 = Testimonial::where('status', 1)->where('rating', 4)->count();
    $star3 = Testimonial::where('status', 1)->where('rating', 3)->count();
    $star2 = Testimonial::where('status', 1)->where('rating', 2)->count();
    $star1 = Testimonial::where('status', 1)->where('rating', 1)->count();
    $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC');

    $p1 = "Learning Quran is the sacred practice of Muslims to get the mercy of Allah in the world and hereafter. Muslims learn Quran in their childhood, but in some areas like Wakefield, Quran Madrassas are rare. Therefore, Muslims in Wakefield prefer Quran learning online. But the main gist is which site is perfect for learning Quran online. You don't need to think about that!<br>
Because now, you are at the right Quran website, which provides interactive Quran learning for you and your kids. We, along with our teaching staff always been successful in achieving good results for our students. Besides, you don't need to register with the whole amount. Instead, you can learn month-to-month Quran classes. Besides Quran learning, your kids will get 100% coaching here.
";
    $p2h = 'Our Best Quran teachers';
    $p2 = "Alhamdulillah, we've come up with the best online Islamic teachers from different countries who will teach Quran online in Wakefield. They have certification in Quran courses and experience in teaching Quran online. Their teaching way enables your kids to learn Quran efficiently and know how to sharpen their minds to understand the Quran efficiently. Our online Islamic teachers include Nazr-e-Quran teacher, Hafiz-e-Quran and Tajweed-e-Quran teacher online.
<h3 class='text-skin'>Male Quran teachers</h3>
<p class='text-white'>If you want to learn Quran with a professional and well-versed Quran teacher near me, meet with one of our male Quran teachers online. They hold degrees in Islamic education and have online Quran teaching experience with more than a thousand students. Therefore they not only teach Quran but also keep engaged our students with learning online.</p>
<h3 class='text-skin'>Female Quran teachers</h3>
<p class='text-white'>If you were looking for the best female Quran tutor near me, then you are in the right place. Because here, you'll find the perfect one who can change the life of your kids into Islamic life. A female tutor is primarily available for our Islamic sisters who don't like to learn with a male teacher online. So now, you can learn in a peaceful environment with a well-versed and certified female Quran teacher online in Wakefield.</p>
";
    $c1h = 'Quran Wakefield';
    $c1 = "It's one of the essential practices learned by Muslim kids whose native language is not Arabic. Our Islamic teachers are well-qualified for teaching this course online to your kids and adults. This course takes about three years of Duration for completing the whole Quran reading. Don't worry about our classes; we provide One-on-one interactive lessons and single Quran teachers to single teachers for better attention. If you want to see your kids read Quran accurately, then join our Wakefield online Quran classes.";
    $c2h = 'Quran Memorization';
    $c2 = "It's another practice of the Islamic religion for enlightening the heart with the light of the Quran. Allah becomes very happy after knowing that His person remembers His book with total dedication and sincerity. As a result, Allah gives a lot of rewards to Hafiz-e-Quran in the world and hereafter. People in Wakefield don't have Quran Madrassas nearby. Hence, they can join our Quran Memorization classes online in Wakefield to memorize unforgettable Quran with accurate pronunciation.";
    $c3h = 'Tajweed-Ul-Quran';
    $c3 = "It's essential to read Quran according to Tajweed rules. Tajweed means proficiency and accuracy, and Tajweed-Al-Quran signifies read Quran with precision and exactitude. Muslims learn Nazra and read Quran in a simple tone, but we should read Quran as Commanded by Allah to read with a cadent style. If you wish to improve your Arabic ascent of the Quran, you must join our Tajweed classes online in Wakefield because we have the best Tajweed teacher who teaches you interactive learning.";
    $r1h = 'Interactive classes';
    $r1 = 'The first benefit of choosing our Wakefield online Quran tuition is that you will get interactive Quran classes. We used both advanced and ancient tools but made our classes accessible and handy for everyone, either kids or adults. Our best Islamic teachers make sure to provide interactive learning to our students.';
    $r2h = 'Schedule flexibility';
    $r2 = "Another benefit is that you'll receive schedule flexibility in taking your Quran classes online in Wakefield. Yes! You will decide on which time you'll be available for taking your course quickly. Besides, it would be best if you also discussed with your teacher for his/her availability suited your selected time or not. Then, after consulting with your teacher, you can set the timing and take your class at that time.";
    $r3h = 'Monthly classes  ';
    $r3 = "Another advantage is that we've also allowed our students to get the opportunity of a monthly pricing plan. These monthly Quran classes are mainly organized for needy people and can't afford long-term fee plans. Therefore, they can choose month-to-month Quran classes with carefree.";
    $r4h = 'Female Quran teacher ';
    $r4 = "We've arranged female Quran teachers for girls and ladies because some girls don't prefer to learn Quran from a male Quran teacher near me. Our female staff is very cooperative and deals with students' problems in a very engaging way. Islamic sisters living in Wakefield can join our Quran classes online without hesitation. ";
    $r5h = 'One-on-one classes';
    $r5 = 'The benefit of allowing one-on-one classes is that a single teacher will teach a single student. In this way, the student will get more attention during lessons and learn Quran effectively. The one-on-one class will take place on Zoom/Skype by either video or audio call and sharing screen. ';
    $r6h = 'Free trial classes';
    $r6 = 'Most importantly, we are giving our students to take trial classes for free. They can take free trial classes for three days to check out the teaching strategy of Wakefield Quran classes. Then, if you feel that our teaching method suits you, you can proceed with continuous Quran classes.';
    $faqs = [
      [
        'question' => 'How can we enroll in Wakefield online Quran classes?',
        'answer' => "It's effortless and straightforward to enroll in the online Quran Academy in Wakefield. Choose a Quran course of your own choice and commence to take free trial classes. For this, you'll have to fill contact form with your name, email address, and phone number, along with any message. After sending this contact form, you'll have to wait for at least 24 hrs. Our chatting agent will surely contact you within 24 hrs as soon as possible to guide you further.",
      ],
      [
        'question' => 'What is a method of taking Wakefield Quran classes? ',
        'answer' => "You'll have to sign up for an account on an application recommended by your Quran teacher near me, such as Skype/Zoom or others. The teacher will start the meeting and send the meeting link to you. You'll click on that link to enter The teacher will discuss and listen to previous Quran lessons either on video or audio call. After that, the teacher will deliver the next Quran lesson by sharing a digital book in the form of a pdf on screen.",
      ],

      [
        'question' => 'Do we need to purchase any textbooks for taking Quran lessons?',
        'answer' => "Not at all; we don't ask our students to purchase any book locally related to our Quran lesson. Your Islamic teacher will send you a text related to your Quran course from which you'll learn your Quran lesson. This book will be digital, in the form of pdf, and free of cost for every student in Wakefield.",
      ],
      [
        'question' => 'Can we get a fee concession for taking Quran classes in Wakefield?  ',
        'answer' => "Question for fee concession should not arise because we have set very reasonable and affordable pricing plans for every related Quran course. Besides, we develop monthly Quran classes for the economically poor and can't afford yearly fees. ",
      ],
      [
        'question' => 'Can we record the Quran lesson of Wakefield online Quran Academy? ',
        'answer' => "Yes, you can record your Quran lesson in online Quran classes and playback after that. We know that it will help you to revise your Quran lesson after the course. Therefore, we don't restrict our students from recording their lessons in online Quran classes.",
      ],
    ];

    $meta = 'Online Quran classes in Wakefield, Quran learning in Wakefield , Quran recitation in Wakefield , Quran teacher in Wakefield , Quran in Wakefield , Wakefield  reading Quran, Quran in Wakefield ';
    $videos = HomeVideo::all();

    return view('subpages.location', get_defined_vars());
  }
}
