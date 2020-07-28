@extends('layouts.branch-app')
@section('title', '| Branch')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center text-primary" style="font-size: 18px;">{{ $detail->name }}</div>

        <div class="panel-body">
        	<div class="row">
        		<div class="col-md-3">

        		</div>
        		<div class="col-md-6">

        			<center>
        			<img src="{{ asset('/branch-profile/'. $detail->photo )}}" style="height:150px;width:150px;">
        			</center>

        		</div>
        		<div class="col-md-3">

        		</div>
        		
        	</div>
<hr>
        	<div class="row">
        		
        		<div class="col-md-12">

        			<center><h3><b>Branch User Name:</b> {{ $detail->name }}</h3></center>

        		</div>
        		
        	</div>
        	<hr>
        	<div class="row">
        		
        		<div class="col-md-6">

        			<h3><b> Branch User  Email:</b> {{ $detail->email }}</h3>

        		</div>
        		<div class="col-md-6">

        			<h3><b>Branch User Phone:</b> {{ $detail->phone }}</h3>

        		</div>
        		
        	</div>
<hr>
        	<div class="row">
        		
        		<div class="col-md-12 ">

        			<center><h3><b> Branch User  Email:</b> {{ $detail->mpass }}</h3></center>

        		</div>
        		
        		
        	</div>
        	<hr>
        	<div class="row">
        		
        		<div class="col-md-12 ">

        			<center><a href="{{url('/user_profile')}}">
                    <button class="btn btn-md btn-danger" data-id="">Go to Previous Page
                    </button>
                </a></center>

        		</div>
        		
        		
        	</div>
</div>
</div>
@endsection