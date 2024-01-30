<div class="card">
    <div class="card-header">Result Upload (Class 9 and 10)</div>
    <div class="card-body">
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
        <div class="form-row mt-sm-2">

                   <div class="col-sm-3">
                     <button type="button" wire:click="" class="btn btn-success mt-3" data-toggle="modal" data-target="#uploadExcelModal">Upload from Excel</button>
                   </div>

                   <div class="col-sm-3">
                         <button type="button"  wire:click.prevent="" class="btn btn-success mt-3" data-toggle="modal" data-target="#deleteModalwithOptions">Delete Result Table</button>
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

                                        <div wire:loading.flex wire:target="excelfile">
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
                                          <button wire:click.prevent="importExcel()" class="btn btn-success"       wire:loading.attr="disabled">Import result</button>
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
               </div><!--excel upload model ends here-->
<!--delete confirmation model start-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#d27979;">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
          <div class="modal-body"> Are you sure you want to empty this result? </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"  wire:loading.attr="disabled">NO</button>
             <button type="button" class="btn btn-danger" wire:click="emptyresult()"   data-dismiss="modal" id="yesofdeleteconfirmation" wire:loading.attr="disabled">yes</button>
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
<!--delete option  model start-->
  <div id="deleteModalwithOptions" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="createModalLabel">Class selection</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true close-btn">×</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form wire:submit.prevent="save">

                    <div class="form-group">
                        <label for="exampleFormControlInput3">Select Class<span class="mustFill">*</span></label>
                        <select class="form-control" id="exampleFormControlInput3" wire:model="selectedClass">
                            <option value="">Select</option>
                            @foreach($resultClassList as $classlist)
                            <option value='{{ $classlist->class}}'>{{ $classlist->class}}</option>
                            @endforeach
                        </select>
                        @error('selectedClass')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Select Section<span class="mustFill">*</span></label>
                        <select class="form-control" id="exampleFormControlInput3" wire:model="selectedSection">
                            <option value="">Select</option>
                            @foreach($resultSectionList as $sectionlist)
                            <option value='{{ $sectionlist->section}}'>{{ $sectionlist->section}}</option>
                            @endforeach
                        </select>
                        @error('selectedSection')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                      <button id="clickmetoshowconfirmationdialog" type="button"  wire:click.prevent="" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal">Empty Result</button>
                      <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal"  wire:loading.attr="disabled">Close</button>

                  </form>
              </div>
          </div>
      </div>
  </div>
