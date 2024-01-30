<div class="card">
    <div class="card-header">Download Result</div>
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
        <form>

            <div class="form-group">
                <label for="exampleFormControlInput3">Select level<span class="mustFill">*</span></label>
                  <select class="form-control" id="exampleFormControlInput3" wire:model="classlevel">
                    <option value="Lower">Lower</option>
                    <option value="Middle">Middle</option>
                    <option value="Higher Science">Higher Science</option>
                    <option value="Higher Arts">Higher Arts</option>
                    <option value="Higher Commerce">Higher Commerce</option>
                </select>
                @error('classlevel')<span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @if(!is_null($classlist))
            <div class="form-group">
                <label for="exampleFormControlInput3">Select class<span class="mustFill">*</span></label>
                <select class="form-control" id="exampleFormControlInput3" wire:model="selectedClass" wire:loading.attr="disabled">
                     <option value="" selected>Choose A class</option>
                    @foreach($classlist as $item)
                    <option value='{{ $item->class}} {{ $item->section}}'>{{ $item->class}} {{ $item->section}}</option>
                    @endforeach
                </select>
                @error('selectedClass')<span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
          @endif


            <div wire:loading.table wire:target="download">
                    Downloading result.....
                    <div class="la-line-scale la-dark la-x">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
            </div>

              {{$selectedClass}}

            <button wire:click.prevent="download()" class="btn btn-success"  wire:loading.attr="disabled">Donwload</button>

        </form>


</div><!--end of card-body-->

</div>
</div>
