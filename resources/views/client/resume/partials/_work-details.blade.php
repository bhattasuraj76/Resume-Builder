 @php
 $checkSession = Session::has('resume_details') ? 1 : 0;
 $workDetails = $checkSession ? Session::get('resume_details.work') : [];
 @endphp
 <div class="work-details-wrapper">

     @if(count($workDetails) > 0)

     @for($i= 0; $i < count($workDetails); $i++) <div class="work-details js-work-details">
         <h4 class="text text-info mb-4 js-item-header">Work Experience {{$i + 1}}</h4>
         <div class="row">
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="work[0][company]" class="col-form-label col-lg-3">Company </label>
                     <div class="col-lg-9">
                         <input type="text" name="work[0][company]" class="form-control" id="work[0][company]" value="@if($checkSession){{$workDetails[$i]['company']}}@endif">
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="work[0][position]" class="col-form-label col-lg-3">Position </label>
                     <div class="col-lg-9">
                         <input type="text" name="work[0][position]" class="form-control" id="work[0][position]" value="@if($checkSession){{$workDetails[$i]['position']}}@endif">
                     </div>
                 </div>
             </div>
         </div>
         <hr>
         <div class="form-group ">
             <label for="work[0][summary]" class="col-form-label">Summay </label>
             <textarea name="work[0][summary]" id="work[0][summary]" rows="2" class="form-control">@if($checkSession){{$workDetails[$i]['summary']}}@endif</textarea>
         </div>
         <hr>
         <div class="form-group">
             <label for="work[0][highlights]" class="col-form-label">Highlights </label>
             <textarea name="work[0][highlights]" id="work[0][highlights]" rows="3" class="form-control">@if($checkSession){{$workDetails[$i]['highlights']}}@endif</textarea>
         </div>
         <hr>
         <div class="row">
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="work[0][start_date]" class="col-form-label col-lg-3">Start Date </label>
                     <div class="col-lg-9">
                         <input type="text" name="work[0][start_date]" class="form-control js-calendar" id="work[0][start_date]" value="@if($checkSession){{$workDetails[$i]['start_date']}}@endif">
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="work[0][end_date]" class="col-form-label col-lg-3">End Date </label>
                     <div class="col-lg-9">
                         <input type="text" name="work[0][end_date]" class="form-control js-calendar" id="work[0][end_date]" value="@if($checkSession && isset($workDetails[$i]['end_date'])){{$workDetails[$i]['end_date']}}@endif">
                         <label for="work[0][current]" class="col-form-label"> <input type="checkbox" id="work[0][current]" class="js-current-working"> Currently working</label>
                     </div>
                 </div>
             </div>
         </div>
 </div>
 @endfor

 @else
 <div class="work-details js-work-details">
     <h4 class="text text-info mb-4 js-item-header">Work Experience 1</h4>
     <div class="row">
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="work[0][company]" class="col-form-label col-lg-3">Company </label>
                 <div class="col-lg-9">
                     <input type="text" name="work[0][company]" class="form-control" id="work[0][company]">
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="work[0][position]" class="col-form-label col-lg-3">Position </label>
                 <div class="col-lg-9">
                     <input type="text" name="work[0][position]" class="form-control" id="work[0][position]">
                 </div>
             </div>
         </div>
     </div>
     <hr>
     <div class="form-group ">
         <label for="work[0][summary]" class="col-form-label">Summay </label>
         <textarea name="work[0][summary]" id="work[0][summary]" rows="2" class="form-control"></textarea>
     </div>
     <hr>
     <div class="form-group">
         <label for="work[0][highlights]" class="col-form-label">Highlights </label>
         <textarea name="work[0][highlights]" id="work[0][summary]" rows="3" class="form-control"></textarea>
     </div>
     <hr>
     <div class="row">
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="work[0][start_date]" class="col-form-label col-lg-3">Start Date </label>
                 <div class="col-lg-9">
                     <input type="text" name="work[0][start_date]" class="form-control js-calendar" id="work[0][start_date]">
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="work[0][end_date]" class="col-form-label col-lg-3">End Date </label>
                 <div class="col-lg-9">
                     <input type="text" name="work[0][end_date]" class="form-control js-calendar" id="work[0][end_date]">
                     <label for="work[0][current]" class="col-form-label"> <input type="checkbox" id="work[0][current]" class="js-current-working"> Currently working</label>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endif

 <hr class="section-break">
 </div>

 <div class="add-more-btn-wrapper my-5">
     <button class="btn btn-lg btn-outline-primary js-add-more-work-btn">Add another experience</button>
 </div>