<!--delete option  model end-->
<div style="margin:4px;">
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
                            <!--  <th class="nonToogleDisplay header">
                               #
                              </th>
                              <th class="header">
                                <a wire:click.prevent="sortBy('Name')" role="button" href="#" class="nonToogleDisplay">Name
                                    @include('includes._sort-icon',['field'=>'Name'])
                                </a>
                              </th>-->
                              <th class="header">
                                <a wire:click.prevent="sortBy('student_code')" role="button" href="#" class="nonToogleDisplay">Std Code
                                    @include('includes._sort-icon',['field'=>'student_code'])
                                </a>
                              </th>
                              <th class="header">
                                   <a wire:click.prevent="sortBy('index_number')" role="button" href="#">Index No
                                     @include('includes._sort-icon',['field'=>'index_number'])</a>
                                 </th>

                             <th class="header">
                                 <a wire:click.prevent="sortBy('email')" role="button" href="#">Email
                                   @include('includes._sort-icon',['field'=>'email'])</a>
                             </th>
                             <th class="header">
                                 <a wire:click.prevent="sortBy('dzongkha')" role="button" href="#">Dzo
                                   @include('includes._sort-icon',['field'=>'dzongkha'])</a>
                             </th>
                             <th class="header">
                                 <a wire:click.prevent="sortBy('english')" role="button" href="#">Eng
                                   @include('includes._sort-icon',['field'=>'english'])</a>
                             </th>
                             <th class="header">
                                 <a wire:click.prevent="sortBy('math')" role="button" href="#">Math
                                   @include('includes._sort-icon',['field'=>'math'])</a>
                             </th>

                             <th class="header">
                                 <a wire:click.prevent="sortBy('science')" role="button" href="#">Science
                                   @include('includes._sort-icon',['field'=>'science'])</a>
                             </th>
                             <th class="header">
                                   <a wire:click.prevent="sortBy('hcg')" role="button" href="#">HCG
                                     @include('includes._sort-icon',['field'=>'hcg'])</a>
                               </th>
                               <th class="header">
                                   <a wire:click.prevent="sortBy('evs')" role="button" href="#">EVS
                                     @include('includes._sort-icon',['field'=>'evs'])</a>
                               </th>
                               <th class="header">
                                   <a wire:click.prevent="sortBy('average')" role="button" href="#">%
                                     @include('includes._sort-icon',['field'=>'average'])</a>
                               </th>
                               <th class="header">
                                   <a wire:click.prevent="sortBy('remarks')" role="button" href="#">Remarks
                                     @include('includes._sort-icon',['field'=>'remarks'])</a>
                               </th>
                               <th class="header">
                                   <a wire:click.prevent="sortBy('rank')" role="button" href="#">Rank
                                     @include('includes._sort-icon',['field'=>'rank'])</a>
                               </th>
                               <th class="header">
                                   <a wire:click.prevent="sortBy('dues')" role="button" href="#">Dues
                                     @include('includes._sort-icon',['field'=>'dues'])</a>
                               </th>
                               <th class="header">
                                   <a wire:click.prevent="sortBy('class')" role="button" href="#">Class
                                     @include('includes._sort-icon',['field'=>'class'])</a>
                               </th>
                               <th class="header">
                                   <a wire:click.prevent="sortBy('section')" role="button" href="#">Section
                                     @include('includes._sort-icon',['field'=>'section'])</a>
                               </th>
                               <th class="header">
                                   <a wire:click.prevent="sortBy('exam_type')" role="button" href="#">Exam
                                     @include('includes._sort-icon',['field'=>'exam_type'])</a>
                               </th>
                            <!--  <th class="header">
                                Actions
                              </th>-->

                            </thead>
                            <tbody>
                              @foreach($result as $item)
                                <tr>
                                <!--  <td class="nonToogleDisplay"> <img src="{{url('storage/images/staff/'.$item->img_location) }}" class="datatablepic"></td>
                                 <td>{{$item->Name}}</td>-->
                                  <td>{{$item->student_code}}</td>
                                  <td>{{$item->index_number}}</td>
                                  <td>{{$item->email}}</td>
                                  <td>{{$item->dzongkha}}</td>
                                  <td>{{$item->english}}</td>
                                  <td>{{$item->math}}</td>
                                  <td>{{$item->science}}</td>
                                  <td>{{$item->hcg}}</td>
                                  <td>{{$item->evs}}</td>
                                  <td>{{$item->average}}</td>
                                  <td>{{$item->remarks}}</td>
                                  <td>{{$item->rank}}</td>
                                  <td>{{$item->dues}}</td>
                                  <td>{{$item->class}}</td>
                                  <td>{{$item->section}}</td>
                                  <td>{{$item->exam_type}}</td>
                                  <!--<td>
                                    <button wire:click="selectItem({{ $item->id }},'delete')" class="btn btn-danger btn-sm mt-sm-1">Delete</button>
                                     <button wire:click="selectItem({{$item->id}},'update')" class="btn btn-success btn-sm mt-sm-1">Update</button>
                                </td>-->
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
               {{$result->links()}}

             <div class="col text-right text-muted">
               showing {{$result->firstItem()}} to {{$result->LastItem()}} out of {{$result->total()}}
             </div>
  </div>
</div><!--end of card-body-->

</div>
</div>
