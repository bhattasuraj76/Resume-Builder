<?php



Route::get('generate-docs', function () {

    $headers = array(
        "Content-type" => "text/html",
        "Content-Disposition" => "attachment;Filename=myGeneratefile.doc"
    );



    $content = '<html>

            <head><meta charset="utf-8"></head>

            <body>

                <p>My Blog - Nicesnippets.com</p>

                <ul><li>Php</li><li>Laravel</li><li>Html</li></ul>

            </body>

            </html>';



    return \Response::make($content, 200, $headers);
});

/** Auth routes */
Route::group(['namespace' => 'Auth'], function(){
    Route::any(  '/register',  ['uses' => 'RegisterController@handleRegister', 'as' => 'register']);
    Route::any('/login',  ['uses' => 'LoginController@handleLogin',  'as' => 'login']);
    Route::post('/logout',  ['uses' => 'LoginController@logout',  'as' => 'logout']);

    /** Social login routes */
    Route::get('/login/{provider}',  ['uses' => 'SocialController@redirect']);
    Route::get('/login/{provider}/callback',  ['uses' => 'SocialController@Callback']);
});


/** Client routes */
Route::group(['namespace' => 'Front'], function () {
    /** Page Routes */
    Route::get('/', [ 'uses' => 'HomeController@index', 'as' => 'home']);
    Route::redirect('/home', '/');

    /** Resume routes */
    Route::group(['as' => 'resume.'], function () {
        Route::any('/choose-template', ['uses' => 'ResumeController@chooseTemplate', 'as' => 'choose_template']);
        Route::any('/resume-details', ['uses' => 'ResumeController@resumeDetails', 'as' => 'resume_details']);
        Route::any('/resume-preview', ['uses' => 'ResumeController@resumePreview', 'as' => 'resume_preview']);
        Route::get('/template-parsed-view', ['uses' => 'ResumeController@fetchTemplateParsedView', 'as' => 'template_parsed_view']);
        Route::get('/resume/download', ['uses' => 'ResumeController@resumeDownload', 'as' => 'download']);
        
    });
});


Route::view('/*', 'errors.404');