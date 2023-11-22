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
                  <p>{{$revenue*0.9}}
                    <hr>
                    <h5>                    Chi tiết doanh thu:
                    </h5>
                    <br>
                    Doanh thu từ việc bán khóa học: {{$revenue}} 
                    <br>
                    Phí dịch vụ (10%): {{$revenue*0.1}}
                    <br>
                    Tổng doanh thu: {{$revenue*0.9}}
                  </p>
                  @else <p>Không tìm thấy</p> @endif
                </div>
                  

                @else
             
                <div class="callout callout-success p-2 m-2">
                  <h5>Tổng doanh thu của bạn: </h5>

                 
                  <p>{{$revenue*0.9}}
                    <hr>
                    <h5>                    Chi tiết doanh thu:
                    </h5>
                    <br>
                    Doanh thu từ việc bán khóa học: {{$revenue}} 
                    <br>
                    Phí dịch vụ (10%): {{$revenue*0.1}}
                    <br>
                    Tổng doanh thu: {{$revenue*0.9}}
                  </p>
                 
                </div>
                  
                @endif
            </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
   
      </div>
</div>
