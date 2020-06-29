@extends('client.layouts.master')
@section('title', $pageTitle)
@section('content')

<div class="home">
    <div class="welcome-msg-wrapper text-center">
        <h1 class="text  text-secondary font-size-50">Resume Builder</h1>
        <p class="lead text-secondary text-uppercase font-size-30">Build your professional resume in 10 mins</p>
        <a class="btn btn-outline-primary btn-lg font-size-20" href="{{route('resume.choose_template')}}" role="button">Build your resume</a>
    </div>
</div>

@endsection