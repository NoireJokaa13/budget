<script>
// item add
	function newMenuItem() {
		var newElem = $('tr.list-item').first().clone();
		newElem.find('input').val('');
    newElem.find('#txt_justification option').remove();
    newElem.find('#txt_justification').removeClass('show');
		newElem.appendTo('table#item-add');
	}
	if ($("table#item-add").is('*')) {
		$('.add-item').on('click', function (e) {
			e.preventDefault();
			newMenuItem();
		});
		$(document).on("click", "#item-add .delete", function (e) {
			e.preventDefault();
			$(this).parent().parent().parent().parent().remove();
		});
	}


  //if type change
  $('#item-add').on('change', '#txt_type', function () {

    var row = $(this).closest('tr');
    var value = '';
    $('td', row).each(function() {
        value = $(this).find('#txt_type').val();
        if(value == 'Asset') {
          $(this).find('#txt_justification option').remove();
          $(this).find('#txt_justification').append('<option value="">Please Select</option>');
          $(this).find('#txt_justification').append('<option value="New">New Purchase</option>');
          $(this).find('#txt_justification').append('<option value="Replace">Replace Old Asset</option>');
        } else if(value == 'Service') {
          $(this).find('#txt_justification option').remove();
          $(this).find('#txt_justification').append('<option value="">Please Select</option>');
          $(this).find('#txt_justification').append('<option value="Maintenance">Maintenance</option>');
          $(this).find('#txt_justification').append('<option value="Training">Training</option>');
          $(this).find('#txt_justification').append('<option value="Consultation">Consultation</option>');
          $(this).find('#txt_justification').append('<option value="Honorarium">Honorarium</option>');
          $(this).find('#txt_justification').append('<option value="Reimbursement">Reimbursement</option>');
        } else if(value == '') {
          $(this).find('#txt_justification option').remove();
          $(this).find('#txt_justification').append('<option value=""></option>');
        }


    });
});

// calculation of price

$('#item-add').on('keyup', '#txt_price', function () {
  var row = $(this).closest('tr');
  var price = '';
  var qty = 0;
  var total = 0;
  $('td', row).each(function() {
      price = $(this).find('#txt_price').val();
      qty = $(this).find('#txt_qty').val();
      if(price != null && qty != null) {
        total = parseFloat(parseFloat(price) * qty);
        $(this).find('#txt_total').val(total.toFixed(2));
      }
  });
  calGrandtotal()
});

$('#item-add').on('keyup', '#txt_qty', function () {
  var row = $(this).closest('tr');
  var price = '';
  var qty = 0;
  var total = 0;
  $('td', row).each(function() {
      price = $(this).find('#txt_price').val();
      qty = $(this).find('#txt_qty').val();
      if(price != null && qty != null) {
        total = parseFloat(parseFloat(price) * qty);
        $(this).find('#txt_total').val(total.toFixed(2));
      }
  });
  calGrandtotal();
});


function calGrandtotal() {
  var total = 0;
  var fulltotal = 0;
  $('#item-add > tbody > tr').each(function(index, tr) {
    $(tr).find('td').each (function (index, td) {
      console.log($(td).find('#txt_price').val());
      total = parseFloat($(td).find('#txt_total').val());
      fulltotal = parseFloat(fulltotal + total);
    });
    $('td',tr).each(function(index, td) {
      //console.log(td);
      price = $(td).find('#txt_price').val();
      qty = $(td).find('#txt_qty').val();
    });
  });
  console.log('total: '+fulltotal);
  $('#txt_fulltotal').val(fulltotal.toFixed(2));
}


</script>
