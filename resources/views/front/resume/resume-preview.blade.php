@extends('front.layouts.master')
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
                    <label for="template " class="col-form-label">Choose Template</label>
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
        <div class="template-preview my-5">
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

        .template-preview {
            border: 1px solid #ccc;
            padding: 20px 20px;
            border-radius: 10px;
        }
    </style>
    @endsection

    @section('after-scripts')
    <!-- <script type="text/javascript" src="//cdn.rawgit.com/niklasvh/html2canvas/0.5.0-alpha2/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> -->
    <script>
        $(document).ready(function() {
            $('#template').change(function() {
                let template = $(this).val();
                //if no template is choose empty template preview and return
                if (!template) {
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
            $('.js-download-btn').on('click', function(event) {
                event.preventDefault();
                // createPDF();

                let url = $(this).attr('href');

                //inform user to login if user is not authenticated
                let userStatus = "{{auth()->check()}}";
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

        // //create pdf
        // function createPDF() {
        //     getCanvas().then(function(canvas) {
        //         var img = canvas.toDataURL('image/png'),
        //             doc = new jsPDF();
        //         doc.addImage(img, 'PNG', 5, 5);
        //         doc.save('resume.pdf');
        //     });
        // }

        // // create canvas object
        // function getCanvas() {
        //     let renderedTemplate = $('.template-preview')[0];
        //     return html2canvas(renderedTemplate, {
        //         scale: 5,
        //         dpi: 144,
        //     });
        // }
    </script>

    @endsection