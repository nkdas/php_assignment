$(document).ready(function() {
	dat = $('#employee').DataTable({
		paging: true,
		searching: true,
		retrieve: true,
		"ajax": "fetch_records.php"
	});
});

function confirmDeletion(username) {
	$('.modal-title').html("Are you sure? You want to delete this Record!");
	$modalContent = "<input type='button' onclick='deleteRecord(\"" + username + "\")' class='btn btn-primary' value='YES'>" +
		"&nbsp<input type='button' class='btn btn-primary' value='NO' data-dismiss='modal'>";

	$('.modal-body').html($modalContent);
	$('#myModal').modal('show');
}

function deleteRecord(username) {
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "delete.php",
		data: "username=" + username,
		success: function(data) {
			if (data.status == '1') {
				$('#myModal').modal('hide');
				dat.ajax.reload();
			}
			else {
				console.log("unable to delete");
			}
		},
		error: function() {
			
		},
	});
}

function editRecord(record) {
	$('.modal-title').html("Edit Record");

	$modalContent = "<form name='modalForm' method='post'><input name='username' type='text' class='hiddenDiv' value='" + record['username'] + "'>" + 
	"<label>First name</label><input name='firstname' type='text' class='form-control' value='" + record['firstname'] + "'>" +
	"<label>Middle name</label><input name='middlename' type='text' class='form-control' value='" + record['middlename'] + "'>" +
	"<label>Last name</label><input name='lastname' type='text' class='form-control' value='" + record['lastname'] + "'>" +
	"<label>Suffix</label>" +
	"<select name='suffix' class='form-control' id='suffix'>" +
	"<option value='M.Tech'>M.Tech</option>" +
	"<option value='B.Tech'>B.Tech</option>" +
	"<option value='M.B.A'>M.B.A</option>" +
	"<option value='B.B.A'>B.B.A</option>" +
	"<option value='M.C.A'>M.C.A</option>" +
	"<option value='B.C.A'>B.C.A</option>" +
	"<option value='Ph.D'>Ph.D</option></select>" +

	"<label>Gender</label>" +
	"<select name='gender' class='form-control' id='gender'>" +
	"<option value='1'>Male</option>" +
	"<option value='2'>Female</option></select>" +

	"<label>DOB</label><input name='dob' type='text' class='form-control' value='" + record['dob'] + "'>" +

	"<label>Marital status</label>" +
	"<select id='marital' name='marital' class='form-control'>" +
	"<option value='Single'>Single</option>" +
	"<option value='Married'>Married</option>" +
	"<option value='Separated'>Separated</option>" +
	"<option value='Divorced'>Divorced</option>" +
	"<option value='Widowed'>Widowed</option></select>" +

	"<label>Employment status</label>" +
	"<select name='employement' class='form-control' id='employement'>" +
	"<option value='Student'>Student</option>" +
	"<option value='Self-employed'>Self-employed</option>" +
	"<option value='Unemployed'>Unemployed</option></select>" +

	"<label>Employer</label><input name='employer' type='text' class='form-control' value='" + record['employer'] + "'>" +
	"<label>Email</label><input name='email' type='text' class='form-control' value='" + record['email'] + "'>" +
	"<label>Street</label><input name='street' type='text' class='form-control' value='" + record['street'] + "'>" + 
	"<label>City</label><input name='city' type='text' class='form-control' value='" + record['city'] + "'>" +
	"<label>State</label><input name='state' type='text' class='form-control' value='" + record['state'] + "'>" +
	"<label>ZIP</label><input name='zip' type='text' class='form-control' value='" + record['zip'] + "'>" +
	"<label>Telephone</label><input name='telephone' type='text' class='form-control' value='" + record['telephone'] + "'>" +
	"<label>Mobile</label><input name='mobile' type='text' class='form-control' value='" + record['mobile'] + "'>" +
	"<label>FAX</label><input name='fax' type='text' class='form-control' value='" + record['fax'] + "'><br>" +
	"<input type='button' onclick='updateRecord()' class='btn btn-primary' value='Update'></form>";

	$('.modal-body').html($modalContent);
	$('#myModal').modal('show');
	$("#suffix option[value='" + record['suffix'] + "']").attr('selected','selected'); 
	$("#gender option[value='" + record['gender'] + "']").attr('selected','selected'); 
	$("#marital option[value='" + record['marital'] + "']").attr('selected','selected'); 
	$("#employement option[value='" + record['employement'] + "']").attr('selected','selected'); 
}

function updateRecord() {
	var formData = $('form').serialize();
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "update_record.php",
		data: formData,
		success: function(data) {
			if (data.status == '1') {
				$('#myModal').modal('hide');
				dat.ajax.reload();
			}
			else {
				console.log(data.status);
			}
		},
		error: function() {
			console.log('error');
		},
	});
}