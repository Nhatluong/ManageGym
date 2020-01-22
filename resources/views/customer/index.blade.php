@extends('layouts.admin')

@section('left_content')
    <div class="bg_white">
        <form method="get" action="{{route('customers.index')}}">
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
                <div class="title_letf">Trạng thái khách hàng</div>
                <div class="col_content">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="" @if ($status == "") checked @endif>
                        <label class="form-check-label" for="exampleRadios1">
                            Tất cả
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value=1 @if ($status == 1) checked @endif>
                        <label class="form-check-label" for="exampleRadios2">
                            Hoạt động
                        </label>
                    </div>

                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios3" value=2 @if ($status == 2) checked @endif>
                        <label class="form-check-label" for="exampleRadios3">
                            Hết hạn
                        </label>
                    </div>

                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios4" value=1 @if ($dateLeft) checked @endif>
                        <label class="form-check-label" for="exampleRadios4">
                            Hết hạn trong
                        </label>
                        <input type="number" name="date_left" value={{$dateLeft}}>
                        <label class="form-check-label">ngày</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('right_content')

    <div class="head_top_list row">
        <div class="col-12 col-lg-6">
            <h3>Danh sách khách hàng</h3>
        </div>
        <div class="col-12 col-lg-6">

            <a href="{{route('customers.create')}}" class="btn btn-success"><i class="fa fa-plus"></i>Thêm mới</a>
        </div>
    </div>

    <div class="bg_white">
        <div class="list_customers">
            <table class="table table-striped table-responsive-lg">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Số đt</th>
                        <th>Gói tập</th>
                        <th>Ngày mua</th>
                        <th>Ngày hết hạn</th>
                        <th>Trạng thái</th>
                        <th>Địa chỉ</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $index => $customer)
                        <tr>
                            <td>{{$index + $customers->firstItem()}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->number_phone}}</td>
                            <td>{{$customer->packageTicket->name}}</td>
                            <td>{{$customer->date_buy}}</td>
                            <td>{{$customer->date_end}}</td>
                            <td>{{$customer->status}}</td>
                            <td>{{$customer->addrees}}</td>
                            <td class="text-center">
                                <a href="#"><i class="fa fa-edit"></i></a>
                                <a href="{{route('customers.destroy', $customer->id)}}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            @if ($customers->hasPages())
                <div class="">
                    {{ $customers->appends(request()->all())->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection

<div class="modal fade " id="modal_customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <form role="form" method="post" action="{{ route('customers.store') }}" spellcheck="false"
              novalidate autocomplete="off" class="clearable" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Thêm mới khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('customer.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>Đóng</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
