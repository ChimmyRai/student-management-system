
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Staff Employment Details</div>

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
          <button type="button"  wire:click.prevent="" class="btn btn-success mt-3" data-toggle="modal" data-target="#createModal">Add Employment Details</button>
      </div>
<div class="col-sm-3">
    <button type="button" wire:click="" class="btn btn-success mt-3" data-toggle="modal" data-target="#uploadExcelModal">Upload Employment Details from Excel</button>
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
                <h5 class="modal-title" id="createModalLabel">Staff Employment Details Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form wire:submit.prevent="save">

                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
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
                  </div>

                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Employment Type<span class="mustFill">*</span></label>
                      <select class="form-control" id="exampleFormControlInput3" wire:model="employment_type">
                        <option value="">Select</option>
                        <option value="Permanent">Permanent</option>
                        <option value="Contract">Contract</option>
                        <option value="Substitute">Substitute</option>
                      </select>
                      @error('employment_type')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                    <label for="exampleFormControlInput3">Employee ID<span class="mustFill">*</span></label>
                    <input type="text" wire:model="eid" class="form-control" id="exampleFormControlInput3">
                    @error('eid')<span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="col-sm-4">
                    <label for="exampleFormControlInput3">Employing Agency<span class="mustFill">*</span></label>
                    <input type="text" wire:model="agency" class="form-control" id="exampleFormControlInput3">
                    @error('agency')<span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    </div>

                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Occupational Group<span class="mustFill">*</span></label>
                      <input type="text" wire:model="occupational_group" class="form-control" id="exampleFormControlInput3">
                      @error('occupational_group')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Occupational Subgroup<span class="mustFill">*</span></label>
                      <input type="text" wire:model="occupational_subgroup" class="form-control" id="exampleFormControlInput3">
                      @error('occupational_subgroup')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Job Code<span class="mustFill">*</span></label>
                      <input type="text" wire:model="job_code" class="form-control" id="exampleFormControlInput3">
                      @error('job_code')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                  </div>

                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Service Join Date<span class="mustFill">*</span></label>
                      <input type="date" wire:model="service_join_date" class="form-control" id="exampleFormControlInput3">
                      @error('service_join_date')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Current School Join Date<span class="mustFill">*</span></label>
                      <input type="date" wire:model="current_school_join_date" class="form-control" id="exampleFormControlInput3">
                      @error('current_school_join_date')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Tax Payer No (TPN)<span class="mustFill">*</span></label>
                      <input type="text" wire:model="tpn" class="form-control" id="exampleFormControlInput3">
                      @error('tpn')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-row mt-sm-3">

                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">GIS No<span class="mustFill">*</span></label>
                      <input type="text" wire:model="gis_no" class="form-control" id="exampleFormControlInput3">
                      @error('gis_no')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">NPPF No<span class="mustFill">*</span></label>
                      <input type="text" wire:model="nppf_no" class="form-control" id="exampleFormControlInput3">
                      @error('nppf_no')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Account(BOB)<span class="mustFill">*</span></label>
                      <input type="text" wire:model="bobacc_no" class="form-control" id="exampleFormControlInput3">
                      @error('bobacc_no')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row mt-sm-3">
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Contract Renewable Date<i>(Only for Contract and Substitute Employees)</i></label>
                      <input type="date" wire:model="contract_renewal_last_date" class="form-control" id="exampleFormControlInput3">
                      @error('contract_renewal_last_date')<span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleFormControlInput3">Current School Join Date<i>(Only for Contract and Substitute Employees)</i></label>
                      <input type="date" wire:model="contract_expiry_date" class="form-control" id="exampleFormControlInput3">
                      @error('contract_expiry_date')<span class="text-danger">{{ $message }}</span>
                      @enderror
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
                   <a wire:click.prevent="sortBy('employment_type')" role="button" href="#">Employment Type
                     @include('includes._sort-icon',['field'=>'employment_type'])</a>
                 </th>
                 <th class="nonToogleDisplay header">
                   <a wire:click.prevent="sortBy('eid')" role="button" href="#">Employee ID
                     @include('includes._sort-icon',['field'=>'eid'])</a>
                 </th>
                 <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('agency')" role="button" href="#">Agency
                      @include('includes._sort-icon',['field'=>'agency'])</a>
                  </th>
                <th class="toggleDisplay1 header">
                   <a wire:click.prevent="sortBy('occupational_group')" role="button" href="#">Occupational Group
                     @include('includes._sort-icon',['field'=>'occupational_group'])</a>
                 </th>
                 <th class="toggleDisplay1 header">
                   <a wire:click.prevent="sortBy('occupational_subgroup')" role="button" href="#">Occupational Sub-group
                     @include('includes._sort-icon',['field'=>'occupational_subgroup'])</a>
                 </th>
                 <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('job_code')" role="button" href="#">Job Code
                      @include('includes._sort-icon',['field'=>'job_code'])</a>
                  </th>
                 <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('service_join_date')" role="button" href="#">Service Join Date
                      @include('includes._sort-icon',['field'=>'service_join_date'])</a>
                  </th>
                  <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('current_school_join_date')" role="button" href="#">Current School Join Date
                      @include('includes._sort-icon',['field'=>'current_school_join_date'])</a>
                  </th>
                  <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('tpn')" role="button" href="#">TPN
                      @include('includes._sort-icon',['field'=>'tpn'])</a>
                  </th>

                  <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('gis_no')" role="button" href="#">GIS No
                      @include('includes._sort-icon',['field'=>'gis_no'])</a>
                  </th>
                  <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('nppf_no')" role="button" href="#"  class="toggleDisplay" >NPPF No
                      @include('includes._sort-icon',['field'=>'nppf_no'])</a>
                  </th>
                  <th class="toggleDisplay2 header">
                    <a wire:click.prevent="sortBy('bobacc_no')" role="button" href="#"  class="toggleDisplay" >Account No(BOB)
                      @include('includes._sort-icon',['field'=>'bobacc_no'])</a>
                  </th>
                  <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('contract_renewal_last_date')" role="button" href="#"  class="toggleDisplay" >Contract Renew Date
                      @include('includes._sort-icon',['field'=>'contract_renewal_last_date'])</a>
                  </th>
                  <th class="toggleDisplay1 header">
                    <a wire:click.prevent="sortBy('contract_expiry_date')" role="button" href="#"  class="toggleDisplay" >Contract Expire Date
                      @include('includes._sort-icon',['field'=>'contract_expiry_date'])</a>
                  </th>

                 <th class="header">
                   Actions
                 </th>

               </thead>
               <tbody>
                 @foreach($currentEmploymentDetailsList as $item)
                   <tr>
                     <td class="nonToogleDisplay">    <img src="{{url('storage/images/staff/'.$item->img_location) }}" class="datatablepic"></td>
                     <td class="nonToogleDisplay">{{$item->Name}}</td>
                     <td class="nonToogleDisplay">{{$item->cid}}</td>
                     <td class="toggleDisplay1">{{$item->employment_type}}</td>
                        <td class="nonToogleDisplay">{{$item->eid}}</td>
                     <td class="toggleDisplay1">{{$item->agency}}</td>
                     <td class="toggleDisplay1">{{$item->occupational_group}}</td>
                     <td class="toggleDisplay1">{{$item->occupational_subgroup}}</td>
                     <td class="toggleDisplay1">{{$item->job_code}}</td>
                   <td class="toggleDisplay1">{{\Carbon\Carbon::parse($item->service_join_date)->format('M d Y')}}</td>
                    <td class="toggleDisplay1">{{\Carbon\Carbon::parse($item->current_school_join_date)->format('M d Y')}}</td>
                     <td class="toggleDisplay2">{{$item->tpn}}</td>
                     <td  class="toggleDisplay2">{{$item->gis_no}}</td>
                     <td class="toggleDisplay2">{{$item->nppf_no}}</td>
                    <td class="toggleDisplay2">{{$item->bobacc_no}}</td>

                     @if(is_null($item->contract_renewal_last_date))
                     <td class="toggleDisplay1">
                       -----
                     </td>
                    @elseif(($item->contract_renewal_last_date)->format('M d Y')=='Jan 01 1900')
                     <td class="toggleDisplay1">
                    -----
                     </td>
                  @elseif(($item->contract_renewal_last_date)->format('M d Y')=='Nov 30 -0001')
                     <td class="toggleDisplay1">
                      -------
                     </td>
                     @else
                     <td class="toggleDisplay1">
                    {{\Carbon\Carbon::parse($item->contract_renewal_last_date)->format('M d Y')}}
                     </td>
                     @endif




                     @if(is_null($item->contract_expiry_date))
                     <td class="toggleDisplay1">
                       -----
                     </td>
                     @elseif(($item->contract_expiry_date)->format('M d Y')=='Jan 01 1900')
                     <td class="toggleDisplay1">
                    -----
                     </td>
                     @elseif(($item->contract_expiry_date)->format('M d Y')=='Nov 30 -0001')
                     <td class="toggleDisplay1">
                      -------
                     </td>
                     @else
                     <td class="toggleDisplay1">
                    {{\Carbon\Carbon::parse($item->contract_expiry_date)->format('M d Y')}}
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
  {{$currentEmploymentDetailsList->links()}}

<div class="col text-right text-muted">
  showing {{$currentEmploymentDetailsList->firstItem()}} to {{$currentEmploymentDetailsList->LastItem()}} out of {{$currentEmploymentDetailsList->total()}}
</div>
         </div>
</div><!--end of class="col-md-12"-->
</div><!--class="row justify-content-center"-->
</div><!--end of class="container-fluid"-->
