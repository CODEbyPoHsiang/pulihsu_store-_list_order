  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>訂單管理系統</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Important to work AJAX CSRF -->
    <meta name="_token" content="{!! csrf_token() !!}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://bootswatch.com/3/darkly/bootstrap.css">

    <!-- 使用sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

    <style>
      body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
      }

      .topnav {
        overflow: hidden;
      }

      label.xrequired:after {
        content: '*(此欄位為必填) ';
        color: red;
      }

      .topnav-right {
        float: right;
      }

      .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-default">
      <div class="topnav">
        <a class="active" href="#home">訂單管理系統</a>
        <div class="topnav-right">
          <a href="#about">徐增德石雕茶盤藝術館</a>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="pull-right">
        <button id="btn_add" name="btn_add" class="btn btn-default pull-right" style="border-Radius: 0px;">新增訂單資料</button>
      </div>
      <br />
      <br />
      <br />
      <div class="row">
        <div class="col-md-12 col-md-offset-0">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="info">
                {{-- <th>ID </th>  --}}
                <th width="15%">顧客名稱</th>
                <th width="15%">購買日期</th>
                <th width="25%">消費金額</th>
                <th width="30%">購買商品</th>
                <th width="10%">操作</th>
                <th width="20%">動作</th>
              </tr>
            </thead>
            <tbody id="members-list" name="members-list">
              @foreach ($member as $m)
              <tr id="member{{$m->id}}" class="active">
                {{-- <td>{{$m->id}}</td>  --}}
                <td>{{$m->name}}</td>
                <td>{{$m->pay_date}}</td>
                <td>{{$m->pay_money}}</td>
                <td>{{$m->rooduct}}</td>
                <td>
                  <button class="btn btn-warning btn-detail open_modal" value="{{$m->id}}" style="border-Radius: 0px;">編輯</button>
                </td>
                <td>
                  <button class="btn btn-danger btn-delete delete-member" value="{{$m->id}}" style="border-Radius: 0px;">刪除</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>

    <!-- Passing BASE URL to AJAX -->
    <input id="url" type="hidden" value="{{ \Request::url() }}">

    <!-- MODAL SECTION -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="width:800px">
        <div class="modal-content" style="border-Radius: 0px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Member Form</h4>
          </div>
          <div class="modal-body">
            <form id="frmMembers" name="frmMembers" class="form-horizontal" novalidate="">
              <div class="row">
                <div class="col-xs-6">
                  <label class="xrequired">顧客姓名</label>
                  <input type="text" required="required" class="form-control has-error" id="name" name="name" style="border-Radius: 0px;" required>
                </div>
                <div class="col-xs-6">
                  <label class="text-light">購買商品</label>
                  <input type="text" name="product" id="product" class="form-control" style="border-Radius: 0px;">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-4">
                  <label class="text-light">購買日期</label>
                  <input type="text" class="form-control" id="buy_date" name="buy_date" style="border-Radius: 0px;" />
                </div>
                <div class="col-xs-4">
                  <label class="text-light">消費金額</label>
                  <input type="text" class="form-control" id="buy_money" name="buy_money" style="border-Radius: 0px;" />
                </div>
                <div class="col-xs-4">
                  <label class="text-light">付款方式</label>
                  <input type="text" class="form-control" id="pay_method" name="pay_method" style="border-Radius: 0px;" />
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-xs-4">
                  <label class="text-light">電話/手機</label>
                  <input type="text" name="phone" id="phone" class="form-control" style="border-Radius: 0px;" />
                </div>
                <div class="col-xs-4">
                  <label class="text-light">電子信箱</label>
                  <input type="text" name="email" id="email" class="form-control" style="border-Radius: 0px;" />
                </div>
                <div class="col-xs-4">
                  <label class="text-light">其他聯絡方式</label>
                  <input type="text" name="other_contact" id="other_contact" class="form-control" style="border-Radius: 0px;" />
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-xs-12">
                  <label class="text-light">地址</label>
                  <input type="text" name="address" id="address" class="form-control" style="border-Radius: 0px;" />
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-xs-12">
                  <label class="text-light">備註</label>
                  <textarea type="textarea" name="notes" id="notes" class="form-control" style="border-Radius: 0px;"></textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" id="btn-save" name="btn-save" style="border-Radius: 0px;" />
            <input type="hidden" id="member_id" name="member_id" value="0">
          </div>
        </div>
      </div>
    </div>
  </body>

  <!-- 引用放在public裡面的ajax的js程式碼 -->
  <script src="{{asset('js/ajaxscript.js')}}"></script>

  </html>