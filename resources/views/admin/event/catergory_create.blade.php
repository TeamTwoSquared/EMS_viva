@extends('layouts.admin')
@section('content')

<div class="row" data-pg-collapsed> 
    <div class="col-xl-12"> 
        <div class="card">              
            <div class="card-header">
                <strong>Add</strong> Category
            </div>
            <div class="card-body card-block"> 
                <form action="store" method="post" enctype="multipart/form-data" class="form-horizontal"> 
                    {{ csrf_field() }}
                    <div class="row form-group"> 
                        <div class="col col-md-3 col-xl-3"> 
                            <label for="text-input" class="form-control-label">Category Name</label>                             
                        </div>                         
                        <div class="col-12 col-md-9"> 
                            <input type="text" id="name" name="name" placeholder="" maxlength="20" class="form-control"> 
                        </div>                         
                    </div>                     
                    <div class="row form-group"> 
                        <div class="col col-md-3">Description</div>                         
                        <div class="col-12 col-md-9"> 
                            <input type="text" name="description" id="description" placeholder="Give a brief catergory description..." class="form-control" maxlength="44" value="">                             
                        </div>                         
                    </div>        
                    <div class="row form-group"> 
                        <div class="col col-md-3">Cover Images&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>                         
                        <div class="col-12 col-md-9"> 
                            <input type="file" id="catergory_images" name="catergory_images[]" multiple class="form-control-file"> 
                        </div>                         
                    </div>                                 
                    <div class="card-footer"> 
                        <button type="submit" class="btn btn-primary btn-sm"> 
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>                 
                        <button type="reset" class="btn btn-danger btn-sm"> 
                            <i class="fa fa-ban"></i> Reset
                        </button>                 
                    </div>
                </form>             
            </div>         
        </div>     
    </div>
</div>
@endsection