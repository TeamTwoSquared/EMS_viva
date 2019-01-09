@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="controlAlert alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="controlAlert alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="controlAlert alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        {{session('error')}}
    </div>
@endif

@if(session('warning'))
    <div class="controlAlert alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        {{session('warning')}}
    </div>
@endif

<script>
    setTimeout(function(){
        $('.controlAlert').fadeOut();
    },5000)
</script>