$(document).ready(function () {
    $("#current_pwd").keyup(function () {
    var current_pwd= $("#current_pwd").val()
        //alert(current_pwd);
        $.ajax({
            type:'post',
            url:'/admin/check-pwd',
            data:{current_pwd:current_pwd},
            success:function (resp) {
                if(resp ==false){
                    $('#chkPwd').html("current pwd is incorrect")
                    $('#chkPwd1').html("")
                }else if(resp==true){
                    $('#chkPwd').html("")
                    $('#chkPwd1').html("current pwd is incorrect")
                }
            },error:function () {
                alert("error");
            }
        });


    });
    $("#new_pwd").keyup(function () {
        var n_pwd = $("#new_pwd").val()
        $("#confirm_pwd").keyup(function () {
            var c_pwd = $("#confirm_pwd").val()
        $.ajax({
            type: 'post',
            url: '/admin/check-confirm-pwd',
            data: {confirm_pwd: c_pwd, new_pwd:n_pwd},
            success: function (resp) {
                //alert(resp);
                if(resp ==false){
                    $('#conPwd').html("current pwd is incorrect")
                    $('#conPwd1').html("")
                }else if(resp==true){
                    $('#conPwd').html("")
                    $('#conPwd1').html("current pwd is incorrect")
                }
            }, error: function () {
                alert("error");
            }
        });
        });
    });



    //status


    //status
    $(document).on("click",'.check',function () {
        var status=$(this).text();
        var check_id=$(this).attr('check_id');
        var url=$(this).attr('url');
      //  alert(status);
      // alert(check_id);
        $.ajax({
            type:'post',
            url:'/admin/status-'+url,
            data:{status:status,check_id:check_id},
            success:function(resp){
               // alert(resp['check_id']);
               // alert(resp['status']);
                if(resp['status']==1){
                    $('#check-'+check_id).html("<button class='btn btn-sm btn-success'><a href=\"javascript:void(0)\" class='check text-white' >Active </a></button>");
                }else if(resp['status']==0){
                    $('#check-'+check_id).html("<button class='btn btn-sm btn-danger'><a href=\"javascript:void(0)\" class='check text-white' >Inactive </a></button>");
                }

            },else(){
                alert('Error')
            }
        })
    })
   //status



    $('#section_id').change(function () {
        var section_id=$(this).val()
        $.ajax({
            type:'post',
            url:'/admin/append-cat',
            data:{section_id:section_id},
            success:function (resp) {
                //alert(resp)
               $("#appendCat").html(resp);
            },error(){
                alert('Error re vai')
            }
        })
    })
  /*  $('.del').click(function () {
      var name=$(this).attr('name');
      if(confirm("Are you Sure Man!. You wanna Delete this "+name+"?")){
          return true;
      }else {
          return false;
      }
    })*/
//sweet alert


        $(document).on("click",'.del',function () {

        var name=$(this).attr('record');
        var id=$(this).attr('recordId');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location.href="/admin/del-"+name+"/"+id;
            }
        })
    })

    //attribute

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div>' +
        '<input type="text" id="size" name="size[]" value="" placeholder="size"  required="">\n' +
        '<input type="text" id="sku" name="sku[]" value="" placeholder="sku"  required="">\n' +
        '<input type="number" id="price" name="price[]" value="" placeholder="price"  required="">\n' +
        '<input type="number" id="stock" name="stock[]" value="" placeholder="stock"  required="">' +
        '<a href="javascript:void(0);" class="remove_button">Delete</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

  //  $("#sort").on('change',function () {
      // alert("test")
     //this.form.submit();
   // })

});
