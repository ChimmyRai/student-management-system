
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Subject Allocation Detials</div>
                <div class="card-body">


@include('livewire.create-allocated-subjects',['Users_in_list'=>$Users_in_list,'Subjects_in_list'=>$Subjects_in_list,'Class_in_list'=>$Class_in_list,'SectionList'=>$SectionList])
<div>

  @if(Session::has('message'))
    <div id='successMessage' class='alert alert-success'>{{session('message')}}</div>
  @endif
  @if(Session::has('errormessage'))
    <div id='successMessage' class='alert alert-danger'>{{session('errormessage')}}</div>
  @endif
  <div class='row mb-4'>
    <div class='col-3'>
      Per page:&nbsp

      <select class="form-control" id="exampleFormControlInput3" wire:model="showperpage">
        <option>5</option>
          <option>10</option>
            <option>20</option>
            <option>50</option>
              <option>100</option>

      </select>
    </div>
      <div class='col-5'>
      </div>
    <div class='col-4'>
  Search:&nbsp
  <input wire:model="search" class="form-control" type="text" placeholder="type here to search..">
</div>
  </div>

<div class="table-responsive">

<table class="table table-striped">




             <thead>
               <th>
                 <a wire:click.prevent="sortBy('Name_of_teacher')" role="button" href="#">Teacher
                   @include('includes._sort-icon',['field'=>'Name_of_teacher'])
                 </a>
             </th>
               <th>
                 <a wire:click.prevent="sortBy('Subject')" role="button" href="#">Subject
                      @include('includes._sort-icon',['field'=>'Subject'])
                 </a>
               </th>
               <th>
                 <a wire:click.prevent="sortBy('Class')" role="button" href="#">Class
                     @include('includes._sort-icon',['field'=>'Class'])
                 </a>
               </th>
               <th>
                 <a wire:click.prevent="sortBy('Section')" role="button" href="#">Section</a>
               </th>
               <th>Periods</th>
               <th>Actions</th>

             </thead>
             <tbody>
               @foreach($allocatedList as $item)
                 <tr>
                   <td>{{$item->Name_of_teacher}}</td>
                   <td>{{$item->Subject}}</td>
                     <td>{{$item->Class}}</td>
                   <td>{{$item->Section}}</td>
                   <td>{{$item->Number_of_periods}}</td>
                   <td>
                     <button wire:click="delete({{ $item->id }})" class="btn btn-danger btn-sm">Delete</button>
                 </td>
                 </tr>
               @endforeach

             </tbody>
           </table>
         </div>
{{$allocatedList->links()}}
<div class="col text-right text-muted">
  showing {{$allocatedList->firstItem()}} to {{$allocatedList->LastItem()}} out of {{$allocatedList->total()}}
</div>
         </div>


</div>
</div>
</div>
</div>
</div>
