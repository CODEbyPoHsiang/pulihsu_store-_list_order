$(document).ready(function(){

    //獲得原始的URL *********************
    var url = $('#url').val();
    console.log(url);

    //新增聯絡人的按鈕，點擊會跳出新增的Modal *********************
    $('#btn_add').click(function(){
        $('.modal-title').text("新增訂單資料"); //Modal視窗的標題會判斷改為"新增聯絡人"
        $('#btn-save').val("新增");
        $('#frmMembers').trigger("reset");
        $('#myModal').modal('show');
    });



    //編輯聯絡人的按鈕，點擊後會跳出編輯的Modal，利用ajax帶出資料***************************
    $(document).on('click','.open_modal',function(){
        var member_id = $(this).val();
        console.log(member_id);
        // 編輯視窗中透過ajax撈到的資料
        $.ajax({
            type: "GET",
            url: url + '/' + member_id,
            success: function (data) {
                console.log(data);
                $('#member_id').val(data.id);
                $('#name').val(data.name);
                $('#product').val(data.product);
                $('#buy_date').val(data.buy_date);
                $('#buy_money').val(data.buy_money);
                $('#pay_method').val(data.pay_method);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#other_contact').val(data.other_contact);
                $('#address').val(data.address);
                $('#notes').val(data.notes);
                $('.modal-title').text("編輯訂單資料"); //Modal的標題會判斷，並改為"編輯聯絡人"標題
                $('#btn-save').val("編輯");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });



    //新增聯絡人 / 編輯現有聯絡人 ***************************
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
            name: $('#name').val(),
            product: $('#product').val(),
            buy_date: $('#buy_date').val(),
            buy_money: $('#buy_money').val(),
            pay_method: $('#pay_method').val(),
            phone: $('#phone').val(),
            email: $('#email').val(),
            other_contact: $('#other_contact').val(),
            address: $('#address').val(),
            notes: $('#notes').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //用於新增
        var member_id = $('#member_id').val();;
        var my_url = url;
        if (state == "編輯"){

            Swal.fire( { 
                position: 'top-end',
                type: 'success',
                title: '你的修改已成功保存!', 
                showConfirmButton: false, 
                timer: 2000 
                })//編輯成功彈出的提示視窗

            type = "PUT"; //用於編輯
            my_url += '/' + member_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            
            success: function (data) {
                // for (var x in data){
                //     if(data[x] === null){
                //         data[x] ='';
                //     }
                // };//將撈到的null值改成空字串
                console.log(data);
                var member = '<tr id="member' + data.id + '"><td>' + data.name + '</td><td>' + data.buy_date + '</td><td>' + data.buy_money + '</td><td>' + data.product+ '</td>' ;
                member += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '" style="border-Radius: 0px;">編輯</button></td>';
                member += '<td><button class="btn btn-danger btn-delete delete-member" value="' + data.id + '" style="border-Radius: 0px;">刪除</button></td></tr>';
    
                if (state == "新增"){ //如果使用者新增一筆資料
                    $('#members-list').append(member);
                    Swal.fire({
                        type: 'success',
                        title: '訂單資料已新增成功!',
                        showConfirmButton: false, 
                        timer: 1000
                    })//新增成功，彈出的提示視窗
                }else{ //如果使用者編輯一筆資料
                    $("#member" + member_id).replaceWith( member );
                }
                $('#frmMembers').trigger("reset");//jquery的函數
                $('#myModal').modal('hide')
                
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });


    //從列表中刪除聯絡人的資料***************************
    $(document).on('click','.delete-member',function(){
        var member_id = $(this).val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        // Swal.fire({
        //     title: '聯絡人資料已刪除!',
        //     type: 'warning',
        //     // showConfirmButton: false, 
        //     timer: 1000
        // }),

        Swal.fire({
            title: '確定要刪除此筆資料嗎?',
            text: "資料刪除後將無法復原!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '刪除',
            cancelButtonText: '取消',
            showConfirmButton: true 

        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title:'資料刪除成功!',
                    type:'success',
                    showConfirmButton:false,
                    timer: 1000
                })
                $.ajax({
                    //刪除後提示的彈出視窗
                    type: "DELETE",
                    url: url + '/' + member_id,

                    success: function (data) {
                        console.log(data);
                        $("#member" + member_id).remove();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        })







        
    });
    
});