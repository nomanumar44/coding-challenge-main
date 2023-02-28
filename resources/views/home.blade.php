@extends('layouts.app')
@section('content')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/helper.js') }}?v={{ time() }}" defer></script>
  <script src="{{ asset('js/main.js') }}?v={{ time() }}" defer></script>

  <div class="container">
    <x-network_connections />
  </div>

@endsection
@section('script')
<script>
  $(document).ready(function(){
    getSuggesstions(suggesstionOffset,suggesstionLimit);
    getSentRequest(sentOffset,sentLimit);
    getReceiveRequest(receiveOffset,receiveLimit);
    getConnected(connectionOffset,connectionLimit);
  });
  var suggesstionOffset=0;
  var suggesstionLimit =10;
  var suggesstionCount = 0;
  function getSuggesstions(offset,limit,type=null){
    $.ajax({
        type:'Post',
        url:"{{route('getSuggesstions')}}",
        data:{offset:offset,limit:limit, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          if(data.status==true){
            $('#suggesstion_count').html(data.count);
            suggesstionCount = data.count;
            if(type!=null){
              suggesstion_offset=0;
              suggesstion_limit =10;
              $('#suggesstion-data').html(data.data);
              $("#suggesstion").addClass('active');
              $("#suggesstion").addClass('show');
              $("#sent").removeClass('active');
              $("#sent").removeClass('show');
              $("#received").removeClass('active');
              $("#received").removeClass('show');
              $("#connection").removeClass('active');
              $("#connection").removeClass('show');
            }else{
              $('#suggesstion-data').append(data.data);
            }
          }
          var rows_count=$(".suggesstion_rows").length;
            load_button(data.count,rows_count,'suggesstion-load-more');
          $("#loading").hide();

        }
    });
  }
  var sentOffset=0;
  var sentLimit =10;
  var sentCount=0;
  function getSentRequest(offset,limit,type=null){

    $.ajax({
        type:'Post',
        url:"{{route('getSentRequest')}}",
        data:{offset:offset,limit:limit, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          if(data.status==true){
            $('#sent_count').html(data.count);
            sentCount = data.count;
            var allData = data.data;
            if(type!=null){
              sent_offset=0;
              sent_limit =10;
              $('#sent-data').html(allData);
              $("#suggesstion").removeClass('active');
              $("#suggesstion").removeClass('show');
              $("#sent").addClass('active');
              $("#sent").addClass('show');
              $("#received").removeClass('active');
              $("#received").removeClass('show');
              $("#connection").removeClass('active');
              $("#connection").removeClass('show');
            }else{
              $('#sent-data').append(allData);
            }

          }
          var rows_count=$(".sent-rows").length;
            load_button(data.count,rows_count,'sent-load-more');
          $("#loading").hide();
        }
    });
  }
  var receiveOffset=0;
  var receiveLimit =10;
  var receiveCount=0;
  function getReceiveRequest(offset,limit,type=null){
    $.ajax({
        type:'Post',
        url:"{{route('getReceiveRequest')}}",
        data:{offset:offset,limit:limit, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          if(data.status==true){
            $('#receive_count').html(data.count);
            receiveCount = data.count;
            if(type!=null){
              receive_offset=0;
              receive_limit =10;
              $('#received-data').html(data.data);
              $("#suggesstion").removeClass('active');
              $("#suggesstion").removeClass('show');
              $("#sent").removeClass('active');
              $("#sent").removeClass('show');
              $("#received").addClass('active');
              $("#received").addClass('show');
              $("#connection").removeClass('active');
              $("#connection").removeClass('show');
            }else{
              $('#received-data').append(data.data);
            }
          }
          var rows_count=$(".receive-rows").length;
          load_button(data.count,rows_count,'receive-load-more');
          $("#loading").hide();
        }
    });
  }
  var connectionOffset=0;
  var connectionLimit =10;
  var connectionCount=0;
  function getConnected(offset,limit,type=null){
    $.ajax({
        type:'Post',
        url:"{{route('getConnected')}}",
        data:{offset:offset,limit:limit, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          if(data.status==true){
            $('#connection_count').html(data.count);
              connectionCount = data.count;
            if(type!=null){
              connection_offset=0;
              connection_limit =10;
              $('#connected-data').html(data.data);
              $("#suggesstion").removeClass('active');
              $("#suggesstion").removeClass('show');
              $("#sent").removeClass('active');
              $("#sent").removeClass('show');
              $("#received").removeClass('active');
              $("#received").removeClass('show');
              $("#connection").addClass('active');
              $("#connection").addClass('show');
            }else{
              $('#connected-data').append(data.data);
            }
          }
          var rows_count=$(".connection-rows").length;
            load_button(data.count,rows_count,'connection-load-more');
          $("#loading").hide();
        }
    });
  }
  function common(id,row_id){
    $.ajax({
        type:'Post',
        url:"{{route('getCommon')}}",
        data:{id:id, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          if(data.status==true){
            $('.common-rows').html('');
            $('.common-row'+row_id).html(data.data);
          }
          $("#loading").hide();
        }
    });
  }
  function loadMore(id){
      if(id=='suggesstion-data'){
        suggesstionOffset = suggesstionOffset + 10;
        suggesstionLimit =  10;
        getSuggesstions(suggesstionOffset,suggesstionLimit);
      }
      if(id=='sent-data'){
        sentOffset = sentOffset + 10;
        sentLimit =  10;
        getSentRequest(sentOffset,sentLimit);
      }
      if(id=='received-data'){
        receiveOffset = receiveOffset + 10;
        receiveLimit =  10;
        getReceiveRequest(receiveOffset,receiveLimit);
      }
      if(id=='connected-data'){
        connectionOffset = receiveOffset + 10;
        connection_limit =  10;
        getConnected(connectionOffset,connectionLimit);
      }
  }
  function connect(userId, suggesstionId) {
    $.ajax({
      type:'POST',
      url:"{{route('sendRequest')}}",
      data:{userId:userId, suggesstionId:suggesstionId, _token: "{{ csrf_token() }}"},
      beforeSend: function() {
          $("#loading").show();
        },
      success:function(data){
        if(data.status==true){
          suggesstionCount = suggesstionCount-1;
          $('#suggesstion_count').html(suggesstionCount);
          sentCount = sentCount+1;
          $('#sent_count').html(sentCount);
          $('.suggesstion-row'+suggesstionId).remove();
        }
        $("#loading").hide();
      }
    });
  }
  function withdraw(id) {
    $.ajax({
      type:'POST',
      url:"{{route('withdrawRequest')}}",
      data:{id:id, _token: "{{ csrf_token() }}"},
      beforeSend: function() {
          $("#loading").show();
        },
      success:function(data){
        if(data.status==true){
          sentCount = sentCount-1;
          $('#sent_count').html(sentCount);
          suggesstionCount = suggesstionCount+1;
          $('#suggesstion_count').html(suggesstionCount);
          $('.request-row'+id).remove();
        }
        $("#loading").hide();
      }
    });
  }
  function accept(id) {
    $.ajax({
      type:'POST',
      url:"{{route('acceptRequest')}}",
      data:{id:id, _token: "{{ csrf_token() }}"},
      beforeSend: function() {
          $("#loading").show();
        },
      success:function(data){
        if(data.status==true){
          receiveCount = receiveCount-1;
          $('#receive_count').html(receiveCount);
          connectionCount = connectionCount+1;
          $('#connection_count').html(connectionCount);
          $('.request-row'+id).remove();
        }
        $("#loading").hide();
      }
    });
  }
  function cancel(id) {
    $.ajax({
      type:'POST',
      url:"{{route('cancelRequest')}}",
      data:{id:id, _token: "{{ csrf_token() }}"},
      beforeSend: function() {
          $("#loading").show();
        },
      success:function(data){
        if(data.status==true){
          connectionCount = connectionCount-1;
          $('#connection_count').html(connectionCount);
          suggesstionCount = suggesstionCount+1;
          $('#suggesstion_count').html(suggesstionCount);
          $('.connection-row'+id).remove();
        }
        $("#loading").hide();
      }
    });
  }
  function load_button(count,rows_count,button_class){

    if(rows_count==count){
        $("."+button_class).hide();
    }else{
        $("."+button_class).show();
    }
  }
</script>
@endsection
