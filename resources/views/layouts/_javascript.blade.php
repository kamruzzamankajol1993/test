
<script src="{{asset('js/material.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/material-kit.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('js/plugins/bootbox.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/plugins/Trumbowyg/dist/trumbowyg.js')}}"></script>
<script>
    $('textarea#textarea').trumbowyg();
</script>
<<<<<<< HEAD
=======
 <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
           <script>
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}','Error',{
                  closeButton:true,
                  progressBar:true,
               });
        @endforeach
    @endif
</script>
>>>>>>> e41b0f37c0be35806ea0b770730430518b285bc5
