
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Staff Employment Details</div>

                <div class="card-body">
















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

                   <td>
                        <button wire:click="generatePDF({{$item->cid}})" class="btn btn-success btn-sm mt-sm-1">Download Details (PDF)</button>
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
