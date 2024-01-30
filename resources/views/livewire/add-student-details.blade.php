
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Student Information and Details</div>

                <div class="card-body">

                  @if (session()->has('message'))
                  <div class="alert alert-success" style="margin:4px;">
                    {{ session('message') }}
                  </div>
                  @endif

                  @if (session()->has('errormessage'))
                  <div class="alert alert-success" style="margin:4px;">
                    {{ session('errormessage') }}
                  </div>
                  @endif



                  @if (session()->has('errorsImport'))
                  <div class="alert alert-danger" role="alert" id="scrollableAlertDiv">
                    <strong>Errors:</strong>
                    Rows that could not be inserted
                     <ul>
                    @foreach($errorsImport as $errorsImport)

           <li>{{ $errorsImport[0]}}</li>

                    @endforeach
                    </ul>
                    </div>

                    @endif

                    <div class="form-row mt-sm-2">
                               <div class="col-sm-3">
                                     <button type="button"  wire:click.prevent="" class="btn btn-success mt-3" data-toggle="modal" data-target="#createModal">Add Student Details</button>
                               </div>
                               <div class="col-sm-3">
                                 <button type="button" wire:click="$emit('importErrorsDisplayed')" class="btn btn-success mt-3" data-toggle="modal" data-target="#uploadExcelModal">Upload from Excel</button>
                               </div>
                             </div>


<!--excel upload model starts here-->
<div wire:ignore.self id="uploadExcelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content" id="modal-content">

<div class="modal-header">
    <h5 class="modal-title" id="createModalLabel">Upload an excel file</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true close-btn">×</span>
    </button>
</div>

  <div class="modal-body">
    <form wire:submit.prevent="save">
                   @csrf
                   <table>
                     <tr><td>
                       <div class="form-group">
                       <input type="file" id="fileControl" wire:model="excelfile" />


                     @error('excelfile')<span class="text-danger">{{ $message }}</span>
                     @enderror
                     <div wire:loading.flex wire:target="importExcel">
                           Importing from excel file.......

                           <div style="color: #fdaed4" class="la-line-scale">
   <div></div>
   <div></div>
   <div></div>
   <div></div>
   <div></div>
</div>
                        </div>

                   </td>
                     <td>

                     </td>

                   </tr>


                     <tr>
                       <td>
                          <div class="form-group">
                         <button wire:click.prevent="importExcel()" class="btn btn-success"       wire:loading.attr="disabled">Import details</button>
                         <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" wire:loading.attr="disabled">Close</button>
                        </div>
                       </td>

                     </tr>
                   </table>

                   <br/>


    </form>
  </div>

</div>
</div>
</div>
</div>
<!--add details  model start-->
<div wire:ignore.self id="createModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content" id="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Student Details Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form wire:submit.prevent="save">
                  <div class="form-row mt-2">
                    <div class="col-sm-6">
                      here will go the image
                    </div>
                    <div class="col-sm-6">
                      <!-- actual upload which is hidden -->
<input type="file" id="actual-btn" wire:model="photo" hidden />

