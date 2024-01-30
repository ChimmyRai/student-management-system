
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Staff Personal Details</div>

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
          <button type="button"  wire:click.prevent="" class="btn btn-success mt-3" data-toggle="modal" data-target="#createModal">Add Staff Details</button>
      </div>
<div class="col-sm-3">
    <button type="button" wire:click="" class="btn btn-success mt-3" data-toggle="modal" data-target="#uploadExcelModal">Upload from Excel</button>
</div>
</div>

<!--model for excel file upload-->
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
                       <div wire:loading.table wire:target="excelfile">
                            Uploading file.......

                             <div style="color: #fdaed4" class="la-line-scale">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                      </div>

                     @error('excelfile')<span class="text-danger">{{ $message }}</span>
                     @enderror
                   </div>
                     <div wire:loading.table wire:target="importExcel">
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
</div><!--end of model for excel file upload-->
<!--add details  model start-->
<div wire:ignore.self id="createModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content" id="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add staff Details Form</h5>
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


                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Citizen ID<span class="mustFill">*</span></label>
                      <input type="text" wire:model="cid" class="form-control" id="exampleFormControlInput3">
                      @error('cid')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                      <div class="col-sm-4">
                        <label for="exampleFormControlInput3">Name<span class="mustFill">*</span></label>
                        <input type="text" wire:model="Name" class="form-control" id="exampleFormControlInput3">
                        @error('Name')<span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-sm-4">
                        <label for="exampleFormControlInput3">Date Of Birth<span class="mustFill">*</span></label>
                        <input type="date" wire:model="dob" class="form-control" id="exampleFormControlInput3">
                        @error('dob')<span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                  </div>


                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Gender<span class="mustFill">*</span></label>
                      <select class="form-control" id="exampleFormControlInput3" wire:model="gender">
                          <option value="">Select Gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                      </select>
                      @error('gender')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Religion<span class="mustFill">*</span></label>
                      <input type="text" wire:model="religion" class="form-control" id="exampleFormControlInput3">
                      @error('religion')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Nationality<span class="mustFill">*</span></label>
                      <input type="text" wire:model="nationality" class="form-control" id="exampleFormControlInput3">
                      @error('nationality')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                  </div>

                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Village<span class="mustFill">*</span></label>
                      <input type="text" wire:model="village" class="form-control" id="exampleFormControlInput3">
                      @error('village')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Gewog<span class="mustFill">*</span></label>
                      <input type="text" wire:model="gewog" class="form-control" id="exampleFormControlInput3">
                      @error('gewog')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Dzongkhag<span class="mustFill">*</span></label>
                      <select class="form-control" id="exampleFormControlInput3" wire:model="dzongkhag">
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
                        <option value="Wangdue Phodrang">Wangdue Phodrang</option>
                        <option value="Zhemgang">Zhemgang</option>

                      </select>
                      @error('dzongkhag')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">House Number</label>
                      <input type="text" wire:model="house_no" class="form-control" id="exampleFormControlInput3">
                      @error('house_no')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Tharm Number</label>
                      <input type="text" wire:model="tharm_no" class="form-control" id="exampleFormControlInput3">
                      @error('tharm_no')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Contact Number(<i>comma seperated list if many</i>)<span class="mustFill">*</span></label>
                      <input type="text" wire:model="phone" class="form-control" id="exampleFormControlInput3">
                      @error('phone')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Email</label>
                      <input type="text" wire:model="email" class="form-control" id="exampleFormControlInput3">
                      @error('email')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-3">
                    </div>
                  </div>

                  <div class="form-row mt-3">
                    <div wire:loading.table wire:target="store">

                          <div style="color: #fdaed4" class="la-line-scale">
                             <div></div>
                             <div></div>
                             <div></div>
                             <div></div>
                             <div></div>
                         </div>
                   </div>
                    <div class="col-sm-6">
                    <button wire:click.prevent="store()" class="btn btn-success" wire:loading.attr="disabled">Save Details</button>
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" wire:loading.attr="disabled">Close</button>
                  </div>

                  </div>
                </form>
            </div>
        </div>
    </div>
</div><!--end of model to add staff details-->

<!--delete confirmation model start-->
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
                <div class="la-line-scale la-dark la-x">
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
<!--end of delete modal-->

</div> <!--end of card body-->

