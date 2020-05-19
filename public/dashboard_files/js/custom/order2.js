$(document).ready(function () {
    
    //add product btn
    $('.noha').on('click', function (e) {

        e.preventDefault();

        var name= $(this).data('name');
        var price= $(this).data('price');
        var id= $(this).data('id');


        $(this).removeClass('btn-sucess').addClass('btn-default disabled');

        var html=`<tr> 
        <td>${name}</td>
        <td><input type="number" name="quanities[]" class="form-control" min="1" value="1"> </td>
        <td> ${price}</td>
        <td> <button  data_id="${id}" class="btn btn-danger remove-product-btn btn-sm"><span class="fa fa-trash"></span></button></td>
        </tr>`;
        $('.order_table').append(html);
    });


    $('body').on('click','.disabled',function(e){

        e.preventDefault();
    });

    

    $('body').on('click','.remove-product-btn',function(e){

        e.preventDefault();

        $(this).closest('tr').remove();
  
        var id = $(this).data('id');
       
        $('#productt-' + id).removeClass('btn-default disabled').addClass('btn-success');


});





});