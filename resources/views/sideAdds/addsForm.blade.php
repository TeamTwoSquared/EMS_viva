@extends('layouts.client_login')

@section('content')
<div class="login-wrap" data-pg-collapsed>
    <div class="login-content">
        <div class="login-logo">
            <a href="#">
                <img src="images/icon/client_logo.png" alt="EMS">
            </a>
        </div>
        <div class="login-form">
            <form action="/svp/sideAdds/store" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Advertiesment Title </label>
                    <input class="au-input au-input--full" type="text" name="title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label>Service Provider Id</label>
                    <input class="au-input au-input--full" type="number" name='id' placeholder="Id number">
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <input class="au-input au-input--full" type="text" name="text_body" placeholder="body">
                </div>
                <div class="row" data-pg-collapsed>
                            <div class="col-lg-9">
                                <div class="card">
                                    <div class="card-header">Upload Your Advertiesment</div>
                                            <div class="form-actions form-group">
                                                <input type="file" id="advertiesment" name="adds" class="form-control-file">
                                            </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Submit Advertiesment</button>
            </form>
        </div>
    </div>
</div>
@endsection