</div><!--class="card"-->
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
      <button  class="btn btn-sm" id="click-me"  data-toggle="button" style=" border: 2px solid #6495ED;">Address Details</button>
      <button  class="btn btn-sm" id="click-me2"  data-toggle="button" style=" border: 2px solid #6495ED;">Personal Details</button>
    </div>
    <div class="col-sm-4  mb-2 text-center">
      Search:&nbsp
      <input wire:model="search" class="form-control" type="text" placeholder="type here to search..">
    </div>
    <div class="col-sm-2 mb-4 text-center">
      Download table:<br/>
        <button type="button" wire:click.prevent="exportExcel()" class="btn btn-success">Download</button>
        <div wire:loading.table wire:target="exportExcel">
                preparing your download........
                <div class="la-line-scale la-dark la-x" style="color: #fdaed4">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                </div>
    </div>


  </div>

  <div class="table-responsive rounded" id="style-2">

  <table class="table table-bordered">




               <thead class="thead-light" style="position:sticky;top:0;">
                 <th class="nonToogleDisplay header">
                  #
                 </th>
                 <th class="header">
                   <a wire:click.prevent="sortBy('Name')" role="button" href="#" class="nonToogleDisplay">Name
                       @include('includes._sort-icon',['field'=>'Name'])
                   </a>
                 </th>
                 <th class="nonToogleDisplay header">
                   <a wire:click.prevent="sortBy('cid')" role="button" href="#">CID
                     @include('includes._sort-icon',['field'=>'cid'])
                   </a>
               </th>

                 <th class="toggleDisplay1 header">
                   <a wire:click.prevent="sortBy('dob')" role="button" href="#">DOB
                     @include('includes._sort-icon',['field'=>'dob'])</a>
                 </th>
                 <th class="toggleDisplay1 header">
                   <a wire:click.prevent="sortBy('gender')" role="button" href="#">Gender
                     @include('includes._sort-icon',['field'=>'gender'])</a>
                 </th>
                 <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('religion')" role="button" href="#">Religion
                      @include('includes._sort-icon',['field'=>'religion'])</a>
                  </th>
                <th class="toggleDisplay1 header">
                   <a wire:click.prevent="sortBy('nationality')" role="button" href="#">Nationality
                     @include('includes._sort-icon',['field'=>'nationality'])</a>
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
                    <a wire:click.prevent="sortBy('house_no')" role="button" href="#">House Number
                      @include('includes._sort-icon',['field'=>'house_no'])</a>
                  </th>
                  <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('tharm_no')" role="button" href="#">Tharm Number
                      @include('includes._sort-icon',['field'=>'tharm_no'])</a>
                  </th>

                  <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('phone')" role="button" href="#">Phone
                      @include('includes._sort-icon',['field'=>'phone'])</a>
                  </th>
                  <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('email')" role="button" href="#"  class="toggleDisplay" >Email
                      @include('includes._sort-icon',['field'=>'email'])</a>
                  </th>

                 <th class="header">
                   Actions
                 </th>

               </thead>
               <tbody>
                 @foreach($staffList as $item)
                   <tr>
                     <td class="nonToogleDisplay">    <img src="{{url('storage/images/staff/'.$item->img_location) }}" class="datatablepic"></td>
                     <td class="nonToogleDisplay">{{$item->Name}}</td>
                     <td class="nonToogleDisplay">{{$item->cid}}</td>
                     <td class="toggleDisplay1">{{\Carbon\Carbon::parse($item->dob)->format('M d Y')}}</td>
                     <td class="toggleDisplay1">{{$item->gender}}</td>
                        <td class="toggleDisplay1">{{$item->religion}}</td>
                     <td class="toggleDisplay1">{{$item->nationality}}</td>
                     <td class="toggleDisplay2">{{$item->village}}</td>
                     <td class="toggleDisplay2">{{$item->gewog}}</td>
                     <td class="toggleDisplay2">{{$item->dzongkhag}}</td>
                    <td class="toggleDisplay2">{{$item->house_no}}</td>
                    <td class="toggleDisplay2">{{$item->tharm_no}}</td>
                     <td class="toggleDisplay1">{{$item->phone}}</td>
                     <td  class="toggleDisplay1">{{$item->email}}</td>
                     <td>
                       <button wire:click="selectItem({{ $item->id }},'delete')" class="btn btn-danger btn-sm mt-sm-1">Delete</button>
                        <button wire:click="selectItem({{$item->id}},'update')" class="btn btn-success btn-sm mt-sm-1">Update</button>
                   </td>
                   </tr>
                 @endforeach

               </tbody>
             </table>
           </div>
  {{$staffList->links()}}

<div class="col text-right text-muted">
  showing {{$staffList->firstItem()}} to {{$staffList->LastItem()}} out of {{$staffList->total()}}
</div>
         </div>
</div><!--end of class="col-md-12"-->
</div><!--class="row justify-content-center"-->
</div><!--end of class="container-fluid"-->
