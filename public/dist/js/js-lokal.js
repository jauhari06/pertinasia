$(document).ready(function(){
	$("#btn-add").click(function(){
		document.hide_form.act.value='add';
		document.hide_form.submit();
	});
	$("#btn-refresh").click(function(){
		var pg = $("#input-pg").val();
		document.location.href='index.php?pg='+pg;
	});
	$("#btn-cancel").click(function(){
		var pg = $("#input-pg").val();
		var ws = $("#input-ws").val();
		document.location.href='index.php?pg='+pg+'&ws='+ws;
	});
});

function actAdd(pg){

	document.hide_form.act.value='add';

	document.hide_form.submit();

}

function actAddKat(pg,id_kategori){

	document.hide_form.act.value='add';

	document.hide_form.id_kategori.value=id_kategori;

	document.hide_form.submit();

}

function actAddBerita(pg,id_kat){

	document.location.href='index.php?pg='+pg+'&act=add&id_kategori_berita='+id_kat;

}



function actSet(id){

	document.hide_form.act.value='set';

	document.hide_form.id.value=id;

	document.hide_form.submit();

}

function actSetKat(id,id_kategori){

	document.hide_form.id_kategori.value=id_kategori;

	document.hide_form.act.value='set';

	document.hide_form.id.value=id;

	document.hide_form.submit();

}



function actEdit(id){

	document.hide_form.act.value='edit';

	document.hide_form.id.value=id;

	document.hide_form.submit();

}



function actView(id){

	document.hide_form.act.value='view';

	document.hide_form.id.value=id;

	document.hide_form.submit();

}



function actDel(id){

	if(confirm('Apakah yakin dihapus?')){

	document.hide_form.act.value='del';

	document.hide_form.id.value=id;

	document.hide_form.submit();

	}

}

function actDelKat(id,id_kategori){

	if(confirm('Apakah yakin dihapus?')){

	document.hide_form.act.value='del';

	document.hide_form.id_kategori.value=id_kategori;

	document.hide_form.id.value=id;

	document.hide_form.submit();

	}

}



function actDelFoto(id,id_album){

	if(confirm('Apakah yakin dihapus?')){

	document.hide_form.act.value='del';

	document.hide_form.id.value=id;

	document.hide_form.id_album.value=id_album;

	document.hide_form.submit();

	}

}



function actEditFoto(id,id_album){

	document.hide_form.act.value='edit';

	document.hide_form.id.value=id;

	document.hide_form.id_album.value=id_album;

	document.hide_form.submit();

}



function actRefresh(){

	document.location.reload();

}


function CKupdate(){

    for ( instance in CKEDITOR.instances )

        CKEDITOR.instances[instance].updateElement();

}

$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('#add-field'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	var fieldHTML = '<tr><td><input type="text" id="nama_file" name="nama_file[]" class="form-control col-md-7 col-xs-12" autocomplete="off"></td><td><input type="file" id="file" name="file[]" class="form-control col-md-7 col-xs-12" autocomplete="off"></td><td><button class="btn btn-danger" id="del_field"><i class="fa fa-minus"></i></button></td></tr>'; //New input field html 
	var x = 1; //Initial field counter is 1
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
		}
	});
	$(wrapper).on('click', '#del_field', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('td').parent('tr').remove(); //Remove field html
		x--; //Decrement field counter
	});
	
	$(".cektes").click(function(){
		if($(this).prop('checked', false)){			
			$(this).parent('td').parent('tr').find("input[type='checkbox']").prop('checked', 'checked');
			$(this).prop('checked', true);
		}else{
			$(this).parent('td').parent('tr').find("input[type='checkbox']").prop('checked', false);
			$(this).prop('checked', false);
			
		}
	});
});