@extends('layouts.svp')
@section('content')
@php
  session()->forget('default_event');  
@endphp
<div class="row">SVP settings</div>
@endsection