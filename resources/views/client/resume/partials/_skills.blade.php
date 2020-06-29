 @php
 $checkSession = Session::has('resume_details') ? 1 : 0;
 $skills = $checkSession ? Session::get('resume_details.skill') : [];
 @endphp

 <div class="skills-wrapper">
     @if(count($skills) > 0)

     @for($i= 0; $i < count($skills); $i++) <div class="skills js-skills">
         <h4 class="text text-info mb-4 js-item-header">Skill {{$i + 1}} </h4>
         <div class="row">
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="skill[0][name]" class="col-form-label col-lg-2">Name </label>
                     <div class="col-lg-10">
                         <input type="text" name="skill[0][name]" class="form-control" value="@if($checkSession){{$skills[$i]['name']}}@endif" id="skill[0][name]">
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="form-group row">
                     <label for="skill[0][level]" class="col-form-label col-lg-2">Level </label>
                     <div class="col-lg-10">
                         <select name="skill[0][level]" id="skill[0][level]" class="form-control">
                             @php
                             $level = $checkSession ? $skills[$i]['level'] : "";
                             @endphp
                             <option value="">Select Level</option>
                             @foreach($skills_levels as $key => $name)
                             <option value="{{$key}}" @if($level == $key){{"selected"}}@endif>{{$name}}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>
             </div>
         </div>
 </div>
 @endfor

 @else
 <div class="skills js-skills">
     <h4 class="text text-info mb-4 js-item-header">Skill 1 </h4>
     <div class="row">
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="skill[0][name]" class="col-form-label col-lg-2">Name </label>
                 <div class="col-lg-10">
                     <input type="text" name="skill[0][name]" class="form-control" id="skill[0][name]">
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="form-group row">
                 <label for="skill[0][level]" class="col-form-label col-lg-2">Level </label>
                 <div class="col-lg-10">
                     <select name="skill[0][level]" id="skill[0][level]" class="form-control">
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
 @endif

 <hr class="section-break">
 </div>

 <div class="add-more-btn-wrapper my-5">
     <button class="btn btn-lg btn-outline-primary js-add-more-skills-btn">Add another skill</button>
 </div>