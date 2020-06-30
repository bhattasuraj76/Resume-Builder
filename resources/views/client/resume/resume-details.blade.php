@extends('client.layouts.master')
@section('title', $pageTitle)
@section('content')

<div class="choose-template mt-5">
    <div class="container">
        <div class="choose-template-panel-title-wrapper">
            <div class="choose-template-panel-title text-capitalize text-secondary">on the way to build you resume</div>
            <div class="choose-template-panel-sub-title text-secondary">Fill all the fields correctly to get impressive resume</div>
        </div>
        <form id="resume-details-form" onsubmit="event.preventDefault();">
            @csrf
            <div id="smartwizard">
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="#basic-info">
                            Basic Info
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#work-details">
                            Work Details
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#skills">
                            Skills
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#education">
                            Education
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#references">
                            References 
                        </a>
                    </li>
                </ul>

                <div class="tab-content p-4 mb-1">
                    <div id="basic-info" class="tab-pane" role="tabpanel">
                        @include('client.resume.partials._basic-info')
                    </div>
                    <div id="skills" class="tab-pane" role="tabpanel">
                        @include('client.resume.partials._skills')
                    </div>
                    <div id="work-details" class="tab-pane" role="tabpanel">
                        @include('client.resume.partials._work-details')
                    </div>

                    <div id="education" class="tab-pane" role="tabpanel">
                        @include('client.resume.partials._education')
                    </div>
                    <div id="references" class="tab-pane" role="tabpanel">
                        @include('client.resume.partials._references')
                        <button class="btn btn-lg btn-outline-success js-resume-details-btn mx-auto d-block">Build Resume</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('after-styles')
<style>
    .tab-content {
        width: 100% !important;
        height: auto !important;
    }
</style>
@endsection

