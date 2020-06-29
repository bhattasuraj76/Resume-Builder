@extends('client.layouts.master')
@section('title', $pageTitle)
@section('content')

<div class="choose-template mt-5">
    <div class="container">
        <div class="choose-template-panel-title-wrapper">
            <div class="choose-template-panel-title text-capitalize text-secondary">Build your resume in 10 minutes</div>
            <div class="choose-template-panel-sub-title text-secondary">Start by choosing a template</div>
        </div>
        <div class="row">
            @php
            $templates = config('resume.templates');
            @endphp
            @foreach($templates as $name => $details)
            <div class="col-lg-4">
                <div class="template" data-template-name="{{$name}}">
                    <div class="template-preview">
                        <div class="card text-center">
                            <img src="{{asset($details['preview'])}}" class="img-fluid template-img" alt="{{$details['display_name']}}">
                            <div class="button-wrapper">
                                <div class="content">
                                    <a href="#" class="btn btn-primary js-choose-template">Create Resume</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="template-title text-center">{{$details['display_name']}}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('after-styles')
@endsection

@section('after-scripts')
<script>
    //form url for template data
    const formUrl = "{{route('resume.choose_template')}}";

    (function($) {
        $('.js-choose-template').on('click', function(e) {
            e.preventDefault();
            //get template name
            let template = $(this).parents('.template').data('template-name');
            if (!template) return; //return if not defined

            //collect data for ajax
            let formData = {
                template
            };

            //perform ajax request to save template value in session
            $.post(formUrl, formData, function(data) {
                if(typeof data.resp == 'undefined') return;

                if (data.resp) console.log('success');
                else console.log("error");

                location.href = data.next_page_url; //redirect to next page
            }).catch(function(err) {
                console.log(err);
            })
        });
    })(jQuery);
</script>
@endsection