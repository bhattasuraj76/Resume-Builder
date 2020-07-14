 @php
 $checkSession = Session::has('resume_details') ? 1 : 0;
 $resumeDetails = $checkSession ? Session::get('resume_details') : "";
 @endphp
 <div class="row">
     <div class="col-lg-12">
         <div class="form-group">
             <label for="profession_title" class="col-form-label">Profession Title </label>
             <input type="text" name="profession_title" class="form-control" id="profession_title" value="@if($checkSession && isset($resumeDetails['profession_title'])){{$resumeDetails['profession_title']}}@endif" required>
         </div>
     </div>
     <div class="col-lg-12">
         <label for="profession_summary" class="col-form-label">Professional Summary</label>
         <textarea rows="3" name="profession_summary" class="form-control" id="about" required>@if($checkSession  && isset($resumeDetails['profession_summary'])){{$resumeDetails['profession_summary']}}@endif</textarea>
     </div>
 </div>