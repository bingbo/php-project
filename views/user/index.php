

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
	<div class="page-header">
        <form class="form-inline search-box">
            <div class="form-group">
                <label for="exampleInputName2">用户ID</label>
                <input type="text" class="form-control" name="id" placeholder="23485724">
            </div>
            <div class="form-group">
                <label for="exampleInputName2">用户名</label>
                <input type="text" class="form-control" name="name" placeholder="aos">
            </div>
            <button type="submit" class="btn btn-default" data-loading-text="Searching...">查询</button>
            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add-modal">添加模块</button>
        </form>
    </div>
</div>




<div class="page-header">
<h1>users</h1>
</div>


<table class="table table-bordered">
	<thead>
	  <tr>
	    <th>#</th>
	    <th>Name</th>
	    <th>Password</th>
		<th>操作</th>
	  </tr>
	</thead>
	<tbody>
		<?php foreach($content['data'] as $key => $value){ ?>
		  <tr> 
		    <td><?= $value->id ?></td>
		    <td><?= $value->name ?></td>
		    <td><?= $value->password ?></td>
		    <td>
			    <span onclick="user_update(<?= $value->id ?>)" class="btn btn-warning btn-xs">修改</span>
			    <span onclick="user_delete(<?= $value->id ?>)" class="btn btn-danger btn-xs">删除</span>
		    </td>
		  </tr>
		<?php } ?>
	 </tbody>
</table>


<!--添加模块的弹框-->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">添加修改用户</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="add-module-form">
            <input type="hidden" name="id">
            
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="bill" name="name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">用户密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputEmail3" placeholder="*****" name="password">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add">Run Add</button>
        <button type="button" class="btn btn-primary update">Run Update</button>
      </div>
    </div>
  </div>
</div>
<!--添加模块的弹框-->


<!--警告框-->
<div  id="myalert" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-danger">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="mySmallModalLabel">Error Msg</h4>
        </div>
        <div class="modal-body">
            <div class="alert  alert-dismissible fade in" role="alert">
              <strong>Warning!</strong> <span class="msg">Better check yourself, you're not looking too good.</span>
            </div>
        </div>
    </div>
  </div>
</div>

<!--警告框-->

<script>
    var table = $('table'),
        modal = $('#add-modal'),
        tbody = table.find('tbody'),
        form = $('.search-box'),
        searchBtn = form.find('button[type=submit]'),
        myalertModal = $('#myalert');
    form.submit(function(){
        var data = $(this).serialize();
        searchBtn.button('loading');
        $.app.user.list(data,listCallback);
        searchBtn.button('reset');
        return false;
    });
    function listCallback(res){
        if(res.errno == 0 && res.data){
            var data = res.data;
            tbody.html('');
            for(var i = 0; i < data.length; i++){
                table.append(
                    '<tr><td>'+data[i].id+
                    '</td><td>'+data[i].name+
                    '</td><td>'+data[i].password+
                    '</td><td>'+
                    '<span onclick="user_update('+data[i].id+')" class="btn btn-warning btn-xs">修改</span>'+
                    '<span onclick="user_delete('+data[i].id+')" class="btn btn-danger btn-xs">删除</span>'+
                    '</td></tr>');
            }
        }
    }
    $('button[data-target="#add-modal"]').click(function(){
        //modal.find('select>option[selected]').removeAttr('selected');
        modal.find('input[name=name]').val('');
        modal.find('input[name=password]').val('');
        modal.find('button.add').show();
        modal.find('button.update').hide();
    });
    modal.find('button.add').click(function(){
        var fm = modal.find('form'),
            data = fm.serialize();
        $.app.user.add(data, function(res){
            if(res.errno == 0){
                modal.modal('hide');
                form.submit();
            }else{
                modal.modal('hide');
                myalertModal.find('.msg').html(res.errmsg);
                myalertModal.modal('show');
            }

        });
    });
    modal.find('button.update').click(function(){
        var fm = modal.find('form'),
            data = fm.serialize();
        $.app.user.update(data, function(res){
            if(res.errno == 0){
                modal.modal('hide');
                form.submit();
            }else{
                modal.modal('hide');
                myalertModal.find('.msg').html(res.errmsg);
                myalertModal.modal('show');
            }

        });
    });
    function user_delete(id){
        $.app.user.delete($.param({id:id}), function(res){
            if(res.errno == 0){
                form.submit();
            }else{
                myalertModal.find('.msg').html(res.errmsg);
                myalertModal.modal('show');
            }

        });
    }
    function user_update(id){
        $.app.user.get($.param({id:id}), function(res){
            if(res.errno == 0){
                var mod = res.data;
                modal.find('input[name=id]').val(mod.id);
                //modal.find('select>option[value='+mod.pid+']').attr('selected','selected');
                modal.find('input[name=name]').val(mod.name);
                modal.find('input[name=password]').val(mod.password);
                modal.find('button.add').hide();
                modal.find('button.update').show();
                modal.modal('show');
            }else{
                myalertModal.find('.msg').html(res.errmsg);
                myalertModal.modal('show');
            }
        });
    }

