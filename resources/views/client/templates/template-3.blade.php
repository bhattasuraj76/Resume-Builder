<table cellpadding="0" cellspacing="0" width="100%" style="border:0;border-collapse:collapse;border-spacing:0;font-size:14px;font-family:Arial, Helvetica, sans-serif">
    <tr>
        <td style="padding-left: 20px;">
            <table style="border:0;border-collapse:collapse;border-spacing:0;" width="100%">
                <tr>
                    <td style="text-align: center;font-size:32px;color:#444;color:#25accc">
                        {{$data['first_name'] }} {{ $data['last_name']}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;color:#aaa">
                        {{$data['email'] }}
                    </td>
                </tr>
                <tr>
                    <td style=" text-align: center;color:#aaa">
                        {{$data['phone'] }}
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #ccc;padding-top:5px;padding-bottom:15px;" colspan="2"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="border:0;border-collapse:collapse;border-spacing:0;">
                <tr>
                    <td style="text-align: left;font-size:28px;color:#788db4">Skills</td>
                </tr>
                @foreach($skills as $each)
                @if(!empty($each['name']))
                <tr>
                    <td style="padding-left:10px">{{$each['name']}}</td>
                    <td>{{ucfirst($each['level'])}}</td>
                </tr>
                @endif
                @endforeach
                <tr>
                    <td style="border-bottom: 1px solid #ccc;padding-top:5px;padding-bottom:15px;" colspan="2"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="border:0;border-collapse:collapse;border-spacing:0;">
                <tr>
                    <td style="text-align: left;font-size:28px;color:#788db4">Work History</td>
                </tr>
                @foreach($work as $each)
                @if(!empty($each['company']))
                <tr>
                    <td style="padding-left:5px;text-align: left;font-size:18px;color:#bbb;">{{$each['company']}}</td>
                    <td>{{$each['start_date']}} to @if(!empty($each['end_date'])) {{$each['end_date']}} @else {{"Current"}} @endif </td>
                </tr>
                <tr>
                    <td style="padding-left: 20px; color:#788db4">{{$each['position']}}</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px;color:#444">{{$each['summary']}}</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px;color:#444"> {{$each['highlights']}}</td>
                </tr>
                <tr>
                    <td style="padding-top:10px"></td>
                </tr>
                @endif
                @endforeach
                <tr>
                    <td style="border-bottom: 1px solid #ccc;padding-top:5px;padding-bottom:15px;" colspan="2"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="border:0;border-collapse:collapse;border-spacing:0;">
                <tr>
                    <td style="text-align: left;font-size:28px;color:#788db4">Education</td>
                </tr>
                @foreach($education as $each)
                @if(!empty($each['institution']))
                <tr>
                    <td style="padding-left:5px;text-align: left;font-size:18px;color:#bbb">{{$each['institution']}}</td>
                    <td>{{$each['start_date']}} to @if(!empty($each['end_date'])) {{$each['end_date']}} @else {{"Current"}} @endif </td>
                </tr>
                <tr>
                    <td style="padding-left:10px">{{$each['study_type']}}</td>
                </tr>
                <tr>
                    <td style="padding-left:10px"> GPA: {{$each['gpa']}}</td>
                </tr>
                <tr>
                    <td style="padding-top:10px;"></td>
                </tr>
                @endif
                @endforeach
                <tr>
                    <td style="border-bottom: 1px solid #ccc;padding-top:5px;padding-bottom:15px;" colspan="2"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="border:0;border-collapse:collapse;border-spacing:0;">
                <tr>
                    <td style="text-align: left;font-size:28px;color:#788db4">Reference</td>
                </tr>
                @foreach($references as $each)
                @if(!empty($each['name']))
                <tr>
                    <td style="padding-left:5px;text-align: left;font-size:18px;color:#bbb">{{$each['name']}}</td>
                </tr>
                <tr>
                    <td style="padding-left:10px">{{$each['reference']}}</td>
                </tr>
                @endif
                @endforeach
                <tr>
                    <td style="border-bottom: 1px solid #ccc;padding-top:5px;padding-bottom:15px;" colspan="2"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding-bottom: 20px;">
        </td>
    </tr>
</table>