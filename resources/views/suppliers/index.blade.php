@extends('layouts.app')
@section('title', '| Suppliers')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">@lang('supplied.title')</div>

        <div class="panel-body">
            <div id="tablePanel">
                <a href="{{url('/suppliers/create')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> @lang('supplied.addprov')
                    </button>
                </a>
            </div>  <!-- end div #tablePanel -->
            <hr>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">@lang('supplied.name')</th>
      <th scope="col">@lang('supplied.address')</th>
      <th scope="col">@lang('supplied.phone')</th>
      <th scope="col">@lang('supplied.fax')</th>
      <th scope="col">@lang('supplied.info')</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($suppliers as $key=>$prov)
    <tr>
      <th scope="row">{{ $key+1 }}</th>
      <td>{{$prov->name}}</td>
      <td>{{$prov->address}}</td>
      <td>{{$prov->phone}}</td>
      <td>{{$prov->fax}}</td>
      <td>{!! $prov->info !!}</td>
      
      <td>
        <a href="{{route('suppliers.edit', $prov->id)}}">
                                <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                        aria-hidden="true"></i> @lang('button.edit')
                                </button>
                            </a>
                            {{Form::open(['route' => ['suppliers.destroy', $prov->id], 'method' => 'DELETE' , 'id' => 'deleteFormProvider'])}}

                            {{Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> '. trans('button.delete'), ['class'=>'btn btn-xs btn-danger deleteBtnProvider', 'type'=>'submit', 'data-id' =>  $prov->id]) }}

                            {{Form::close()}}


      </td>
    </tr>
    @endforeach
  </tbody>
</table>
                   
      {!! $suppliers->render() !!}              
                    </div>
                </div>
           

        </div>  <!-- end div #provideDiv -->
    </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel-->
@endsection