<!-- our custom upload button -->
<label for="actual-btn" id="labelforinput">  <i class="fas fa-image fa-lg" ></i>Choose photo</label>
<!-- name of file chosen -->
<span id="file-chosen">No file chosen</span>
                      @error('photo')<span class="text-danger">{{ $message }}</span>
                      @enderror
                      {{$modelId}}
                    </div>
                  </div>

                  <div class="form-row mt-sm-2">
                             <div class="col-sm-3">
                               <label for="exampleFormControlInput1">Student Code<span class="mustFill">*</span></label>
                               <input type="text" wire:model="student_code" class="form-control" id="exampleFormControlInput1">
                               @error('student_code')<span class="text-danger">{{ $message }}</span>
                               @enderror
                             </div>
                             <div class="col-sm-3">
                               <label for="exampleFormControlInput2">Index No.<span class="mustFill">*</span></label>
                               <input type="text" wire:model="index_number" class="form-control" id="exampleFormControlInput2">
                               @error('index_number')<span class="text-danger">{{ $message }}</span>
                               @enderror
                             </div>
                             <div class="col-sm-3">
                               <label for="exampleFormControlInput4">Admission No.<span class="mustFill">*</span></label>
                               <input type="text" wire:model="adm_no" class="form-control" id="exampleFormControlInput4">
                               @error('adm_no')<span class="text-danger">{{ $message }}</span>
                               @enderror
                             </div>
                             <div class="col-sm-3">
                               <label for="exampleFormControlInput3">Name<span class="mustFill">*</span></label>
                               <input type="text" wire:model="Name" class="form-control" id="exampleFormControlInput3">
                               @error('Name')<span class="text-danger">{{ $message }}</span>
                               @enderror
                             </div>


                      </div>

                      <div class="form-row  mt-sm-4">
                                 <div class="col-sm-4">
                                   <label for="exampleFormControlInput3">Citizen ID No.</label>
                                   <input type="text" wire:model="cid_no" class="form-control" id="exampleFormControlInput3">
                                   @error('cid_no')<span class="text-danger">{{ $message }}</span>
                                   @enderror
                                 </div>
                                 <div class="col-sm-4">
                                   <label for="exampleFormControlInput6">Date Of Birth<span class="mustFill">*</span></label>
                                   <input type="date" wire:model="dob" class="form-control" id="exampleFormControlInput6">
                                   @error('dob')<span class="text-danger">{{ $message }}</span>
                                   @enderror
                                 </div>
                                 <div class="col-sm-2">
                                   <label for="exampleFormControlInput15">Gender<span class="mustFill">*</span></label>
                                   <select class="form-control" id="exampleFormControlInput5" wire:model="gender">
                                       <option value="">Select Gender</option>
                                       <option value="male">Male</option>
                                       <option value="female">Female</option>
                                   </select>
                                   @error('gender')<span class="text-danger">{{ $message }}</span>
                                   @enderror
                                 </div>

                                 <div class="col-sm-2">
                                   <label for="exampleFormControlInput15">Blood Group<span class="mustFill">*</span></label>
                                   <select class="form-control" id="exampleFormControlInput5" wire:model="blood_group">
                                       <option value="">Select</option>
                                       <option value="A+">A+</option>
                                       <option value="B+">B+</option>
                                        <option value="AB+">AB+</option>
                                         <option value="O+">O+</option>
                                         <option value="A-">A-</option>
                                         <option value="B-">B-</option>
                                          <option value="AB-">AB-</option>
                                           <option value="O-">O-</option>

                                   </select>
                                   @error('blood_group')<span class="text-danger">{{ $message }}</span>
                                   @enderror
                                 </div>

                          </div>

                            <div class="form-row  mt-sm-4">
                              <div class="col-sm-4">
                                <label for="exampleFormControlInput7">Email<span class="mustFill">*</span></label>
                                <input type="text" wire:model="email" class="form-control" id="exampleFormControlInput7">
                                @error('email')<span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-sm-2">
                                <label for="exampleFormControlInput8">Class<span class="mustFill">*</span></label>
                                <select class="form-control" id="exampleFormControlInput8" wire:model="current_class">
                                  <option value="">Selct Class</option>
                                  <option value="PP">PP</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                </select>
                                @error('current_class')<span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-sm-2">
                                <label for="exampleFormControlInput9">Stream<span class="mustFill">*</span></label>
                                <select class="form-control" id="exampleFormControlInput9" wire:model="stream">
                                  <option value="">Select Stream</option>
                                  <option value="General">General</option>
                                  <option value="Science">Science</option>
                                  <option value="Commerce">Commerce</option>
                                  <option value="Arts">Arts</option>
                                </select>
                                @error('stream')<span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-sm-2">
                                <label for="exampleFormControlInput10">Section<span class="mustFill">*</span></label>
                                <select class="form-control" id="exampleFormControlInput10" wire:model="current_section">
                                  <option value="">Select Section</option>
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="C">C</option>
                                  <option value="D">D</option>
                                  <option value="E">E</option>
                                  <option value="F">F</option>
                                  <option value="G">G</option>
                                  <option value="H">H</option>
                                  <option value="I">I</option>
                                  <option value="J">J</option>
                                  <option value="K">K</option>
                                </select>
                                @error('current_section')<span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-sm-2">
                                <label for="exampleFormControlInput11">House<span class="mustFill">*</span></label>
                                <select class="form-control" id="exampleFormControlInput11" wire:model="house">
                                  <option value="">Select House</option>
                                  <option value="Dongemtse">Dongemtse</option>
                                  <option value="Jarog">Jarog</option>
                                  <option value="Tshenden">Tshenden</option>
                                  <option value="Tsherngoen">Tsherngoen</option>
                                </select>
                                @error('house')<span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>

                            </div>
                            <div class="form-row mt-sm-4">

                              <div class="col-sm-2">
                                <label for="exampleFormControlInput12">Border/Dayscholar<span class="mustFill">*</span></label>
                                <select class="form-control" id="exampleFormControlInput12" wire:model="hostel_status">
                                  <option value="">Select</option>
                                  <option value="Border">Border</option>
                                  <option value="Dayscholar">Dayscholar</option>
                                </select>
                                  @error('hostel_status')<span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                              <div class="col-sm-3">
                                <label for="exampleFormControlInput13">Date of Joining School<span class="mustFill">*</span></label>
                                <input type="date" wire:model="date_of_joining_school" class="form-control" id="exampleFormControlInput13">
                                @error('date_of_joining_school')<span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-sm-3">
                                <label for="exampleFormControlInput14">Class when Joined<span class="mustFill">*</span></label>
                                <input type="text" wire:model="class_when_joining_school" class="form-control" id="exampleFormControlInput14">
                                @error('class_when_joining_school')<span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-sm-4">
                                <label for="exampleFormControlInput15">Previous Schools <i>(comma seperated list if many</i>)</label>
                                <input type="text" wire:model="previous_schools" class="form-control" id="exampleFormControlInput15">
                                @error('previous_schools')<span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>

                            </div>
                              <div class="form-row mt-sm-4">
                                <div class="col-sm-4">
                                  <label for="exampleFormControlInput16">Village<span class="mustFill">*</span></label>
                                  <input type="text" wire:model="village" class="form-control" id="exampleFormControlInput16">
                                  @error('village')<span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="col-sm-4">
                                  <label for="exampleFormControlInput17">Gewog<span class="mustFill">*</span></label>
                                  <input type="text" wire:model="gewog" class="form-control" id="exampleFormControlInput17">
                                  @error('gewog')<span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="col-sm-4">
                                  <label for="exampleFormControlInput18">Dzongkhag<span class="mustFill">*</span></label>
                                  <select class="form-control" id="exampleFormControlInput18" wire:model="dzongkhag">
                                    <option value="">Select</option>
                                    <option value="Bumthang">Bumthang</option>
                                    <option value="Chhukha">Chhukha</option>
                                    <option value="Dagana">Dagana</option>
                                    <option value="Gasa">Gasa</option>
                                    <option value="Haa">Haa</option>
                                    <option value="Lhuentse">Lhuentse</option>
                                    <option value="Mongar">Mongar</option>
                                    <option value="Paro">Paro</option>
                                    <option value="Pema Gatshel">Pema Gatshel</option>
                                    <option value="Punakha">Punakha</option>
                                    <option value="Samdrup Jongkhar">Samdrup Jongkhar</option>
                                    <option value="Samtse">Samtse</option>
                                    <option value="Sarpang">Sarpang</option>
                                    <option value="Tashi Yangtse">Tashi Yangtse</option>
                                    <option value="Trashigang">Trashigang</option>
                                    <option value="Trongsa">Trongsa</option>
                                    <option value="Tsirang">Tsirang</option>
                                    <option value="Tsirang">Thimphu</option>
                                    <option value="Wangdue Phodrang">Wangdue Phodrang</option>
                                    <option value="Zhemgang">Zhemgang</option>

                                  </select>
                                  @error('dzongkhag')<span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>


                              </div>

                                <div class="form-row mt-sm-4">
                                  <div class="col-sm-3">
                                    <label for="exampleFormControlInput19">Mother's Name</label>
                                    <input type="text" wire:model="mother_name" class="form-control" id="exampleFormControlInput19">
                                    @error('mother_name')<span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-sm-3">
                                    <label for="exampleFormControlInput20">Father's Name</label>
                                    <input type="text" wire:model="father_name" class="form-control" id="exampleFormControlInput20">
                                    @error('father_name')<span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-sm-3">
                                    <label for="exampleFormControlInput21">Guardian's Contact No.<span class="mustFill">*</span></label>
                                    <input type="text" wire:model="guardian_contact" class="form-control" id="exampleFormControlInput21">
                                    @error('guardian_contact')<span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-sm-3">
                                    <label for="exampleFormControlInput21">Student's Contact No.</label>
                                    <input type="text" wire:model="self_contact" class="form-control" id="exampleFormControlInput21">
                                    @error('self_contact')<span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="form-row mt-sm-4">
                                  <div class="col-sm-2">
                                    <label for="exampleFormControlInput11">Kidu<span class="mustFill">*</span></label>
                                    <select class="form-control" id="exampleFormControlInput11" wire:model="kidu_receipent">
                                      <option value="">Select</option>
                                      <option value="No">No</option>
                                      <option value="Yes">Yes</option>
                                    </select>
                                    @error('kidu_receipent')<span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-sm-2">
                                    <label for="exampleFormControlInput11">Differently Abled<span class="mustFill">*</span></label>
                                    <select class="form-control" id="exampleFormControlInput11" wire:model="differently_abled">
                                          <option value="">Select</option>
                                      <option value="No" selected>No</option>
                                      <option value="Yes">Yes</option>
                                    </select>
                                    @error('differently_abled')<span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>

                                </div>

                                <div class="form-row mt-4">
                                  <div class="col-sm-6">
                                  <button wire:click.prevent="store()" class="btn btn-success" wire:loading.attr="disabled">Save Details</button>
                                  <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" wire:loading.attr="disabled">Close</button>
                                </div>
                                </div>
