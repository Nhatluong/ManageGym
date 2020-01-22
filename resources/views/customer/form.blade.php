<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group row">
                <label class="col-form-label col-12 col-lg-4">
                    Tên khách hàng:
                </label>
                <div class="col-12 col-lg-8">
                    <input class="form-control" type="text" name="name" placeholder="Nhập tên khách hàng"
                           value="{{old('name', $customer->name)}}">
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class=" form-group row">
                <label class="col-form-label col-12 col-lg-4">
                    Số điện thoại
                </label>
                <div class="col-12 col-lg-8">
                    <input class="form-control" type="text" name="number_phone"
                           placeholder="Nhập số điện thoại khách hàng"
                           value="{{old('number_phone', $customer->number_phone)}}">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="container_img">
                <img style="max-width: 150px; max-height: 200px; object-fit: cover" id="image_avatar"
                     class="img-fluid mx-auto d-block"
                     src="https://nhatprogym.timesoft.vn/WebResource/images/avatar.jpg">
                <input name="avatar" type="file">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group row">
                <label for="package_ticked_id" class="col-form-label col-12 col-lg-4">
                    Gói tập
                </label>
                <div class="col-12 col-lg-8">
                    <select class=" form-control" name="package_ticket_id" id="package_ticket_id">
                        <option value="1">1 thang</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group row">
                <label for="status" class="col-form-label col-12 col-lg-4">
                    Trạng thái
                </label>
                <div class="col-12 col-lg-8">
                    <select class=" form-control status" name="status" id="status">
                        <option value="1">dang hoat dong</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group row">
                <label class="col-form-label col-12 col-lg-4">
                    Ngày mua
                </label>
                <div class="col-12 col-lg-8">
                    <input class="form-control" name="date_buy" placeholder="Nhập địa chỉ"
                           value="{{old('date_buy', $customer->date_buy)}}">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group row">
                <label class="col-form-label col-12 col-lg-4">
                    Ngày hết hạn
                </label>
                <div class="col-12 col-lg-8">
                    <input class="form-control" name="date_end" placeholder="Nhập địa chỉ"
                           value="{{old('date_end', $customer->date_end)}}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-12 col-lg-2">
            Địa chỉ
        </label>
        <div class="col-12 col-lg-10">
                <textarea class="form-control" name="address"
                          placeholder="Nhập địa chỉ">{{old('address', $customer->address)}}</textarea>
        </div>
    </div>
</div>
