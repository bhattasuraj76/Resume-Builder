<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Resume</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <style>
        body {
            font-family: 'Lato';
            color: #333;
        }

        @font-face {
            font-family: 'IcoMoon-Free';
            src: url('{{url("/public/front/fonts/icomoon/"."IcoMoon-Free.ttf")}}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        [class^="icon-"],
        [class*=" icon-"] {
            /* use !important to prevent issues with browser extensions that change fonts */
            font-family: 'IcoMoon-Free' !important;
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            /* Better Font Rendering =========== */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .icon-location:before {
            content: "\e947";
        }

        .icon-mail:before {
            content: "\ea83";
        }

        .icon-phone:before {
            content: "\e942";
        }

        .icon-board:before {
            content: "\e971";
        }

        .icon-office:before {
            content: "\e903";
        }

        .icon-graduation-cap:before {
            content: "\e976";
        }

        .icon-tools:before {
            content: "\e995";
        }

        .icon-thumbs-up:before {
            content: "\e96b";
        }

        .relative {
            position: relative;
        }

        .clear-margin {
            margin: 0;
        }

        .space-top {
            margin-top: 10px;
        }

        .space-right {
            margin-right: 10px;
        }

        .space-bottom {
            margin-bottom: 10px;
        }

        .mr-5 {
            margin-right: 5px;
        }

        .mr-10 {
            margin-right: 10px;
        }

        .ml-5 {
            margin-left: 5px;
        }

        .labels {
            line-height: 2;
        }

        .label-keyword {
            display: inline-block;
            background: #7eb0db;
            color: white;
            font-size: 0.9em;
            padding: 5px;
            border: 1px solid #357ebd;
            margin-right: 5px;
        }

        .label-keyword:last-child {
            margin-right: 0;
        }

        .link-disguise {
            color: inherit;
        }

        .link-disguise:hover {
            color: inherit;
        }

        .clear-margin {
            margin: 0;
        }

        @media (max-width: 992px) {
            .clear-margin-sm {
                margin-bottom: 0;
            }
        }

        .fs-lg {
            font-size: 1.33333333em;
            line-height: 0.75em;
            vertical-align: -15%;
        }

        .fs-2x {
            font-size: 2em;
        }

        .fs-3x {
            font-size: 3em;
        }

        .fs-4x {
            font-size: 4em;
        }

        .btn-circle-sm {
            width: 28px;
            height: 28px;
            line-height: 28px;
            border-radius: 50%;
            text-align: center;
            padding: 0;
            outline: none !important;
        }


        .main {
            padding: 5px;
        }

        .card {
            background: white;
            border: 1px solid #e6e6e6;
            border-radius: 3px;
            min-height: 100px;
            padding: 10px 0;
        }

        .card-nested {
            min-height: 0;
            border-width: 1px 0 0 0;
        }

        .card-nested:before,
        .card-nested:after {
            content: " ";
            display: table;
        }

        .card-nested:after {
            clear: both;
        }

        @media (max-width: 480px) {
            .card-nested {
                padding: 5px 0;
            }
        }

        .background-card {
            padding: 10px 20px;
        }

        .card-wrapper {
            padding: 5px;
        }

        @media (max-width: 992px) {
            .card-wrapper {
                float: none !important;
            }
        }

        .background-details .detail {
            display: table;
        }

        .background-details .detail .icon {
            min-width: 45px;
            max-width: 45px;
            text-align: center;
        }

        .background-details .detail .info {
            width: 100%;
        }

        .background-details .detail .title,
        .background-details .detail .icon {
            color: #707070;
        }

        .background-details .detail .mobile-title {
            display: none;
        }

        @media (max-width: 480px) {
            .background-details .detail .mobile-title {
                display: inline-block;
                margin-left: 5px;
                font-weight: bold;
                text-transform: uppercase;
                vertical-align: middle;
            }
        }

        .background-details .detail .icon,
        .background-details .detail .info {
            display: table-cell;
            padding: 0 10px;
        }

        @media (max-width: 480px) {
            .background-details .detail {
                display: block;
            }

            .background-details .detail .icon {
                max-width: inherit;
                min-width: inherit;
                text-align: left;
            }

            .background-details .detail .icon,
            .background-details .detail .info {
                display: block;
                padding: 10px 0;
            }

            .background-details .detail .title {
                display: none;
            }
        }

        .info .content.has-sidebar {
            width: 80%;
            box-sizing: border-box;
            float: left;
            padding: 0 10px;
            border-right: 1px solid #cdcdcd;
        }

        @media (max-width: 992px) {
            .info .content.has-sidebar {
                width: 100%;
                border-right: 0;
            }
        }

        @media (max-width: 480px) {
            .info .content.has-sidebar {
                padding: 0 2px;
            }
        }

        .info .sidebar {
            margin-left: 80%;
            box-sizing: border-box;
            padding: 10px;
        }

        @media (max-width: 480px) {
            ul {
                padding-left: 25px;
            }
        }

        .current-event {
            font-size: 8px;
            color: #5ACE24;
            position: absolute;
            right: 100%;
            top: 4px;
            left: -10px;
        }

        .mop-wrapper>p:last-child {
            margin: 0;
        }

        @media (max-width: 992px) {
            .profile-card-wrapper {
                position: relative;
            }
        }

        .profile-card-wrapper .profile-card {
            padding: 10px;
        }

        .profile-pic {
            padding: 20px 0;
        }

        @media (max-width: 992px) {
            .profile-pic {
                padding: 10px 0;
            }
        }

        .profile-pic img {
            width: 100px;
            height: 100px;
        }

        @media (max-width: 992px) {
            .name {
                margin-top: 10px;
            }
        }

        @media (max-width: 768px) {
            .contact-details {
                text-align: center;
            }
        }

        .contact-details .detail {
            display: table;
            padding: 10px 0;
        }

        .contact-details .detail .icon {
            padding: 0 10px;
            color: #707070;
        }

        @media (max-width: 992px) {
            .contact-details .detail .icon {
                padding: 0 5px 0 0;
            }
        }

        .contact-details .detail .info {
            font-size: 0.8em;
        }

        .contact-details .detail .icon,
        .contact-details .detail .info {
            display: table-cell;
            vertical-align: middle;
        }

        @media (max-width: 768px) {
            .contact-details .detail {
                position: relative;
                float: left;
                width: 100%;
                min-height: 1px;
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        @media (max-width: 992px) {
            .contact-details .detail {
                position: relative;
                min-height: 1px;
                padding-left: 15px;
                padding-right: 15px;
                padding: 10px;
            }

            .contact-details .detail .icon,
            .contact-details .detail .info {
                display: inline-block;
            }
        }

        @media (max-width: 992px) and (min-width: 768px) {
            .contact-details .detail {
                float: left;
                width: 25%;
            }
        }

        .social-links {
            line-height: 2.5;
        }

        .social-link {
            margin-left: 5px;
            min-width: 35px;
            display: inline-block;
        }

        .social-link:first-child {
            margin-left: 0;
        }

        .social-link:hover {
            text-decoration: none;
        }

        .card-skills {
            position: relative;
        }

        .skill-level {
            border-radius: 3px;
            position: absolute;
            top: 10px;
            bottom: 10px;
            left: 0;
            width: 10px;
            box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.2);
        }

        .skill-level .skill-progress {
            position: absolute;
            border-radius: 3px;
            bottom: 0;
            width: 100%;
            -webkit-transition: height 1s ease;
        }

        .skill-level .skill-progress.beginner {
            height: 50%;
            background: #e74c3c;
        }

        .skill-level .skill-progress.intermediate {
            height: 70%;
            background: #f1c40f;
        }

        .skill-level .skill-progress.advanced {
            height: 80%;
            background: #428bca;
        }

        .skill-level .skill-progress.master {
            height: 95%;
            background: #5cb85c;
        }

        .skill-info {
            margin-left: 15px;
        }

        @media (max-width: 480px) {
            .skill-info {
                margin-left: 20px;
            }
        }

        @media (max-width: 768px) {
            .quote {
                font-size: inherit;
            }
        }

        .icon-meetup .path2:before {
            margin-left: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main clearfix">
            <div class="row">
                <section class="col-md-3 card-wrapper profile-card-wrapper affix">
                    <div class="card profile-card">
                        <span class="profile-pic-container">
                            <div class="name-and-profession text-center">
                                <h3 itemprop="name"><b> {{$data['first_name'] }} {{ $data['last_name']}}</b></h3>
                                <h5 class="text-muted" itemprop="jobTitle">{{$data['profession_title'] }}</h5>
                            </div>
                        </span>
                        <hr />
                        <div class="contact-details clearfix">
                            <div class="detail"><span class="icon"><i class="icon fs-lg icon-location"></i></span><span class="info"> {{$data['street'] }}, {{ $data['city']}}, {{ $data['country']}}, {{ $data['postal_code']}}</span></div>
                            <div class="detail"><span class="icon"><i class="icon fs-lg icon-phone"></i></span><span class="info" itemprop="telephone"> {{$data['phone'] }}</span></div>
                            <div class="detail"><span class="icon"><i class="icon fs-lg icon-mail"></i></span><span class="info"><a class="link-disguise" href="mailto:richard@valley.com" itemprop="email"> {{$data['email'] }}</a></span></div>
                        </div>
                        <hr />
                    </div>
                </section>
                <section class="col-md-9 card-wrapper pull-right">
                    <div class="card background-card">
                        <h4 class="text-uppercase">Background</h4>
                        <hr />
                        <div class="background-details">
                            <div class="detail" id="about">
                                <div class="icon"><i class="fs-lg icon-board"></i><span class="mobile-title">About</span></div>
                                <div class="info">
                                    <h4 class="title text-uppercase">About</h4>
                                    <div class="card card-nested">
                                        <div class="content mop-wrapper" itemprop="description">
                                            <p>{{$data['profession_summary'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="detail" id="work-experience">
                                <div class="icon"><i class="fs-lg icon-office"></i><span class="mobile-title">Work Experience</span></div>
                                <div class="info">
                                    <h4 class="title text-uppercase">Work Experience</h4>
                                    <ul class="list-unstyled clear-margin">
                                        @foreach($work as $each)
                                        @if(!empty($each['company']))

                                        <li class="card card-nested clearfix">
                                            <div class="content">
                                                <p class="clear-margin relative"><strong>{{$each['position']}}</strong>,&nbsp;<a href="http://piedpiper.com" target="_blank">{{$each['company']}}</a></p>
                                                <p class="text-muted"><small><span class="space-right">{{$each['start_date']}} to @if(!empty($each['end_date'])) {{$each['end_date']}} @else {{"Current"}} @endif</small></span></p>
                                                <div class="mop-wrapper space-bottom">
                                                    <p>{{$each['summary']}}</p>
                                                </div>
                                                <ul>
                                                    <li class="mop-wrapper">
                                                        {{$each['highlights']}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="detail" id="skills">
                                <div class="icon"><i class="fs-lg icon-tools"></i><span class="mobile-title">Skills</span></div>
                                <div class="info">
                                    <h4 class="title text-uppercase">Skills</h4>
                                    <div class="content">
                                        <ul class="list-unstyled clear-margin">
                                            @foreach($skills as $each)
                                            @if(!empty($each['name']))
                                            <li class="card card-nested card-skills">
                                                <div class="skill-level" data-toggle="tooltip" title="Master" data-placement="left">
                                                    <div class="skill-progress master"></div>
                                                </div>
                                                <div class="skill-info"><strong>{{$each['name']}}</strong>
                                                    <div class="space-top labels"><span class="label label-keyword">{{ucfirst($each['level'])}}</span></div>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="detail" id="education">
                                <div class="icon"><i class="fs-lg icon-graduation-cap"></i><span class="mobile-title">Education</span></div>
                                <div class="info">
                                    <h4 class="title text-uppercase">Education</h4>
                                    <div class="content">
                                        <ul class="list-unstyled clear-margin">
                                            @foreach($education as $each)
                                            @if(!empty($each['institution']))
                                            <li class="card card-nested">
                                                <div class="content">
                                                    <p class="clear-margin relative"><strong>{{$each['area']}},{{$each['study_type']}},&nbsp;</strong>{{$each['institution']}}</p>
                                                    <p class="text-muted"><small>{{$each['start_date']}} - @if(!empty($each['end_date'])) {{$each['end_date']}} @else {{"Current"}} @endif </small></p><i>{{$each['gpa']}}</i>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="detail" id="references">
                                <div class="icon"><i class="fs-lg icon-thumbs-up"></i><span class="mobile-title">References</span></div>
                                <div class="info">
                                    <h4 class="title text-uppercase">References</h4>
                                    <div class="content">
                                        <ul class="list-unstyled clear-margin">
                                            @foreach($references as $each)
                                            @if(!empty($each['name']))
                                            <li class="card card-nested">{{$each['name']}}
                                                <blockquote class="quote">
                                                    <div class="mop-wrapper">
                                                        <p>{{$each['reference']}}</p>
                                                    </div>
                                                </blockquote>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>