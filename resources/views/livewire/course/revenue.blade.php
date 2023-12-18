<div>
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Quản lý doanh thu: {{$course->course_name}}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Advanced Form</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
            <div class="input-group flex-nowrap">
              <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping">Từ ngày</span>
              </div>
              <input type="date"  wire:model='startdate' class="form-control" placeholder="Ngày bắt đầu" aria-label="Ngày bắt đầu" aria-describedby="addon-wrapping">
              <span class="input-group-text" id="addon-wrapping">Đến ngày</span>

              <input type="date"  wire:model='enddate' class="form-control" placeholder="Ngày kết thúc" aria-label="Ngày kết thúc" aria-describedby="addon-wrapping">
              <button class="btn btn-primary" wire:click='caculator'>Tra cứu</button>

            </div>
            
              @if($this->startdate && $this->enddate)
              <div class="callout callout-success p-2 m-2">
                <h5>Doanh thu của bạn từ {{$this->startdate}} đến {{$this->enddate}}: </h5>

                @if($revenue)
               
                @else <p>Không tìm thấy</p> @endif
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Người dùng</th>
                    <th scope="col">Thời gian đăng ký</th>
                    <th scope="col">Số tiền</th>
                  </tr>
                </thead>
                <tbody>
                  @php $total = 0; @endphp
                  @foreach ($members as $member)
                  @php $total +=$member->vnp_Amount @endphp

                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><a href="/<?= '@' ?>{{$member->user_username}}">{{$member->user_fullname}}</a></td>
                    <td>{{$member->created_at}}</td>
                    <td>{{number_format($member->vnp_Amount, 0, ',', '.') . ' VNĐ'}}</td>

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Doanh thu gốc của bạn:  </th>
                    <td></td>
                    <td></td>
                    <td>{{number_format($total, 0, ',', '.') . ' VNĐ'}}</td>
                  </tr>
                  <tr>
                    <th>Chi phí khấu trừ (10%):</th>
                    <td></td>
                    <td></td>
                    <td> {{number_format($total*0.1, 0, ',', '.') . ' VNĐ'}}</td>
                  </tr>
                  
                  <tr>
                    <th>Doanh thu nhận được thực tế:</th>
                    <td></td>
                    <td></td>
                    <td> {{number_format($total*0.9, 0, ',', '.') . ' VNĐ'}}</td>
                  </tr>
                </tfoot>
              </table>

              @else
           
           
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Người dùng</th>
                    <th scope="col">Thời gian đăng ký</th>
                    <th scope="col">Số tiền</th>
                  </tr>
                </thead>
                <tbody>
                  @php $total = 0; @endphp

                  @foreach ($members as $member)
                  <tr>
                    @php $total +=$member->vnp_Amount @endphp
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><a href="/<?= '@' ?>{{$member->user_username}}">{{$member->user_fullname}}</a></td>
                    <td>{{$member->created_at}}</td>
                    <td>{{number_format($member->vnp_Amount, 0, ',', '.') . ' VNĐ'}}</td>

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Doanh thu gốc của bạn:  </th>
                    <td></td>
                    <td></td>
                    <td>{{number_format($total, 0, ',', '.') . ' VNĐ'}}</td>
                  </tr>
                  <tr>
                    <th>Chi phí khấu trừ (10%):</th>
                    <td></td>
                    <td></td>
                    <td> {{number_format($total*0.1, 0, ',', '.') . ' VNĐ'}}</td>
                  </tr>
                  
                  <tr>
                    <th>Doanh thu nhận được thực tế:</th>
                    <td></td>
                    <td></td>
                    <td> {{number_format($total*0.9, 0, ',', '.') . ' VNĐ'}}</td>
                  </tr>
                </tfoot>
              </table>
              @endif
            
          </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
 
    </div>
</div>
