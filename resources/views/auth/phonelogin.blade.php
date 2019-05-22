@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">登录</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('phone.login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">手机号码</label>

                            <div class="col-md-6">
                                <input id="phone"  class="form-control" name="phone" value="" required autofocus>
                                <button id="bt_phone">获取验证码</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">请输入接受的的验证码</label>

                            <div class="col-md-6">
                                <input id="code"  class="form-control" name="code"  required autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    登录
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(function(){
            $('#bt_phone').click(function(event){
                $.ajax({
                    type:'post',
                    url:'{{url('phone/code')}}',
                    data:{
                        phone:$('#phone').val(),
                        _token:'{!! csrf_token() !!}'
                    },
                    success:function(data){
                        if(data.status==='success'){
                            alert('短信发送成功');
                            return;
                        }
                        alert('短信发送失败');
                    }

                });
                event.preventDefault();
            })
        })
    </script>
@stop