</script>



<div class="page-header">
<h1>Carousel</h1>
</div>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
  <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
  <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
</ol>
<div class="carousel-inner" role="listbox">
  <div class="item">
    <img data-src="holder.js/1140x500/auto/#777:#555/text:First slide" alt="First slide [1140x500]" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTE0MCIgaGVpZ2h0PSI1MDAiIHZpZXdCb3g9IjAgMCAxMTQwIDUwMCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMTE0MHg1MDAvYXV0by8jNzc3OiM1NTUvdGV4dDpGaXJzdCBzbGlkZQpDcmVhdGVkIHdpdGggSG9sZGVyLmpzIDIuNi4wLgpMZWFybiBtb3JlIGF0IGh0dHA6Ly9ob2xkZXJqcy5jb20KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28KLS0+PGRlZnM+PHN0eWxlIHR5cGU9InRleHQvY3NzIj48IVtDREFUQVsjaG9sZGVyXzE1NjFhODdhMjE3IHRleHQgeyBmaWxsOiM1NTU7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6NTdwdCB9IF1dPjwvc3R5bGU+PC9kZWZzPjxnIGlkPSJob2xkZXJfMTU2MWE4N2EyMTciPjxyZWN0IHdpZHRoPSIxMTQwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzc3NyIvPjxnPjx0ZXh0IHg9IjM5MC41MDc4MTI1IiB5PSIyNzUuNSI+Rmlyc3Qgc2xpZGU8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true">
  </div>
  <div class="item active left">
    <img data-src="holder.js/1140x500/auto/#666:#444/text:Second slide" alt="Second slide [1140x500]" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTE0MCIgaGVpZ2h0PSI1MDAiIHZpZXdCb3g9IjAgMCAxMTQwIDUwMCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMTE0MHg1MDAvYXV0by8jNjY2OiM0NDQvdGV4dDpTZWNvbmQgc2xpZGUKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTYxYTg3OTgzMSB0ZXh0IHsgZmlsbDojNDQ0O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjU3cHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NjFhODc5ODMxIj48cmVjdCB3aWR0aD0iMTE0MCIgaGVpZ2h0PSI1MDAiIGZpbGw9IiM2NjYiLz48Zz48dGV4dCB4PSIzMzUuNjAxNTYyNSIgeT0iMjc1LjUiPlNlY29uZCBzbGlkZTwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
  </div>
  <div class="item next left">
    <img data-src="holder.js/1140x500/auto/#555:#333/text:Third slide" alt="Third slide [1140x500]" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTE0MCIgaGVpZ2h0PSI1MDAiIHZpZXdCb3g9IjAgMCAxMTQwIDUwMCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMTE0MHg1MDAvYXV0by8jNTU1OiMzMzMvdGV4dDpUaGlyZCBzbGlkZQpDcmVhdGVkIHdpdGggSG9sZGVyLmpzIDIuNi4wLgpMZWFybiBtb3JlIGF0IGh0dHA6Ly9ob2xkZXJqcy5jb20KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28KLS0+PGRlZnM+PHN0eWxlIHR5cGU9InRleHQvY3NzIj48IVtDREFUQVsjaG9sZGVyXzE1NjFhODdiZjYzIHRleHQgeyBmaWxsOiMzMzM7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6NTdwdCB9IF1dPjwvc3R5bGU+PC9kZWZzPjxnIGlkPSJob2xkZXJfMTU2MWE4N2JmNjMiPjxyZWN0IHdpZHRoPSIxMTQwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzU1NSIvPjxnPjx0ZXh0IHg9IjM3Ny44NjcxODc1IiB5PSIyNzUuNSI+VGhpcmQgc2xpZGU8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true">
  </div>
</div>
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
  <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
  <span class="sr-only">Next</span>
</a>
</div>


  