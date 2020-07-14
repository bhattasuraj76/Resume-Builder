 @php
 $checkSession = Session::has('resume_details') ? 1 : 0;
 $references = $checkSession ? Session::get('resume_details.reference') : [];
 @endphp
 <div class="references-wrapper">
     @if(count($references) > 0)

     @for($i= 0; $i < count($references); $i++) <div class="refereces js-references">
         <h4 class="text text-info mb-4 js-item-header">Reference {{$i + 1}}</h4>

         <div class="form-group">
             <label for="reference[0][name]" class="col-form-label"> Person Name </label>
             <input type="text" name="reference[0][name]" class="form-control" value="@if($checkSession){{$references[$i]['name']}}@endif" id="reference[0][name]">
         </div>
         <hr>
         <div class="form-group">
             <label for="reference[0][reference]" class="col-form-label">Reference </label>
             <textarea name="reference[0][reference]" id="reference[0][reference]" rows="3" class="form-control">@if($checkSession){{$references[$i]['reference']}}@endif</textarea>
         </div>
 </div>
 @endfor

 @else
 <div class="refereces js-references">
     <h4 class="text text-info mb-4 js-item-header">Reference 1</h4>

     <div class="form-group">
         <label for="reference[0][name]" class="col-form-label"> Person Name </label>
         <input type="text" name="reference[0][name]" class="form-control" id="reference[0][name]">
     </div>
     <hr>
     <div class="form-group">
         <label for="reference[0][reference]" class="col-form-label">Reference </label>
         <textarea name="reference[0][reference]" id="reference[0][reference]" rows="3" class="form-control"></textarea>
     </div>
 </div>
 @endif

 <hr class="section-break">
 </div>

 <div class="add-more-btn-wrapper my-5">
     <button class="btn btn-lg btn-outline-primary js-add-more-reference-btn">Add another reference</button>
 </div>