@section('after-scripts')
<script>
    //form url for template data
    const formUrl = "{{route('resume.resume_details')}}";

    $('.js-resume-details-btn').on('click', function(e) {
        e.preventDefault();
        let formData = $('#resume-details-form').serialize();

        //perform ajax request to save resume details value in session
        $.post(formUrl, formData, function(data) {
            if (typeof data.resp == 'undefined') return;

            if (data.resp) console.log('success');
            else {
                if (!$.isEmptyObject(data.errors)) {
                    let errors = JSON.stringify(Object.values(data.errors)); //stringify all errors

                    swal({
                        title: 'Validation Error',
                        text: errors,
                        icon: "error"
                    });
                }

                return;
            }

            location.href = data.next_page_url; //redirect to next page
        }).catch(function(err) {
            console.log(err);
        })
    });
    //disable end date if cuurent checkbox is true
    $(document).on('click', '.js-current-studying, .js-current-working', function() {
        let val = $(this).is(':checked') ? 1 : 0;
        let $checkbox = $(this).parents('.row').first().find('input[class*="js-calendar"]');

        if (val) $checkbox.val("").attr('disabled', 'disabled');
        else $checkbox.removeAttr('disabled');
    });

    // SmartWizard initialize
    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'arrows',
        justified: true,
        autoAdjustHeight: true,
        cycleSteps: true,
        backButtonSupport: true,
        transition: {
            animation: 'slide-horizontal', // none/fade/slide-horizontal/slide-vertical/slide-swing
            speed: '1000',
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'right', // left, right, center
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            toolbarExtraButtons: [] // Extra buttons to show on toolbar
        },
        anchorSettings: {
            anchorClickable: true, // Enable/Disable anchor navigation
            enableAllAnchors: false, // Activates all anchors clickable all times
            markDoneStep: true, // Add done css
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        },
        lang: { // Language variables for button
            next: 'Next',
            previous: 'Previous'
        },
    });

    //add more skills 
    $('.js-add-more-skills-btn').on('click', function() {
        var selector = $(".js-skills").last();
        var count = $(".js-skills").length;
        var initialTimer;

        if (initialTimer) {
            clearTimeout(initialTimer);
        }

        //hide other items details
        if (count > 0) {
            $(".js-skills .js-item-header").each(function() {
                hideItemDetail($(this));
            });
        }

        initialTimer = setTimeout(function() {
            var html = `
                            <div class="skills js-skills">
                                <h4 class="text text-info mb-4 js-item-header">Skill ${count +1} <a href="javascript:void" class="ml-3 js-delete-item text-danger">X</a></h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="skill[${count}][name]" class="col-form-label col-lg-2">Name </label>
                                            <div class="col-lg-10">
                                                <input type="text" name="skill[${count}][name]" class="form-control" id="skill[0][name]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="skill[${count}][level]" class="col-form-label col-lg-2">Level </label>
                                            <div class="col-lg-10">
                                                <select name="skill[${count}][level]" id="skill[${count}][level]" class="form-control">
                                                    <option value="">Select Level</option>
                                                    @foreach($skills_levels as $key => $name)
                                                    <option value="{{$key}}">{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `;

            $(html).insertAfter(selector);
        }, 300);
    });

    //add more work  
    $('.js-add-more-work-btn').on('click', function() {
        var selector = $(".js-work-details").last();
        var count = $(".js-work-details").length;
        var initialTimer;

        if (initialTimer) {
            clearTimeout(initialTimer);
        }

        //hide other items details
        if (count > 0) {
            $(".js-work-details .js-item-header").each(function() {
                hideItemDetail($(this));
            });
        }

        initialTimer = setTimeout(function() {
            var html = `
                            <div class="work-details js-work-details">
                                <h4 class="text text-info mb-4 js-item-header">Work Experience ${count + 1} <a href="javascript:void" class="ml-3 js-delete-item text-danger">X</a></h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="work[${count}][company]" class="col-form-label col-lg-3">Company </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="work[${count}][company]" class="form-control" id="work[${count}][company]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="work[${count}][position]" class="col-form-label col-lg-3">Position </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="work[${count}][position]" class="form-control" id="work[${count}][position]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group ">
                                    <label for="work[${count}][summary]" class="col-form-label">Summay </label>
                                    <textarea name="work[${count}][summary]" id="work[${count}][summary]" rows="2" class="form-control"></textarea>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="work[${count}][highlights]" class="col-form-label">Highlights </label>
                                    <textarea name="work[${count}][highlights]" id="work[${count}][summary]" rows="3" class="form-control"></textarea>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="work[${count}][start_date]" class="col-form-label col-lg-3">Start Date </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="work[${count}][start_date]" class="form-control js-calendar" id="work[${count}][start_date]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="work[${count}][end_date]" class="col-form-label col-lg-3">End Date </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="work[${count}][end_date]" class="form-control js-calendar" id="work[${count}][end_date]">
                                                <label for="work[${count}][current]" class="col-form-label"> <input type="checkbox" id="work[${count}][current]" class="js-current-working"> Currently working</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `;


            $(html).insertAfter(selector);

            loadDatepicker();
        }, 300);


    });

    //add more education 
    $('.js-add-more-education-btn').on('click', function() {
        var selector = $(".js-education").last();
        var count = $(".js-education").length;
        var initialTimer;

        if (initialTimer) {
            clearTimeout(initialTimer);
        }

        //hide other items details
        if (count > 0) {
            $(".js-education .js-item-header").each(function() {
                hideItemDetail($(this));
            });
        }

        initialTimer = setTimeout(function() {
            var html = `
                            <div class="education js-education">
                                <h4 class="text text-info mb-4 js-item-header">Degree ${count +1} <a href="javascript:void" class="ml-3 js-delete-item text-danger">X</a></h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="education[${count}][institution]" class="col-form-label col-lg-3">Institution </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="education[${count}][institution]" class="form-control" id="education[${count}][institution]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="education[${count}][area]" class="col-form-label col-lg-3">Area </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="education[${count}][area]" class="form-control" id="education[${count}][area]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="education[${count}][study_type]" class="col-form-label col-lg-3">Study Type </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="education[${count}][study_type]" class="form-control" id="education[${count}][study_type]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="education[${count}][gpa]" class="col-form-label col-lg-3">GPA </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="education[${count}][gpa]" class="form-control" id="education[${count}][gpa]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="education[${count}][start_date]" class="col-form-label col-lg-3">Start Date </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="education[${count}][start_date]" class="form-control js-calendar" id="education[${count}][start_date]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="education[${count}][end_date]" class="col-form-label col-lg-3">End Date </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="education[${count}][end_date]" class="form-control js-calendar" id="education[${count}][end_date]">
                                                <label for="education[${count}][current]" class="col-form-label"> <input type="checkbox" id="education[${count}][current]" class="js-current-studying"> Currently studying</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `;

            $(html).insertAfter(selector);

            loadDatepicker();
        }, 300);


    });

    //add more reference 
    $('.js-add-more-reference-btn').on('click', function() {
        var selector = $(".js-references").last();
        var count = $(".js-references").length;
        var initialTimer;

        if (initialTimer) {
            clearTimeout(initialTimer);
        }

        //hide other items details
        if (count > 0) {
            $(".js-references .js-item-header").each(function() {
                hideItemDetail($(this));
            });
        }

        initialTimer = setTimeout(function() {
            var html = `
                            <div class="references js-references">
                                <h4 class="text text-info mb-4 js-item-header">Reference ${count +1} <a href="javascript:void" class="ml-3 js-delete-item text-danger">X</a></h4>

                                <div class="form-group">
                                    <label for="reference[${count}][name]" class="col-form-label"> Person Name </label>
                                    <input type="text" name="reference[${count}][name]" class="form-control" id="reference[${count}][name]">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="reference[${count}][reference]" class="col-form-label">Reference </label>
                                    <textarea name="reference[${count}][reference]" id="reference[${count}][reference]" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                    `;

            $(html).insertAfter(selector);
        }, 300);
    });

    //delete added item
    $(document).on('click', '.js-delete-item', function(e) {
        e.stopPropagation();
        $(this).parent().parent().remove();
    });

    //toggle item on header click
    $(document).on('click', '.js-item-header', function() {
        toggleItemDetail($(this));
    });

    //toggle Item Details
    function toggleItemDetail(itemHeader) {
        $(itemHeader).toggleClass('border-item');
        $(itemHeader).siblings().toggle();
    }

    //hide Item Details
    function hideItemDetail(itemHeader) {
        $(itemHeader).addClass('border-item');
        $(itemHeader).siblings().hide();
    }
</script>
@endsection