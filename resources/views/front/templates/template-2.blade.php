<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <style>
        * {
            font-size: 20px;
            color: #333;
            font-family: Arial, Helvetica, sans-serif;
        }

        .tertiary-color {
            color: #bbb;
        }

        .section-title {
            text-align: left;
            font-size: 28px;
            color: #007bff
        }

        .section-content {
            padding: 0px 20px;
        }

        .ml-10 {
            margin-left: 10px;
        }

        .ml-20 {
            margin-left: 20px;
        }

        .highlight {
            font-size: 16px;
            vertical-align: middle;
            margin-left: 10px;
            color: #777
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div>
        <div class="basic-info">
            <h2 class="section-title text-center">{{$data['first_name'] }} {{ $data['last_name']}}</h2>
            <div class="section-content text-center">
                @php
                $country = isset($countries[$data['country']]) ? $countries[$data['country']] : '';

                $address = '';
                $address = isset($data['street']) ? $address . $data['street'] : $address;
                $address = isset($data['postal_code']) ? $address . ', ' . $data['postal_code'] : $address;
                $address = isset($data['city']) ? $address .', ' . $data['city'] : $address;
                $address = $country ? $address . ', ' . $country: $address;
                @endphp

                <p style="margin-bottom:5px;">{{ $data['email'] }} | {{ $data['phone'] }} </p>
                <p style="margin-bottom:5px;"> {{ $address }}</p>
            </div>
        </div>
        <hr>
        <div class="summary">
            <h2 class="section-title">Summary</h2>
            <div class="section-content">
                <p>{{$data['profession_summary']}}</p>
            </div>
        </div>
        <hr>
        <div class="skills">
            <h2 class="section-title">Skills</h2>
            <div class="section-content">
                @foreach($skills as $each)
                @if(!empty($each['name']))
                <p class="tertiary-color">{{$each['name'] }} - <span class="highlight">{{ ucfirst($each['level'])}}</span></p>
                @endif
                @endforeach
            </div>
        </div>
        <hr>
        <div class="history">
            <h2 class="section-title">Work History</h2>
            <div class="section-content">
                @foreach($work as $each)
                @if(!empty($each['company']))
                <p class="tertiary-color">{{$each['company'] }} - <span class="highlight">{{$each['start_date']}} to @if(!empty($each['end_date'])) {{$each['end_date']}} @else {{"Current"}} @endif</span></p>
                <p><strong class="seconday-color">{{$each['position']}}</strong></p>
                <div style="margin-left: 40px;">
                    <strong>Summary</strong>
                    <p class="ml-10">{{$each['summary']}}</p>
                    <strong>Highlights</strong>
                    <p class="ml-10">{{$each['highlights']}}</p>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <hr>
        <div class="education">
            <h2 class="section-title">Education</h2>
            <div class="section-content">
                @foreach($education as $each)
                @if(!empty($each['institution']))
                <p class="tertiary-color">{{$each['institution'] }} - <span class="highlight">{{$each['start_date']}} to @if(!empty($each['end_date'])) {{$each['end_date']}} @else {{"Current"}} @endif</span></p>
                <p><strong class="seconday-color">{{$each['study_type']}} </strong> - <span class="highlight">{{$each['gpa']}}</span></p>
                @endif
                @endforeach
            </div>
        </div>
        <hr>
        <div class="reference">
            <h2 class="section-title">Reference</h2>
            <div class="section-content">
                @foreach($references as $each)
                @if(!empty($each['name']))
                <p class="tertiary-color">{{$each['name']}}</p>
                <p class="ml-20">{{$each['reference']}}</p>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>