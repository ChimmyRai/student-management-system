<div align="left">
    <button type="button"  wire:click.prevent="" class="btn btn-success" data-toggle="modal" data-target="#createModal">Allocate Subject</button>
</div>
<br/>
<div wire:ignore.self id="createModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Subject Allocation Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <label for="exampleFormControlInput3">Teacher</label>
                        <select class="form-control" id="exampleFormControlInput3" wire:model="User_ID">
                            <option value="">Select</option>
                            @foreach($Users_in_list as $User)
                            <option value='{{ $User->id}}'>{{ $User->name}}</option>

                            @endforeach
                        </select>
                        @error('User_ID')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput3">Subject</label>
                        <select class="form-control" id="exampleFormControlInput3" wire:model="Subject">
                            <option value="">Select</option>
                            @foreach($Subjects_in_list as $subject)
                            <option value='{{ $subject->Subject}}'>{{ $subject->Subject}}</option>

                            @endforeach
                        </select>
                        @error('Subject')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlInput3">Class</label>
                        <select class="form-control" id="exampleFormControlInput3" wire:model="Class">
                            <option value="">Select</option>
                            @foreach($Class_in_list as $class)
                            <option value='{{ $class->Class}}'>{{ $class->Class}}</option>

                            @endforeach
                        </select>
                        @error('Class')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="Section">Section</label>
                        <select id="Section" wire:model="Section">
                          <option value="">Select</option>
                          @foreach($SectionList as $key => $value)
                          <option value=' {{$value}}'> {{$value}}</option>

                          @endforeach
                      </select>


                                </select>
                        @error('Section') <span class="text-danger">{{ $Section }}</span> @enderror
                    </div>


                    <button wire:click.prevent="store()" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
