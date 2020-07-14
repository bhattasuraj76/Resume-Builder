<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
</head>

<body>
    <table cellpadding="0" cellspacing="0" width="100%" style="border:1;border-collapse:collapse;border-spacing:0;font-size:20px;color:#333;font-family:Arial, Helvetica, sans-serif">
        <tr>
            <td>
                <h2 style="font-size:28px;color:#6c757d;text-align:center;">{{$data['first_name'] }} {{ $data['last_name']}}</h2>
                <div style="padding: 0px 20px;text-align: center;">
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
                <hr>
            </td>
        </tr>
        <tr>
            <td>
                <h2 style="text-align: left;font-size:28px;color:#6c757d">Summary</h2>
                <div style="padding: 0 20px">
                    <p>{{$data['profession_summary']}}</p>
                </div>
                <hr>
            </td>
        </tr>
        <tr>
            <td>
                <h2 style="text-align: left;font-size:28px;color:#6c757d">Skills</h2>
                <div style="padding: 0 20px">
                    @foreach($skills as $each)
                    @if(!empty($each['name']))
                    <p style="color: #bbb">{{$each['name'] }} - <span style="font-size:16px;vertical-align:middle;margin-left: 10px;color: #777">{{ ucfirst($each['level'])}}</span></p>
                    @endif
                    @endforeach
                </div>
                <hr>
            </td>
        </tr>
        <tr>
            <td>
                <h2 style="text-align: left;font-size:28px;color:#6c757d">Work History</h2>
                <div style="padding: 0 20px">
                    @foreach($work as $each)
                    @if(!empty($each['company']))
                    <p style="color: #bbb">{{$each['company'] }} - <span style="font-size:16px;vertical-align:middle;margin-left: 10px;color: #777">{{$each['start_date']}} to @if(!empty($each['end_date'])) {{$each['end_date']}} @else {{"Current"}} @endif</span></p>
                    <p><strong style="color: #777">{{$each['position']}}</strong></p>
                    <div style="margin-left: 40px;">
                            <strong>Summary</strong>
                            <p style="margin-left: 10px">{{$each['summary']}}</p>
                            <strong>Highlights</strong>
                            <p style="margin-left: 10px">{{$each['highlights']}}</p>
                        </div>

                        @endif
                        @endforeach
                    </div>
                    <hr>
            </td>
        </tr>
        <tr>
            <td>
                <h2 style="text-align: left;font-size:28px;color:#6c757d">Education</h2>
                <div style="padding: 0 20px">
                    @foreach($education as $each)
                    @if(!empty($each['institution']))
                    <p style="color: #bbb">{{$each['institution'] }} - <span style="font-size:16px;vertical-align:middle;margin-left: 10px;color: #777">{{$each['start_date']}} to @if(!empty($each['end_date'])) {{$each['end_date']}} @else {{"Current"}} @endif</span></p>
                    <p><strong style="color: #777">{{$each['study_type']}} </strong> - <span style="font-size:16px;vertical-align:middle;margin-left: 10px;color: #777">{{$each['gpa']}}</span></p>
                    @endif
                    @endforeach
                </div>
                <hr>
            </td>
        </tr>
        <tr>
            <td>
                <h2 style="text-align: left;font-size:28px;color:#6c757d">Reference</h2>
                <div style="padding: 0 20px">
                    @foreach($references as $each)
                    @if(!empty($each['name']))
                    <p style="color: #bbb">{{$each['name']}}</p>
                    <p style="margin-left: 20px">{{$each['reference']}}</p>
                    @endif
                    @endforeach
                </div>
            </td>
        </tr>
    </table>
</body>

</html>