//  checks whether the user selects at least one checkbox and display an alert if the user not checked any checkbox. Also, displays a confirmation popup before submitting the form to server-side for delete records.

// function delete_confirm(){
//     if($('.checkbox:checked').length > 0){
//         var result = confirm("Are you sure to delete selected users?");
//         if(result){
//             return true;
//         }else{
//             return false;
//         }
//     }else{
//         alert('Select at least 1 record to delete.');
//         return false;
//     }
// }


// to implement the Select / Deselect All CheckBoxes functionality.
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
	
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});

//buldelete through ajax
$(document).ready(function(){
    $("#delete-btn").on("click",function(){
// Converted all checked checkbox's value into Array
    var id = [];
// Converted all checked checkbox's value into Array
$("input:checkbox[name='row-check']:checked").each(function(key) {
// $(":checkbox:checked").each(function(key){
  id[key] = $(this).val();

  console.log(id[key]);
});
if(id.length === 0){
  alert("Please Select atleast one checkbox.");
}
else{
  if(confirm("Do you really want to delete these records ?")){
    $.ajax({
      url : "bulkdelete.php",
      type : "POST",
      data : {id : id},
      dataType: 'json',
     
      success: function(response) {
      
        if($.trim(response)==1){
          alert("Records have been deleted successfully");
          location.reload();

        }
        else{
          alert("Some Problem occured!");
        }
      }
    });
  }
}
});


    
});
