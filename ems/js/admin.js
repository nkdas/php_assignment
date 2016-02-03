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
	"<label>Suffix</label><input name='suffix' type='text' class='form-control' value='" + record['suffix'] + "'>" +
	"<label>Gender</label><input name='gender' type='text' class='form-control' value='" + record['gender'] + "'>" +
	"<label>DOB</label><input name='dob' type='text' class='form-control' value='" + record['dob'] + "'>" +
	"<label>Marital status</label><input name='marital' type='text' class='form-control' value='" + record['marital'] + "'>" +
	"<label>Employment status</label><input name='employement' type='text' class='form-control' value='" + record['employement'] + "'>" +
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
			
		},
	});
}