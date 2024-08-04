@extends('layouts.template')
@section('title-bar') 
    บริษัท ส่งเมล
@endsection
@section('content')
    <p>Dear {{ $name }},</p>
    <p>Please find your receipt attached.</p>
@endsection
@section('custom_javascript')
@endsection