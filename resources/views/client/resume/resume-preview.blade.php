@extends('client.layouts.master')
@section('title', $pageTitle)
@section('content')

<div class="choose-template mt-5">
    <div class="container">
        <div class="preview-breadcrumb clearfix"> <a href="{{route('resume.resume_details')}}" class="btn btn-secondary float-left"> Go Back</a></div>

        <div class="choose-template-panel-title-wrapper">
            <div class="choose-template-panel-title text-capitalize text-secondary">Preview your resume</div>
            <div class="choose-template-panel-sub-title text-secondary">Reselect template that impresses you</div>
        </div>
        <div class="clearfix">
            <form id="template-form" class="float-left">
                <div class="form-group text-center">
                    <label for="template" class="col-form-label">Choose Template</label>
                    <select name="template" id="template">
                        <option value="">Select</option>
                        @foreach($templates as $name => $details)
                        <option value="{{$name}}" @if($name==$choosenTemplate){{"selected"}}@endif>{{$details['display_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="resume-download-btn-wrapper float-right">
                <a href="{{url('/resume/download?type=pdf')}}" target="_blank" class="btn btn-lg btn-primary js-download-btn">Download as pdf</a>
                <a href="{{url('/resume/download?type=word')}}" target="_blank" class="btn btn-lg btn-secondary js-download-btn">Download as word</a>
                </form>
            </div>
        </div>
        <div class="template-preview my-5 border">
            {!! $parsedView !!}
        </div>

    </div>

    @endsection

    @section('after-styles')
    <style>
        .section-break {
            margin: 48px 0px;
            border-color: #aaa;
        }
    </style>
    @endsection

    @section('after-scripts')
    <script>
        $(document).ready(function() {
            $('#template').change(function() {
                let val = $(this).val();
                //if no template is choose empty template preview and return
                if (!val) {
                    $('.template-preview').html("");
                    swal({
                        icon: 'warning',
                        title: 'Oops',
                        text: 'Please select a tempalte'
                    });
                    return;
                }

                //url to get parsed template view  
                let formUrl = "{{route('resume.template_parsed_view')}}";
                let formData = $('#template-form').serialize();
                //else perform ajax to get parsed view according to template choosen
                $.get(formUrl, formData, function(data) {
                    if (typeof data.resp == 'undefined') return;

                    if (data.resp) {
                        $('.template-preview').html(data.parsedView);
                    } else {
                        swal({
                            icon: 'warning',
                            title: 'Oops',
                            text: data.message
                        });
                    };
                }).catch(function(err) {
                    console.log(err);
                })
            })

            //handle download btn clicks
            $('.js-download-btn').on('click', function(e) {
                e.preventDefault();

                let url = $(this).attr('href');

                //inform user to login if user is not authenticated
                let userStatus = IS_USER_AUTH;
                if (!userStatus) {
                    swal({
                        icon: "info",
                        title: "Sorry",
                        text: "Please login to download resume"
                    }).then(function() {
                        location.href = "{{route('login')}}";
                    });

                    return;
                }

                //if authenticated unbind click and trigger click
                $(this).unbind('click');
                $(this).get(0).click();
            });
        });
    </script>

    @endsection