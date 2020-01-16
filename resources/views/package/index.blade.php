@extends('layouts.admin')
@section('content')

@endsection

@section('left_content')
    <div class="bg_white">
        <form method="get" action="{{route('package_tickets.index')}}">
            <div class="box_left_content">
                <div class="title_letf">Tìm kiếm</div>
                <div class="input-group input-group-sm col_content" style="">
                    <input type="text" name="keyword" class="form-control float-right" placeholder="Tìm kiếm" value="{{$keyword}}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="box_left_content">
                <div class="title_letf">Sắp xếp theo giá</div>
                <div class="col_content">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sort_price" id="exampleRadios1" value="" @if ($sortPrice == "") checked @endif>
                        <label class="form-check-label" for="exampleRadios1">
                            Mặc định
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sort_price" id="exampleRadios2" value="asc" @if ($sortPrice == "asc") checked @endif>
                        <label class="form-check-label" for="exampleRadios2">
                            Tăng dần
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="sort_price" id="exampleRadios3" value="desc" @if ($sortPrice == "desc") checked @endif>
                        <label class="form-check-label" for="exampleRadios3">
                            Giảm dần
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('right_content')
    <div class="head_top_list row">
        <div class="col-12 col-lg-6">
            <h3>Danh sách gói tập</h3>
        </div>
        <div class="col-12 col-lg-6">

            <a href="{{route('package_tickets.create')}}" class="btn btn-success"><i class="fa fa-plus"></i>Thêm mới</a>
        </div>
    </div>
    <div class="bg_white">
        <div class="list_package_ticket">
            <table class="table table-responsive-lg table-striped">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Giá (VND)</th>
                    <th>Giảm giá (%)</th>
                    <th>Mô tả</th>
                    <th class="text-center">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @forelse($packageTickets as $index => $packageTicket)
                    <tr>
                        <?php
                            $price = number_format($packageTicket->price) ;

                        ?>
                        <td>{{ $index + $packageTickets->firstItem() }}</td>
                        <td>{{$packageTicket->name}}</td>
                        <td>{{$price}}</td>
                        <td>{{$packageTicket->discount}}</td>
                        <td>{{$packageTicket->discription}}</td>
                        <td class="text-center">
                            <a href="{{route('package_tickets.edit', $packageTicket->id)}}"><i class="fa fa-edit"></i></a>
                            <a href="{{route('package_tickets.destroy', $packageTicket->id)}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
            @if($packageTickets->hasPages())
                <div class="">
                    {{ $packageTickets->appends(request()->all())->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
