@extends('layouts.app')
@section('title', $settings['how_it_works_meta_title'] ?? '')
@section('meta')

<meta name="description" content="{{ $settings['how_it_works_meta_description'] ?? '' }}">
<meta name="keywords" content="{{ $settings['how_it_works_meta_keywords'] ?? '' }}">
@endsection
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section class="pages-banner-heading p-0">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 m-auto banner-left-heading">
                    <h1><span>Raise results</span> <br/>raiseconfidence.introduces the features</h1>
                    <h5 class="mt-2">Effective online tuition that fits your timetable</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 asideimg" style="background-image: url({{ asset($settings['header_banner_image']) }});">
                </div>
            </div>
        </div>
    </section>


    <section class="p-0">
        <div class="container">
            <div class="card mt-4 mb-4 schools-card">
                <div class="card-header p-0 text-center schoools-card-heading">
                    <h2 class="pt-1 m-0">Online Quran memorization Course</h2>
                </div>
                <div class="card-body">
                    <p>If you aspire to become a Hafiz / Hafizah or you simply want to memorize the Quran, this foundational course is the perfect first step to your lifelong Quran memorization journey. It Is The Next Level Course designed for students who Have Basic Knowledge Of The Quran And The Arabic Language. Memorization of the Noble Quran takes effort and sincere commitment. However, the rewards from Allah are immense in this worldly life and Hereafter. Quran memorization course is an excellent opportunity for the learners who seek to start memorizing Quran classes online without the fear to forget it.</p>
                    <p>This course is for everyone who can read or understand Arabic or not. The Quran tutor will take it step by step for you,</p>
                    <p> till you achieve your goal. The tutor will help Students to learn easy techniques for fast Memorization. Students of all ages can enrol in our course and learn to memorize the Quran from expert hafiz tutors. This course will help you increase your memory and learning ability. We teach in the best way and help students solve the problems of forgetting. We help students complete the course in a short time. Students will learn the lessons step by step.</p>
                    <ul>
                        <li>Read the Quran accurately and fluently.</li>
                        <li>To understand the stopping and pausing signs (Ramoozul Auqaf).</li>
                        <li>Implementations the stopping signs in the Quran.</li>
                        <li>To Read and memorise surahs without making mistakes</li>
                        <li>To Read Quran with Tajweed rules.</li>
                        <li>Memorisation of Quran with Tajweed rules.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="p-0">
        <div class="container">
            <div class="card mb-4 schools-card">
                <div class="card-header p-0 text-center schoools-card-heading">
                    <h2 class="pt-1 m-0">Online course for the beginners</h2>
                </div>
                <div class="card-body">
                    <p>Basic education for every Muslim is to learn and understand The Holy Quran. Keeping in view this purpose we have designed this course for beginners, irrespective of age or gender, everyone is welcomed to join this course who are willing to recite and learn basic Quran teachings. Realizing the fact that not everyone is fluent in Arabic language, this course covers every aspect of reading the Quran from the basic levels. So that every beginner at the end of this will be able to start their journey to learning Arabic in a way that will directly impact your relationship with the Quran and your Salah, and ultimately with Allah.</p>
                    <p>Main objectives Of Learning Quran As A Beginner</p>
                    <ul>
                        <li>To learn the separate forms of the Arabic letter.</li>
                        <li>The pronunciation will be 100% in the Arabic accent.</li>
                        <li>Understand Arabic letters with their joint forms (Beginning, middle, ending)</li>
                        <li>Learn how to join letters to make words</li>
                        <li>To read, understand and practice with exercises the short vowels' sounds</li>
                        <li>To read, understand and practice the long vowels sounds</li>
                        <li>Understand and read Jazm, Shaddah, Sukoon and Tanween</li>
                        <li>To understand Madd categories and read for the appropriate duration</li>
                        <li>To Learn the STOP and PAUSE signs in the Quran</li>
                        <li>Huroof Muqatta'aat</li>
                        <li>To learn Stopping denoting pause (Ramoozul Auqaf)</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="p-0">
        <div class="container">
            <div class="card mb-4 schools-card">
                <div class="card-header p-0 text-center schoools-card-heading">
                    <h2 class="pt-1 m-0">Online Quran Tajweed course</h2>
                </div>
                <div class="card-body">
                    <p>The word Tajweed (Tajwid) is a verbal noun from jawwada. Meaning 'proficiency.' When applied to the Quran. It means to recite every letter of the Quran with its rights characteristics. Observing all the rules required for reading the Quran. Muslims around the world are under the obligation to learn the Quran. As it was revealed by using the rules of Tajweed Online Quran Tuition offers courses and lessons of Tajweed to learn Quran by applying the rules of Tajweed.
                        Our experienced tutors will teach Tajweed courses to beginners and advanced levels.. Throughout this course you will get lots of opportunities to practice the rules and recite the Quran with natural style .By enrolling in this course you’ll get perfection in the recitation of your Quran reading (according to the rules). We’ll teach you detailed rules and terminologies of tajweed.</p>
                    <ul>
                        <li>Understand the shapes of Arabic letters.</li>
                        <li>Read Quran letters with the correct pronunciation.</li>
                        <li>know the Arabic alphabet and identify the origins.</li>
                        <li>Read the Quran with accuracy.</li>
                        <li>Memorize the last 10 Suras of the Quran using Tajweed rules.</li>
                        <li>Learn the exceptional rules of Qira'ah.</li>
                        <li>To learn joint forms of the Arabic alphabet.</li>
                        <li>Learn Tafkhaam (heavy sounds).</li>
                        <li>The rules of Meem Saakina</li>
                        <li>The rules of Laam Sakinah.</li>
                        <li>Ramooz ul Auqaaf.</li>
                        <li>Implementation of Tajweed rules by reciting.</li>
                        <li>learn the mandatory attributes of Arabic letters (Sifaat e Lazimah).</li>
                        <li>learn the temporary attributes of Arabic letters (Sifaat e AAridhah).</li>
                        <li>Know the types and rules of assimilation (Idghaam).</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section-lesson">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 m-auto lessons-left-heading">
                <span class="alhamdulillah-dark">ALHAMDULILLAH</span>
                <h1><span>One-to-One tuition</span> that
                    delivers the teachings of The Holy Quran in the most effective way
                    </h1>
                <h5>Learn Quran online one to one with our well versed and well qualified teachers to bring out the best results, with intensive individual support adapted to your convenience.</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src="{{ asset('images/one2one.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </section>

</div>
<!-- content close -->

@stop
