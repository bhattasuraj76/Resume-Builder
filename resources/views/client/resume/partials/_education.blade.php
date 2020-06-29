 @php
 $checkSession = Session::has('resume_details') ? 1 : 0;
 $education = $checkSession ? Session::get('resume_details.education') : [];
 @endphp
 <div class="education-wrapper">
     @if(count($education) > 0)

     @for($i= 0; $i < count($education); $i++) <div class="education js-education">
         <h4 class="text text-info mb-4 js-item-header">Degree {{$i + 1}}</h4>
         <div class="row">
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="education[0][institution]" class="col-form-label col-lg-3">Institution </label>
                     <div class="col-lg-9">
                         <input type="text" name="education[0][institution]" class="form-control" id="education[0][institution]" value="@if($checkSession){{$education[$i]['institution']}}@endif">
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="education[0][area]" class="col-form-label col-lg-3">Area </label>
                     <div class="col-lg-9">
                         <input type="text" name="education[0][area]" class="form-control" id="education[0][area]" value="@if($checkSession){{$education[$i]['area']}}@endif">
                     </div>
                 </div>
             </div>
         </div>
         <hr>
         <div class="row">
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="education[0][study_type]" class="col-form-label col-lg-3">Study Type </label>
                     <div class="col-lg-9">
                         <input type="text" name="education[0][study_type]" class="form-control" id="education[0][study_type]" value="@if($checkSession){{$education[$i]['study_type']}}@endif">
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="education[0][gpa]" class="col-form-label col-lg-3">GPA </label>
                     <div class="col-lg-9">
                         <input type="text" name="education[0][gpa]" class="form-control" id="education[0][gpa]" value="@if($checkSession){{$education[$i]['gpa']}}@endif">
                     </div>
                 </div>
             </div>
         </div>
         <hr>
         <div class="row">
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="education[0][start_date]" class="col-form-label col-lg-3">Start Date </label>
                     <div class="col-lg-9">
                         <input type="text" name="education[0][start_date]" class="form-control js-calendar" id="education[0][start_date]" value="@if($checkSession){{$education[$i]['start_date']}}@endif">
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="education[0][end_date]" class="col-form-label col-lg-3">End Date </label>
                     <div class="col-lg-9">
                         <input type="text" name="education[0][end_date]" class="form-control js-calendar" id="education[0][end_date]" value="@if($checkSession && isset($education[$i]['end_date'])){{$education[$i]['end_date']}}@endif">
                         <label for="education[0][current]" class="col-form-label"> <input type="checkbox" id="education[0][current]" class="js-current-studying"> Currently studying</label>
                     </div>
                 </div>
             </div>
         </div>
 </div>
 @endfor

 @else
 <div class="education js-education">
     <h4 class="text text-info mb-4 js-item-header">Degree 1</h4>
     <div class="row">
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="education[0][institution]" class="col-form-label col-lg-3">Institution </label>
                 <div class="col-lg-9">
                     <input type="text" name="education[0][institution]" class="form-control" id="education[0][institution]">
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="education[0][area]" class="col-form-label col-lg-3">Area </label>
                 <div class="col-lg-9">
                     <input type="text" name="education[0][area]" class="form-control" id="education[0][area]">
                 </div>
             </div>
         </div>
     </div>
     <hr>
     <div class="row">
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="education[0][study_type]" class="col-form-label col-lg-3">Study Type </label>
                 <div class="col-lg-9">
                     <input type="text" name="education[0][study_type]" class="form-control" id="education[0][study_type]">
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="education[0][gpa]" class="col-form-label col-lg-3">GPA </label>
                 <div class="col-lg-9">
                     <input type="text" name="education[0][gpa]" class="form-control" id="education[0][gpa]">
                 </div>
             </div>
         </div>
     </div>
     <hr>
     <div class="row">
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="education[0][start_date]" class="col-form-label col-lg-3">Start Date </label>
                 <div class="col-lg-9">
                     <input type="text" name="education[0][start_date]" class="form-control js-calendar" id="education[0][start_date]">
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="education[0][end_date]" class="col-form-label col-lg-3">End Date </label>
                 <div class="col-lg-9">
                     <input type="text" name="education[0][end_date]" class="form-control js-calendar" id="education[0][end_date]">
                     <label for="education[0][current]" class="col-form-label"> <input type="checkbox" id="education[0][current]" class="js-current-studying"> Currently studying</label>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endif
 <hr class="section-break my-0">
 </div>

 <div class="add-more-btn-wrapper my-5">
     <button class="btn btn-lg btn-outline-primary js-add-more-education-btn">Add another degree</button>
 </div>