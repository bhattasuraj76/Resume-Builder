 @php
 $checkSession = Session::has('resume_details') ? 1 : 0;
 $resumeDetails = $checkSession ? Session::get('resume_details') : "";
 @endphp
 <div class="row">
     <div class="col-lg-6">
         <div class="form-group row">
             <label for="first_name" class="col-form-label col-lg-3">First Name <span class="text-danger">*</span></label>
             <div class="col-lg-9">
                 <input type="text" name="first_name" class="form-control" id="first_name" value="@if($checkSession && isset($resumeDetails['first_name'])){{$resumeDetails['first_name']}}@endif" required>
             </div>
         </div>
     </div>
     <div class="col-lg-6">
         <div class="form-group row">
             <label for="last_name" class="col-form-label col-lg-3">Last Name <span class="text-danger">*</span></label>
             <div class="col-lg-9">
                 <input type="text" name="last_name" class="form-control" id="last_name" value="@if($checkSession && isset($resumeDetails['last_name'])){{$resumeDetails['last_name']}}@endif" required>
             </div>
         </div>
     </div>
 </div>
 <hr>
 <div class="row">
     <div class="col-lg-6">
         <div class="form-group row">
             <label for="email" class="col-form-label col-lg-3">Email <span class="text-danger">*</span></label>
             <div class="col-lg-9">
                 <input type="email" name="email" class="form-control" id="email" value="@if($checkSession && isset($resumeDetails['email'])){{$resumeDetails['email']}}@endif" required>
             </div>
         </div>
     </div>
     <div class="col-lg-6">
         <div class="form-group row">
             <label for="phone" class="col-form-label col-lg-3">Phone <span class="text-danger">*</span></label>
             <div class="col-lg-9">
                 <input type="text" name="phone" class="form-control" id="phone" value="@if($checkSession && isset($resumeDetails['phone'])){{$resumeDetails['phone']}}@endif" required>
             </div>
         </div>
     </div>
 </div>
 <hr>
 <div class="row">
     <div class="col-lg-6">
         <div class="form-group row">
             <label for="street" class="col-form-label col-lg-3"> Street Address </label>
             <div class="col-lg-9">
                 <input type="text" name="street" class="form-control" id="street" value="@if($checkSession && isset($resumeDetails['street'])){{$resumeDetails['street']}}@endif">
             </div>
         </div>
     </div>
     <div class="col-lg-6">
         <div class="form-group row">
             <label for="postal_code" class="col-form-label col-lg-3">Postal Code </label>
             <div class="col-lg-9">
                 <input type="text" name="postal_code" class="form-control" id="postal_code" value="@if($checkSession && isset($resumeDetails['postal_code'])){{$resumeDetails['postal_code']}}@endif">
             </div>
         </div>
     </div>
 </div>
 <hr>
 <div class="row">
     <div class="col-lg-6">
         <div class="form-group row">
             <label for="city" class="col-form-label col-lg-3">City </label>
             <div class="col-lg-9">
                 <input type="text" name="city" class="form-control" id="city" value="@if($checkSession && isset($resumeDetails['city'])){{$resumeDetails['city']}}@endif">
             </div>
         </div>
     </div>
     <div class="col-lg-6">
         <div class="form-group row">
             <label for="country" class="col-form-label col-lg-3">Country</label>
             <div class="col-lg-9">
                 @php
                 $country = $checkSession && isset($resumeDetails['country']) ? $resumeDetails['country'] : null;
                 @endphp
                 <select name="country" id="country" class="form-control">
                     <option value="">Select Country</option>
                     @foreach($countries as $code => $name)
                     <option value="{{$code}}" @if($code==$country){{"selected"}}@endif>{{$name}}</option>
                     @endforeach
                 </select>
             </div>
         </div>
     </div>
 </div>