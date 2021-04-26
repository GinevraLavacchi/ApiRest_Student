// var counter=1;
function mostraPerId()
{
  id=document.getElementById("id").value;
    $.ajax({
      url: 'localhost/PHP/Rest2021/REST-2021/student.php?id='+id,
      type: 'get',
      contentType: 'application/json',
      success: function(data, textstatus, jQxhr){
            //alert("success");
            // var student_data = '';
            // $.each(data, function(key, value){
            //   student_data += '<tr>';
            //   student_data += '<td><input class="form-check-input" type="checkbox" name="checkbox" id="'+value.employeeId+'" style="margin-left: 1%"></td>';
            //   student_data += '<td>'+value.name+' '+value.surname+'</td>';
            //   student_data += '<td>'+value.sidi_code+'</td>';
            //   student_data += '<td></td>';
            //   student_data += '<td>'+value.tax_code+'</td>';
            //   student_data += '<tr>';
            // });
            // $('#student_table').append(student_data);
                /* Tutto OK*/
                $('#student_table').append(data);
  },
  error: function (data, textstatus, errorThrown){
    console.log ("errore get 1"+errorThrown);
  }
  }); 
}
$(document).ready(function() {//GET
	//start();
  $.ajax({
    url: 'http://localhost/PHP/Rest2021/REST-2021/student.php?',
    type: 'get',
    contentType: 'application/json',
    success: function(data, textstatus, jQxhr)
    {
          var student_data = '';
            $.each(data, function(key, value)
            {
              student_data += '<tr>';
              student_data += '<td><input class="form-check-input" type="checkbox" name="checkbox" id="'+value.id+'" style="margin-left: 1%"></td>';
              student_data += '<td>'+value.name+' '+value.surname+'</td>';
              student_data += '<td>'+value.sidi_code+'</td>';
              student_data += '<td>'+value.tax_code+'</td>';
              student_data += '<td><button class="btn btn"><img onClick="appoMod('+value.id+')" src="img/editbutton.png" style="width: 30px; height: 30px;"></button></td>';
              student_data += '<td><button class="btn btn"><img onClick="appoRem('+value.id+')" src="img/removebutton.png" style="width: 30px; height: 30px;"></button></td>';  
              student_data += '<tr>';
            });
            $('#student_table').append(student_data);
              /* Tutto OK*/
    },
    error: function (data, textstatus, errorThrown)
    {
      console.log ("errore get all"+errorThrown);
    }
  });
});
function checkboxall(maincheckbox) {//funzione che seleziona tutte le checkboxall
  var appo = document.getElementsByName('checkbox');
  for (var i = 0, n = appo.length; i < n; i++) {
      appo[i].checked = maincheckbox.checked;
  }
}
function newEmployee(){ //visualizzazione del form per il POST
  let form=document.createElement("div");
  
  form.innerHTML='<div id="form"><input type="text" id="firstNameAdd" placeholder="First name" />\
      <input type="text" id="lastNameAdd" placeholder="Last name" />\
      <input type="text" id="sidiCodeAdd" placeholder="Sidi Code"/>\
      <input type="text" id="taxCodeAdd" placeholder="Tax Code"/>\
          <button class="btn btn-success" id="save" onclick="saveEmployee()">Save</button>\
      </div>';
  document.getElementById('inizioPag').appendChild(form);
}
function saveEmployee(){//richiesta per POST
  _name=document.getElementById("firstNameAdd").value;
  surname=document.getElementById("lastNameAdd").value;
  sidi_code=document.getElementById("sidiCodeAdd").value;
  tax_code=document.getElementById("taxCodeAdd").value;
  var JSONStudent =
	{
    "name": _name,
    "surname":surname,
    "sidi_code": sidi_code,
    "tax_code": tax_code
    };
    console.log(JSONStudent);
	$.ajax({
	url: 'http://localhost/PHP/Rest2021/REST-2021/student.php',
	type: 'post',
	data : JSON.stringify(JSONStudent),
	contentType: 'application/json',
	success: function (data,textstatus,jQxhr)
		{
		location.reload();
		}
	});
}

function appoRem(id)
{
    getId("remove",id);
}
function getId(string,id)//funzione che richiama o il remove o il modify dalle action
{
    if(string=="remove")
    {
        
    delEmployee(id);
	  location.reload();
    }
    else if(string=="modify")
    {
        modify(id);
    }
}
function delEmployee(id)//richiesta per Remove di 1 solo studente
{
	$.ajax({
	url: "http://localhost/PHP/Rest2021/REST-2021/student.php?id="+id,
    type: "delete",
    contentType: 'String',
    success: function (data,textstatus,jQxhr){
    
    }
     });
}
function deleteCheck() {//richiesta per Remove di tutti i selezionati
  $('input:checked').each(function(index) {
  if (!(index==0&&document.getElementById("maincheckbox").checked))
  {
    let ide = $(this).attr('id');
    delEmployee(ide);
  }
  });
location.reload();
}
//////////modify

function appoMod(id)
{
    getId("modify",id);
}
function modify(id)
{
    let form=document.createElement("div");
    
    form.innerHTML='<div id="form"><input type="text" id="name" placeholder="First name" />\
        <input type="text" id="surname" placeholder="Last name" />\
        <input type="text" id="sidi_code" placeholder="Sidi Code"/>\
        <input type="text" id="tax_code" placeholder="Tax Code"/>\
            <button class="btn btn-success" id="save" onclick="edit('+id+')">Save</button>\
        </div>';
    
  document.getElementById('inizioPag').appendChild(form);
}
function edit(id)
{
    var  _name=document.getElementById("name").value;
    var surname=document.getElementById("surname").value;
    var sidi_code=document.getElementById("sidi_code").value;
    var tax_code=document.getElementById("tax_code").value;
    var JSONStudent =
	{
    "name": _name,
    "surname":surname,
    "sidi_code": sidi_code,
    "tax_code": tax_code
    };
	$.ajax({
	url: 'http://localhost/PHP/Rest2021/REST-2021/student.php'+id,
	type: 'put',
	data : JSON.stringify(JSONStudent),
	contentType: 'application/json',
	success: function (data,textstatus,jQxhr)
		{
		location.reload();
		}
	});
}