</form>
                  </div>

            </div>
        </div>
    </div>


<!--till here the create model-->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#d27979;">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body"> Are you sure you want to delete this record? </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button type="button" class="btn btn-danger" wire:click="delete()">yes</button>
        <div wire:loading.flex wire:target="delete">
                Deleting........
                <div class="la-line-scale la-dark la-3x">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                </div>
    </div>
  </div>
</div>
</div>

<!--deleted modal ends here-->


</div>

<div>


    <div class="form-row mt-sm-3">
      <div class="col-sm-2 mb-2 text-center">
        Per page:&nbsp

        <select class="form-control" id="exampleFormControlInput3" wire:model="showperpage">
          <option>5</option>
            <option>10</option>
              <option>20</option>
              <option>50</option>
                <option>100</option>

        </select>
      </div>
      <div class="col-sm-4  mb-2 text-center">
        Information type:
        <br/>
        <button  class="btn btn-sm" id="click-meForAll"  data-toggle="button" style=" border: 2px solid #6495ED;">All</button>
        <button  class="btn btn-sm" id="click-me"  data-toggle="button" style=" border: 2px solid #6495ED;">Biodata Related information</button>
        <button  class="btn btn-sm" id="click-me2"  data-toggle="button" style=" border: 2px solid #6495ED;">School Related information</button>
      </div>
      <div class="col-sm-4  mb-2 text-center">
        Search:&nbsp
        <input wire:model="search" class="form-control" type="text" placeholder="type here to search..">
      </div>
      <div class="col-sm-2 mb-4 text-center">
        Download table:<br/>
          <button type="button" wire:click.prevent="exportExcel()" class="btn btn-success">Download</button>
      </div>


    </div>

  <div class="table-responsive " id="style-2">

  <table class="table table-bordered">




               <thead class="thead-light" style="position:sticky;top:0;">
                 <th class="nonToogleDisplay header">
                  #
                 </th>
                 <th class="nonToogleDisplay header">
                   <a wire:click.prevent="sortBy('Name')" role="button" href="#" >Name
                       @include('includes._sort-icon',['field'=>'Name'])
                   </a>
                 </th>
                 <th class="toggleDisplay1 header">
                   <a wire:click.prevent="sortBy('student_code')" role="button" href="#">Std Code
                        @include('includes._sort-icon',['field'=>'student_code'])
                   </a>
                 </th>
                 <th class="toggleDisplay1 header">
                   <a wire:click.prevent="sortBy('index_number')" role="button" href="#">Index No
                     @include('includes._sort-icon',['field'=>'index_number'])
                   </a>
               </th>
               <th class="toggleDisplay1 header">
                 <a wire:click.prevent="sortBy('adm_no')" role="button" href="#">Admission No
                   @include('includes._sort-icon',['field'=>'adm_no'])
                 </a>
             </th>
                 <th class="toggleDisplay2 header">
                   <a wire:click.prevent="sortBy('cid_no')" role="button" href="#">CID
                     @include('includes._sort-icon',['field'=>'cid_no'])
                   </a>
               </th>
               <th class="toggleDisplay1 header">
                 <a wire:click.prevent="sortBy('email')" role="button" href="#">Email
                   @include('includes._sort-icon',['field'=>'email'])</a>
               </th>
               <th class="toggleDisplay2 header">
                 <a wire:click.prevent="sortBy('gender')" role="button" href="#">Gender
                   @include('includes._sort-icon',['field'=>'gender'])</a>
               </th>
               <th class="toggleDisplay2 header">
                 <a wire:click.prevent="sortBy('blood_group')" role="button" href="#">Blood Group
                   @include('includes._sort-icon',['field'=>'blood_group'])</a>
               </th>
                 <th class="toggleDisplay2 header">
                   <a wire:click.prevent="sortBy('dob')" role="button" href="#">DOB
                     @include('includes._sort-icon',['field'=>'dob'])</a>
                 </th>
                 <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('current_class')" role="button" href="#">Class
                      @include('includes._sort-icon',['field'=>'current_class'])</a>
                  </th>
                  <th class="toggleDisplay1 header">
                         <a wire:click.prevent="sortBy('current_section')" role="button" href="#">Section
                         @include('includes._sort-icon',['field'=>'current_section'])</a>
                     </th>
                <th class="toggleDisplay1 header">
                       <a wire:click.prevent="sortBy('house')" role="button" href="#">House
                         @include('includes._sort-icon',['field'=>'house'])</a>
                </th>

                <th class="toggleDisplay1 header">
                  <a wire:click.prevent="sortBy('hostel_status')" role="button" href="#">Border/Dayscholar
                    @include('includes._sort-icon',['field'=>'hostel_status'])</a>
                </th>
                <th class="toggleDisplay1 header">
                  <a wire:click.prevent="sortBy('date_of_joining_school')" role="button" href="#">School jOining Date
                    @include('includes._sort-icon',['field'=>'date_of_joining_school'])</a>
                </th>

                <th class="toggleDisplay1 header">
                  <a wire:click.prevent="sortBy('class_when_joining_school')" role="button" href="#">Class When Joining
                    @include('includes._sort-icon',['field'=>'class_when_joining_school'])</a>
                </th>
                <th class="toggleDisplay1 header">
                  <a wire:click.prevent="sortBy('previous_schools')" role="button" href="#">Previous School
                    @include('includes._sort-icon',['field'=>'previous_schools'])</a>
                </th>
                 <th class="toggleDisplay2 header">
                   <a wire:click.prevent="sortBy('village')" role="button" href="#">Village
                     @include('includes._sort-icon',['field'=>'village'])</a>
                 </th>
                 <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('gewog')" role="button" href="#">Gewog
                      @include('includes._sort-icon',['field'=>'gewog'])</a>
                  </th>
                 <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('dzongkhag')" role="button" href="#">Dzongkhag
                      @include('includes._sort-icon',['field'=>'dzongkhag'])</a>
                  </th>
                  <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('mother_name')" role="button" href="#">Mother
                        @include('includes._sort-icon',['field'=>'mother_name'])
                    </a>
                  </th>
                  <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('father_name')" role="button" href="#">Father
                        @include('includes._sort-icon',['field'=>'father_name'])
                    </a>
                  </th>

                  <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('guardian_contact')" role="button" href="#">Guardian's Contact
                      @include('includes._sort-icon',['field'=>'guardian_contact'])</a>
                  </th>
                  <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('self_contact')" role="button" href="#">Student's Contact
                      @include('includes._sort-icon',['field'=>'self_contact'])</a>
                  </th>
                  <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('kidu_receipent')" role="button" href="#">Kidu Receipent
                      @include('includes._sort-icon',['field'=>'kidu_receipent'])</a>
                  </th>
                  <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('differently_abled')" role="button" href="#">Differently Abled
                      @include('includes._sort-icon',['field'=>'differently_abled'])</a>
                  </th>


                 <th class="header">
                   Actions
                 </th>

               </thead>
               <tbody>
                 @foreach($studentList as $item)
                   <tr>
                     <td class="nonToogleDisplay">    <img src="{{url('storage/images/student/'.$item->img_location) }}" class="datatablepic"></td>
                     <td class="nonToogleDisplay">{{$item->Name}}</td>
                     <td class="toggleDisplay1">{{$item->student_code}}</td>
                      <td class="toggleDisplay1">{{$item->index_number}}</td>
                      <td class="toggleDisplay1">{{$item->adm_no}}</td>
                     <td class="toggleDisplay2">{{$item->cid_no}}</td>
                      <td  class="toggleDisplay1">{{$item->email}}</td>
                      <td class="toggleDisplay2">{{$item->gender}}</td>
                        <td class="toggleDisplay2">{{$item->blood_group}}</td>
                      <td class="toggleDisplay2">{{\Carbon\Carbon::parse($item->dob)->format('M d Y')}}</td>
                     <td class="toggleDisplay1">{{$item->current_class}}</td>
                     <td class="toggleDisplay1">{{$item->current_section}}</td>
                     <td class="toggleDisplay1">{{$item->house}}</td>
                      <td class="toggleDisplay1">{{$item->hostel_status}}</td>
                      <td class="toggleDisplay1">{{\Carbon\Carbon::parse($item->date_of_joining_school)->format('M d Y')}}</td>
                    <td class="toggleDisplay1">{{$item->class_when_joining_school}}</td>
                    <td class="toggleDisplay1">{{$item->previous_schools}}</td>
                     <td class="toggleDisplay2">{{$item->village}}</td>
                     <td class="toggleDisplay2">{{$item->gewog}}</td>
                     <td class="toggleDisplay2">{{$item->dzongkhag}}</td>
                     <td class="toggleDisplay2">{{$item->mother_name}}</td>
                     <td class="toggleDisplay2">{{$item->father_name}}</td>
                     <td class="toggleDisplay2">{{$item->guardian_contact}}</td>
                      <td class="toggleDisplay2">{{$item->self_contact}}</td>
                      <td class="toggleDisplay1">{{$item->kidu_receipent}}</td>
                      <td class="toggleDisplay1">{{$item->differently_abled}}</td>

                     <td>
                       <button wire:click="selectItem({{ $item->id }},'delete')" class="btn btn-danger btn-sm mt-sm-1">Delete</button>
                        <button wire:click="selectItem({{$item->id}},'update')" class="btn btn-success btn-sm mt-sm-1">Update</button>
                        <button wire:click="showStudentDetailsIndividual({{$item->id}})" class="btn btn-success btn-sm mt-sm-1">View</button>
                   </td>
                   </tr>
                 @endforeach

               </tbody>
             </table>
           </div>
  {{$studentList->links()}}

<div class="col text-right text-muted">
  showing {{$studentList->firstItem()}} to {{$studentList->LastItem()}} out of {{$studentList->total()}}
</div>
         </div>


</div>
</div>
</div>
