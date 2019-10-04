   
    $(document).ready(function()
                     {
        $("#fetchval").on('change',function()
        {
           
            var keyword = $(this).val();
            $.ajax(
            {

                url:"/fetch_vertical",
                type:'POST',
                //data:'test='+keyword,
                //dataType: 'JSON',
                data: {_token: CSRF_TOKEN, message:$(".fetchval").val()},
                // beforeSend:function()
                // {

                //     $("#table-container").html('Working...');

                // },
                success:function(data)
                {
                  var div1,name,sid;
                    //console.log(data);
                    var name1 = data.sub_verticals[0]['sub_vertical_name'];
                    var fname = name1.split(",");
                    var len=fname.length;
                    //console.log(fname);
                    var div = document.getElementById('subverticals');
                    for(var i=0;i<len;i++)
                    {
                       name = fname[i];
                       div1 +='<option value="'+name+'">'+name+'</option>';
                       
                    } 
                    //console.log(div1);
                    div.innerHTML=div1;
                    //alert(temp[0]['project_name']);
                    //$("#table-container").html(data);
                   
                },
            });
        });

    var bookIndex = $('#rowNumber').val();
    $('#bookForm')

        // Add button click handler
        .on('click', '.addButton', function() {

          
            var curCount = $('#rowNumber').val();

            $('#rowNumber').val( parseInt(curCount) + 1);

              bookIndex++;
              var $template = $('#bookTemplate'),
                  $clone    = $template
                                  .clone()
                                  .removeClass('hide')
                                  .removeAttr('id')
                                  .attr('data-book-index', bookIndex)
                                  .insertBefore($template);

              // Update the name attributes
              $clone
                //.find('[name="userfile[]"]').attr('name', 'userfile_' + bookIndex + '[]').end()
                .find('[name="files[]"]').attr('name', 'files_' + bookIndex + '[]').end()
                .find('[name="folder_name"]').attr('name', 'folder_name_' + bookIndex + '').end()
                


        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row  = $(this).parents('.form-group'),
                index = $row.attr('data-book-index');

            // Remove fields
            $('#bookTemplate')
  

            // Remove element containing the fields
            $row.remove();
        });


    });

        // Add varient count
function incrementValue() {
  var value = parseInt(document.getElementById('rowNumber').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('rowNumber').value = value;
}

function decrementValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value--;
  document.getElementById('number').value = value;
}
function imageRemove(img,id)
{
    $.ajax({
         type: "POST",
        url:"{{ route('remove_image') }}",
        data: {_token: CSRF_TOKEN, image_name:img, asset_id:id},
         success: function(data){
              alert(data);
                 location.reload();
              }
          });
}
