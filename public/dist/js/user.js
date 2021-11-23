$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    $("#sort").on('change',function () {
       //this.form.submit();
        var sort = $(this).val();
        var fab= get_filter("fab");
        var fab= get_filter("fab");
        var sleeve= get_filter("sleeve");
        var pattern= get_filter("pattern");
        var fit= get_filter("fit");
        var occasion= get_filter("occasion");
        //alert(sort)
        var url = $("#url").val();
       // alert(url)
        $.ajax({
            url:url,
            method:"post",
            data:{fab:fab,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_pro').html(data);
            }

        })
       })
    $(".fab").on('change',function () {
         var fab= get_filter(this);
        var sort = $("#sort option:selected ").val();
        //alert(sort)
        var url = $("#url").val();
        // alert(url)
        $.ajax({
            url:url,
            method:"post",
            data:{fab:fab,sort:sort,url:url},
            success:function (data) {
                $('.filter_pro').html(data);
            }

        })
    });
    $(".sleeve").on('change',function () {
        var fab= get_filter("fab");
        var sleeve= get_filter("sleeve");
        var pattern= get_filter("pattern");
        var fit= get_filter("fit");
        var occasion= get_filter("occasion");
        var sort = $("#sort option:selected ").val();
        //alert(sort)
        var url = $("#url").val();
        // alert(url)
        $.ajax({
            url:url,
            method:"post",
            data:{fab:fab,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion, sort:sort,url:url},
            success:function (data) {
                $('.filter_pro').html(data);
            }

        })
    });
    $(".pattern").on('change',function () {
        var fab= get_filter("fab");
        var sleeve= get_filter("sleeve");
        var pattern= get_filter("pattern");
        var fit= get_filter("fit");
        var occasion= get_filter("occasion");
        var sort = $("#sort option:selected ").val();
        //alert(sort)
        var url = $("#url").val();
        // alert(url)
        $.ajax({
            url:url,
            method:"post",
            data:{fab:fab,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_pro').html(data);
            }

        })
    });
    $(".fit").on('change',function () {
        var fab= get_filter("fab");
        var sleeve= get_filter("sleeve");
        var pattern= get_filter("pattern");
        var fit= get_filter("fit");
        var occasion= get_filter("occasion");
        var sort = $("#sort option:selected ").val();
        //alert(sort)
        var url = $("#url").val();
        // alert(url)
        $.ajax({
            url:url,
            method:"post",
            data:{fab:fab,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_pro').html(data);
            }

        })
    });
    $(".occasion").on('change',function () {
        var fab= get_filter("fab");
        var sleeve= get_filter("sleeve");
        var pattern= get_filter("pattern");
        var fit= get_filter("fit");
        var occasion= get_filter("occasion");
        var sort = $("#sort option:selected ").val();
        //alert(sort)
        var url = $("#url").val();
        // alert(url)
        $.ajax({
            url:url,
            method:"post",
            data:{fab:fab,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_pro').html(data);
            }

        })
    });


    function get_filter(class_name) {
        var filter=[];
        $('.'+class_name+':checked').each(function () {
            filter.push($(this).val()) ;
        });
        return filter;
    }

    $("#getPrice").change(function () {
        var size=$(this).val();
        var product_id=$(this).attr('product-id');
        //alert(p_id)
        $.ajax({
            url:'/change-price',
            type:"post",
            data:{size:size,product_id:product_id},
            success:function (resp) {
              // alert(resp['discounted_price']);
                //alert(resp['product_price']);
                //alert(resp['stock']);
                if(resp['discounted_price']>0){
                     $(".price").html(resp['product_price']+" "+"BDT");
                     $(".disPrice").html(resp['discounted_price']+" "+"BDT");
                     $(".stock").html(resp['stock']+" "+"items in stock")
                     $('#hide').hide()
                }else{

                }


            },error:function(){
                alert("error");
            }
        })
    });

    $(document).on('click','.updateItem',function () {
        if($(this).hasClass('qMinus')){
            var quantity=$(this).prev().val();
             if(quantity<=1){
                alert("Item Quantity must be 1 or greater than 1")
             }else{
                 new_quantity=parseInt(quantity)-1;

             }
        }
        if($(this).hasClass('qPlus')){
                var quantity=$(this).prev().prev().val();
                new_quantity=parseInt(quantity)+1;


            }
            //alert(new_quantity)
            var cartId=$(this).data('cartid');
           // alert(cartId)
            $.ajax({
                url:'update-quantity',
                type: 'post',
                data:{"new_quantity":new_quantity,"cartId":cartId},
                success:function (resp) {
                    //alert(resp.status)
                   // alert(resp.totalCartItems)
                    if(resp.status==false){
                        alert(resp.msg)
                    }
                    $('.totalCart').html("[ "+resp.totalCartItems+" ]")
                    $('#AppendCart').html(resp.view)
                },error: function () {
                    alert("err")
                }
        })
    })
    $(".deleteItem").click(function () {
      var cartId=$(this).data('cartid')
        //alert(cartId)
            var result= confirm("Wanna delete this?")
        if(result){
            $.ajax({
                url:'delete-quantity',
                type: 'post',
                data:{"cartId":cartId},
                success:function (resp) {
                    // alert(resp)
                    $('.totalCart').html("[ "+resp.totalCartItems+" ]")
                    $('#AppendCart').html(resp.view)
                },error: function () {
                    alert("err")
                }
            })
        }
    })

    $("#userLogin").validate({
        rules:{
            name:"required",
            password:{
                required:true,
                minlength:5
            },
            email:{
                required:true,
                email:true,
                remote:"check-email"
            },
            mobile:{
                required:true,
                minlength:10,
                maxlength:10
            }
        },
        messages:{
            name:"give name na",
            password:{
                required:"give password na",
                minlength:"minlength  must be 5",
            },
            email:{
                required:"give email na",
                email:" required",
                remote:"already exist"
            },
            mobile:{
                required:"give mobile na",
                minlength:"minlength  must be  10 ",
                maxlength:"maxlength  must be 10",
            }

        }
    })

    $("#current_pwd").keyup(function () {
        var current_pwd= $(this).val();
       $.ajax({
           url:'/check-user-pwd',
           type:'post',
           data: {current_pwd: current_pwd},
           success:function (resp) {
                 if(resp==true){
                     $('#chk_pwd').html("<font color='green'> Password is Correct</font>")
                 }else{
                     $('#chk_pwd').html("<font color='red'> Password is Incorrect</font>")
                 }
           },
           error:function () {
               alert("err")
           }
       })
    })
    $("#confirm_pwd").keyup(function () {
        var confirm_pwd= $(this).val();
        var new_pwd= $('#new_pwd').val();
        $.ajax({
            url:'/match-user-pwd',
            type:'post',
            data: {confirm_pwd:confirm_pwd,new_pwd:new_pwd},
            success:function (resp) {
                if(resp==true){
                    $('#chk2_pwd').html("<font color='green'> Password matched</font>")
                }else{
                    $('#chk2_pwd').html("<font color='red'> Password is Incorrect</font>")
                }
            },
            error:function () {
                alert("err")
            }
        })
    })

    $("#applyCop").submit(function () {
       var user = $(this).attr("user");
       if(user==1){

       }else{
           alert("please login in to use coupon code");
       }
       var code= $("#code").val();
        //alert(code)
        $.ajax({
            type:"post",
            data:{code:code},
            url:'/apply-coupon',
            success:function (resp) {
                if(resp.message!=""){
                    alert(resp.message)
                }
                $('.totalCart').html("[ "+resp.totalCartItems+" ]")
                $('#AppendCart').html(resp.view)
                if(resp.cop>=0){
                    $('.cop').text(resp.cop)
                }
                if(resp.cop>=0){
                    $('.grand').text(resp.grand+" "+"BDT")
                }
            },error:function () {
                alert("err")
            }
        })
    })
});
