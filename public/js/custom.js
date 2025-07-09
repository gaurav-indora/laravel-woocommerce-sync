//select2 js
  $(document).ready(function() {
    $('.my-select').select2();
  });


  $(document).ready(function(){

    $('.gtstid').on('change',function(){
    
        var stid = $(this).val();

         var route = '/fetchcity/' + stid;

        $.ajax({
        type: "GET",
        url: route,
        success: function(data){
            $('.city-dropdown').empty().append('<option value="">Select City</option>');
            $.each(data, function (id, name) {
            $('.city-dropdown').append('<option value="' + name + '">' + name + '</option>');
            });
        },
            error: function (err) {
                console.error("Error fetching city:", err);
            }
        });

    });

  })


  //valid form js

  $(document).ready(function () {
  $('#myForm').on('submit', function (e) {
    e.preventDefault(); // prevent actual submission

    var form = $(this);
    var formData = form.serialize();

    var urll = '/ajax-validate'

    $.ajax({
      url: urll,
      method: "POST",
      data: formData,
      success: function (response) {
        if (response.status === 'error') {
          var errorHtml = '';
          $.each(response.errors, function (key, value) {
            errorHtml += '<p>' + value[0] + '</p>';
          });
          $('#form-errors').html(errorHtml);
        } else {
          // All good, now allow form to submit normally
          form.off('submit'); // remove current handler
          form.submit(); // submit form (page will reload)
        }
      },
      error: function () {
        alert("Something went wrong.");
      }
    });
  });
});


//open model js
 $(document).ready(function () {
  $('.opencontact').on('click',function(){

      
    
        var route = $(this).data('route');

        var paras = $(this).data('para');

         $('#editStockModalContent').html('<div class="text-center p-4">Loading...</div>');

        $.ajax({
        type: "GET",
        url: route,
         data: {
        para:paras,
        },
        success: function(response){
          
                   $('#editStockModalContent').html(response);
                  $('#editStockModal').modal('show');


        },
            error: function (err) {
                $('#editStockModalContent').html('<div class="p-4 text-danger">Error loading modal.</div>');
            }
        });

    });

    });



  

