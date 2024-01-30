
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Staff Employment History Details</div>

                <div class="card-body">
                  <div class="form-row mt-sm-2">
                        <div class="col-sm-3">
                            <button type="button"  wire:click.prevent="" class="btn btn-success mt-3" data-toggle="modal" data-target="#createModal">Add Staff Employment History details</button>
                        </div>
                  <div class="col-sm-3">
                      <button type="button" wire:click=""  class="btn btn-success mt-3" data-toggle="modal" data-target="#uploadExcelModal">Upload Employment History Details from Excel</button>
                  </div>
                  </div>
                  @if (session()->has('message'))
                  <div class="alert alert-success" style="margin:4px;">
                    {{ session('message') }}
                  </div>
                  @endif

                  @if (session()->has('errormessage'))
                  <div class="alert alert-danger" style="margin:4px;">
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






<!--add details  model start-->
<div wire:ignore.self id="createModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Employment History Details Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <label for="exampleFormControlInput3">Select Staff<span class="mustFill">*</span></label>
                        <select class="form-control" id="exampleFormControlInput3" wire:model="cid">
                            <option value="">Select</option>
                            @foreach($Staff_in_list as $staff)
                            <option value='{{ $staff->cid}}'>{{ $staff->Name}}</option>
                            @endforeach
                        </select>
                        @error('cid')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">School Served<span class="mustFill">*</span></label>
                        <input type="text" wire:model="school" class="form-control" id="exampleFormControlInput3">
                        @error('school')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Dzongkhag<span class="mustFill">*</span></label>
                        <select class="form-control" id="exampleFormControlInput3" wire:model="dzongkhag_served">
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
                        @error('dzongkhag_served')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput3">From<span class="mustFill">*</span></label>
                      <input type="date" wire:model="start_date" class="form-control" id="exampleFormControlInput3">
                      @error('start_date')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">

                      <label for="exampleFormControlInput3">To<span class="mustFill">*</span></label>
                      <input type="date" wire:model="end_date" class="form-control" id="exampleFormControlInput3">
                      @error('end_date')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div wire:loading.table wire:target="store">
                            Saving you data.....
                            <div class="la-line-scale la-dark la-x">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                    </div>
                    <button wire:click.prevent="store()" class="btn btn-success"  wire:loading.attr="disabled">Save</button>
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal"  wire:loading.attr="disabled">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!--end of model to add staff details-->
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


                     @error('excelfile')<span class="text-danger">{{ $message }}</span>
                     @enderror
                   </div>
                   <div wire:loading.table wire:target="excelfile">
                        uploading file....

                   <div style="color: #fdaed4" class="la-line-scale">
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
                         <button wire:click.prevent="importExcel()" class="btn btn-success"  wire:loading.attr="disabled">Import details</button>
                         <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal"  wire:loading.attr="disabled">Close</button>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal"  wire:loading.attr="disabled">NO</button>
        <button type="button" class="btn btn-danger" wire:click="delete()"    wire:loading.attr="disabled">yes</button>
        <div wire:loading.table wire:target="delete">
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
  <div wire:loading.flex wire:target="exportExcel">
        Preparing you download........
          <div class="la-line-scale la-dark la-3x">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
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
                 <th class="header">
                   <a wire:click.prevent="sortBy('staff_employment_details.cid')" role="button" href="#" class="nonToogleDisplay">CID
                       @include('includes._sort-icon',['field'=>'cid'])
                   </a>
                 </th>
                 <th class="header">
                   <a wire:click.prevent="sortBy('school')" role="button" href="#" class="nonToogleDisplay">School served
                       @include('includes._sort-icon',['field'=>'school'])
                   </a>
                 </th>
                 <th class="header">
                   <a wire:click.prevent="sortBy('dzongkhag_served')" role="button" href="#" class="nonToogleDisplay">Dzongkhag
                       @include('includes._sort-icon',['field'=>'dzongkhag_served'])
                   </a>
                 </th>
                 <th class="header">
                   <a wire:click.prevent="sortBy('start_date')" role="button" href="#" class="nonToogleDisplay">From
                       @include('includes._sort-icon',['field'=>'start_date'])
                   </a>
                 </th>
                 <th class="header">
                   <a wire:click.prevent="sortBy('end_date')" role="button" href="#" class="nonToogleDisplay">To
                       @include('includes._sort-icon',['field'=>'end_date'])
                   </a>
                 </th>
                 <th class="header">
                   Actions
                 </th>

               </thead>
               <tbody>
                 @foreach($employmentDetailsList as $item)
                   <tr>
                       <td class="nonToogleDisplay">    <img src="{{url('storage/images/staff/'.$item->img_location) }}" class="datatablepic"></td>
                      <td>{{$item->Name}}</td>
                     <td>{{$item->cid}}</td>
                     <td>{{$item->school}}</td>
                     <td>{{$item->dzongkhag_served}}</td>
                      <td>{{\Carbon\Carbon::parse($item->start_date)->format('M d Y')}}</td>

                       @if(is_null($item->end_date))
                       <td>
                         -----
                       </td>
                      @elseif(($item->end_date)->format('M d Y')=='Jan 01 1900')
                       <td>
                      -----
                       </td>
                    @elseif(($item->end_date)->format('M d Y')=='Nov 30 -0001')
                       <td>
                        -------
                       </td>
                       @else
                       <td>
                      {{\Carbon\Carbon::parse($item->end_date)->format('M d Y')}}
                       </td>
                       @endif
                     <td>


                       <button wire:click="selectItem({{ $item->id }},'delete')" class="btn btn-danger btn-sm mt-sm-1">Delete</button>
                        <button wire:click="selectItem({{$item->id}},'update')" class="btn btn-success btn-sm mt-sm-1">Update</button>

                   </td>
                   </tr>
                 @endforeach

               </tbody>
             </table>
           </div>
  {{$employmentDetailsList->links()}}

<div class="col text-right text-muted">
  showing {{$employmentDetailsList->firstItem()}} to {{$employmentDetailsList->LastItem()}} out of {{$employmentDetailsList->total()}}
</div>
         </div>
</div> <!--end of card body-->

</div><!--class="card"-->

</div><!--end of class="col-md-12"-->
</div><!--class="row justify-content-center"-->
</div><!--end of class="container-fluid"-->
