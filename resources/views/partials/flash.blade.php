@if (Session::has('flash_msg'))
<div class="alert alert-success {{Session::has('flash_msg_important') ? 'alert-important':''}}">
   @if (Session::has('flash_msg_important'))
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" aria-hidden="true">
    &times;
   </button>
   @endif
  {{session('flash_msg')}}
</div>
@endif
