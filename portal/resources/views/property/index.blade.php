@extends('layouts.app')
@section('page-title')
    {{__('Property')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Property')}}</a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @can('create property')
        <a class="btn btn-primary btn-sm ml-20" href="{{ route('property.create') }}" data-size="md"> <i
                class="ti-plus mr-5"></i>{{__('Create Property')}}</a>
    @endcan
@endsection
@section('content')
    <div class="row">
        @foreach($properties as $property)
            @if(!empty($property->thumbnail) && !empty($property->thumbnail->image))
                @php  $thumbnail= $property->thumbnail->image; @endphp
            @else
                @php  $thumbnail= 'default.jpg'; @endphp
            @endif
            <div class="col-xl-3 col-sm-6 cdx-xl-50">
                <div class="card blog-wrapper">
                    <div class="imgwrapper">
                        <img class="img-fluid property-img"
                             src="{{asset(Storage::url('upload/thumbnail')).'/'.$thumbnail}}" alt="{{$property->name}}">
                        <a class="hover-link" href="{{route('property.show',$property->id)}}"><i
                                data-feather="link"></i></a></div>
                    <div class="detailwrapper">
                        <div class="d-flex justify-content-between ">
                            <a href="@can('show property') {{route('property.show',$property->id)}} @endcan">
                                <h4>{{$property->name}}</h4>
                            </a>
                            @if(Gate::check('edit property') || Gate::check('delete property') || Gate::check('show property'))
                            <div class="setting-card action-menu">
                                <div class="action-toggle"><i class="codeCopy" data-feather="more-horizontal"></i></div>
                                <ul class="action-dropdown">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['property.destroy', $property->id]]) !!}
                                    @can('edit property')
                                    <li><a href="{{ route('property.edit',$property->id) }}"><i data-feather="edit">
                                            </i>{{__('Edit property')}}</a>
                                    </li>
                                    @endcan
                                    @can('delete property')
                                    <li class="mr-50">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['property.destroy',
                                        $property->id],'id'=>'property-'.$property->id]) !!}
                                        <a href="#" class="confirm_dialog"> <i data-feather="trash"></i>{{__('Delete
                                            property')}}</a>
                                        {!! Form::close() !!}
                                    </li>
                                    @endcan
                                    @can('show property')
                                    <li>
                                        <a href="{{ route('property.show',$property->id) }}"><i data-feather="eye">
                                         </i>{{__('View property')}}</a>
                                    </li>

                                    @endcan
                                    {{ Form::close() }}
                                </ul>
                            </div>
                            @endif
                        </div>
                            <ul class="blogsoc-list">
                            <li><a href="#"><i data-feather="layers"></i>{{$property->totalUnit()}}  {{__('Unit')}}</a></li>
                            <li><a href="#"><i data-feather="layout"></i>{{$property->totalRoom()}} {{__('Rooms')}}</a></li>
                        </ul>
                        <p class="text-justify">{{substr($property->description, 0, 200)}}{{!empty($property->description)?'...':''}}</p>
                        <div class="blog-footer">
                            <div class="date-info">
                                <span class="badge badge-primary" data-bs-toggle="tooltip"
                                      data-bs-original-title="{{__('Type')}}">{{\App\Models\Property::$Type[$property->type]}}</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

