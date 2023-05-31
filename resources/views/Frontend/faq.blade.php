@extends('Frontend.utils.master')
@section('content')
<style>
</style>
<div class="page-content">
            <div class="breadcrumb-div bg-theme">
                <div class="container">
                    <ul class="breadcrumb-custom mb-0 bg-none">
                        <li><a href="{{url('/')}}" >Home</a></li>
                        <li class="on">FAQs</li>
                    </ul>
                </div>
            </div>
            <section class="faq-banner-block space-6 ">
                <div class="container">
                    <div class="d-flex flex-lg-nowrap flex-wrap justify-content-between faq-row">
                    <div class="banner-text-theme">
                        <h2 class="banner-head-theme fw-600">FAQ's</h2>
                        <span class="border-bottom"></span>
                        <p class="f-17 mb-3">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod</p>
                    </div>
                    <div class="faq-banner-img">
                        <img src="webassets/images/faq-image.png">
                    </div>
                </div>
            </section>
            <!-- accordia -->
            <section class="faq-block space-6">
                <div class="container">
                    <h4 class="heading-other">Frequently Asked Questions</h4>
                    <span class="small-border bg-theme mb-5"></span>
                    <div class="question-field d-flex">
                        <div class="question-number">
                            <span>1</span>
                        </div>
                        <div class="question-content">
                            <p class="fw-500 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit?</p>
                            <p class="answer"> Praesent sodales ligula eros, ut porttitor dolor vulputate vel. Proin et convallis purus. Nullam maximus diam sem, et rhoncus nulla pulvinar at. Cras posuere dolor in justo pulvinar malesuada. Nullam finibus venenatis sapien non mattis. Fusce ultricies varius odio, in congue felis dictum non.</p>
                        </div>
                        <div class="question-icon">
                            <span>+</span>
                        </div>
                    </div>
                    <div class="question-field d-flex">
                        <div class="question-number">
                            <span>3</span>
                        </div>
                        <div class="question-content">
                            <p class="fw-500 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit?</p>
                            <p class="answer"> Praesent sodales ligula eros, ut porttitor dolor vulputate vel. Proin et convallis purus. Nullam maximus diam sem, et rhoncus nulla pulvinar at. Cras posuere dolor in justo pulvinar malesuada. Nullam finibus venenatis sapien non mattis. Fusce ultricies varius odio, in congue felis dictum non.</p>
                        </div>
                        <div class="question-icon">
                            <span>+</span>
                        </div>
                    </div>
                    <div class="question-field d-flex">
                        <div class="question-number">
                            <span>1</span>
                        </div>
                        <div class="question-content">
                            <p class="fw-500 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit?</p>
                            <p class="answer"> Praesent sodales ligula eros, ut porttitor dolor vulputate vel. Proin et convallis purus. Nullam maximus diam sem, et rhoncus nulla pulvinar at. Cras posuere dolor in justo pulvinar malesuada. Nullam finibus venenatis sapien non mattis. Fusce ultricies varius odio, in congue felis dictum non.</p>
                        </div>
                        <div class="question-icon">
                            <span>+</span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- accordian-->
        </div>

@endsection
